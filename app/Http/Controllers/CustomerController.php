<?php

namespace App\Http\Controllers;

use App\Models\AccountDeletionRequest;
use App\Models\Enquiry;
use App\Models\OTP;
use App\Models\ProductOrder;
use App\Models\WalletTransaction;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerTemp;
use App\Models\CustomerVerify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Session;
use Validator;
use Illuminate\Support\Str;
use DB;
use Mail;
use App\Mail\EmailVerificationEmail;
use App\Mail\MailForgotPassword;
use Carbon\Carbon;
use App\Models\State;
use App\Models\City;
use App\Helpers\SmsHelper;
use App\Models\FormSummaryCard;
use App\Helpers\IpHelper;
use App\Helpers\CurrencyHelper;

class CustomerController extends Controller
{
    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $exists = Customer::where('email', $email)->exists();

        return response()->json(['exists' => $exists]);
    }



    public function authenticate(Request $request)
    {
        // If already logged in
        if (Auth::guard('customer')->check()) {
            return response()->json([
                'success' => true,
                'redirect' => route('dashboard.index')
            ]);
        }

        $loginId = $request->input('loginId');
        $passwordOrOtp = $request->input('password');

        // Check if it's a phone number
        if (preg_match('/^[0-9]{10,15}$/', $loginId)) {
            $customer = Customer::where('mobile', $loginId)->first();

            if (!$customer) {
                return response()->json(['success' => false, 'message' => 'Mobile number not registered']);
            }

            // Check pending deletion
            $pendingDeletion = AccountDeletionRequest::where('customer_id', $customer->id)
                ->where('status', 'pending')
                ->first();

            if ($pendingDeletion) {
                return response()->json([
                    'success' => false,
                    'pending_deletion' => true,
                    'message' => 'Your Account is Pending Deletion. Do you want to restore your account?'
                ]);
            }

            $isValid = OTP::verifyOTP($loginId, $passwordOrOtp);

            if (!$isValid) {
                return response()->json(['success' => false, 'message' => 'Invalid OTP']);
            }

            if ($customer->status != 'active') {
                return response()->json(['success' => false, 'message' => 'Your account is blocked']);
            }

            Auth::guard('customer')->login($customer);

            return response()->json([
                'success' => true,
                'message' => 'OTP login successful',
                'redirect' => route('dashboard.index')
            ]);

        } else {
            // Email/Username + Password
            $customer = Customer::where('email', $loginId)
                ->orWhere('customer_id', $loginId)
                ->first();

            if (!$customer) {
                return response()->json(['success' => false, 'message' => 'Invalid credentials']);
            }

            // Check pending deletion
            $pendingDeletion = AccountDeletionRequest::where('customer_id', $customer->id)
                ->where('status', 'pending')
                ->first();

            if ($pendingDeletion) {
                return response()->json([
                    'success' => false,
                    'pending_deletion' => true,
                    'message' => 'Your Account is Pending Deletion. Do you want to restore your account?'
                ]);
            }

            if ($customer->email_verified_at == null) {
                $token = Str::random(64);
                CustomerVerify::create([
                    'customer_id' => $customer->id,
                    'token' => $token
                ]);

                Mail::to($customer->email)->send(new EmailVerificationEmail(['token' => $token]));

                return response()->json([
                    'success' => false,
                    'message' => 'Email not verified. Verification email sent. Please check inbox/spam.'
                ]);
            }

            if ($customer->status != 'active') {
                return response()->json(['success' => false, 'message' => 'Your account has been blocked']);
            }

            if (Auth::guard('customer')->attempt(['email' => $customer->email, 'password' => $passwordOrOtp])) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login successful',
                    'redirect' => route('dashboard.index')
                ]);
            }

            return response()->json(['success' => false, 'message' => 'Invalid credentials']);
        }
    }


    public function restoreAccount(Request $request)
    {
        $loginId = $request->input('loginId');

        if (!$loginId) {
            return response()->json(['success' => false, 'message' => 'Login ID is required'], 400);
        }

        // Find customer by email, username, or mobile
        $customer = Customer::where('email', $loginId)
            ->orWhere('customer_id', $loginId)
            ->orWhere('mobile', $loginId)
            ->first();

        if (!$customer) {
            return response()->json(['success' => false, 'message' => 'Customer not found'], 404);
        }

        // Check for pending deletion request
        $pending = AccountDeletionRequest::where('customer_id', $customer->id)
            ->where('status', 'pending')
            ->first();

        if ($pending) {
            $pending->delete(); // cancel the pending request
        }

        return response()->json([
            'success' => true,
            'message' => 'Your account deletion request has been cancelled. You can now continue using your account.'
        ]);
    }


    public function sendOtp(Request $request)
    {
        $request->validate([
            'value' => 'required|string',
            'type' => 'required|in:mobile,email',
        ]);

        $value = $request->value;
        $type = $request->type;
        $otp = rand(100000, 999999);

        // Delete old OTP for same value+type
        $old_otp = OTP::where('value', $value)->where('type', $type)->first();
        if ($old_otp) {
            $old_otp->delete();
        }
        // Store new OTP
        OTP::create([
            'value' => $value,
            'type' => $type,
            'otp' => $otp,
            'expiry' => now()->addMinutes(10),
            'verified' => false,
        ]);

        try {
            if ($type === 'mobile') {
                // Validate mobile number format
                if (!preg_match('/^[6-9]\d{9}$/', $value)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid mobile number'
                    ], 422);
                }

                // Send SMS
                $message = "{$otp} is the One Time Password(OTP) to verify your MOB number at Web Mingo, This OTP is Usable only once and is valid for 10 min,PLS DO NOT SHARE THE OTP WITH ANYONE";

                $response = SmsHelper::send($value, $message, 'verify_otp', [
                    'otp' => $otp,
                    'mobile' => $value,
                    'website' => config('app.url'),
                ]);

                if (!$response) {
                    return response()->json(['success' => false, 'message' => 'SMS sending failed!'], 500);
                }
            } else {
                // Send Email
                Mail::to($value)->send(new \App\Mail\OtpMail($otp));
            }
        } catch (\Exception $e) {
            \Log::error("OTP sending failed for {$type} {$value}: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => ucfirst($type) . ' sending failed!'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => "OTP sent successfully on your {$type}!"
        ]);
    }


    public function verifyOTP(Request $request)
    {
        $request->validate([
            'value' => 'required|string',
            'type' => 'required|in:mobile,email',
            'otp' => 'required',
        ]);

        $value = $request->value;
        $type = $request->type;
        $otp = $request->otp;

        $isValid = OTP::verifyOTP($value, $otp, $type);

        if ($isValid) {

            return response()->json([
                'success' => true,
                'message' => 'OTP verified successfully!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Invalid or expired OTP'
            ], 422);
        }
    }

    public function register(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'accountType' => 'required|in:individual,entity',
            'legal_name' => 'nullable|string|max:250',
            'first_name' => 'required|string|max:250',
            'last_name' => 'required|string|max:250',
            'email' => 'nullable|email|max:250|unique:customers',
            'mobile' => 'nullable|unique:customers',
            'password' => 'required|min:8|confirmed',
            // 'country' => 'nullable|exists:countries,id',
        ]);

        // Require at least one (email OR mobile)
        if (!$request->email && !$request->mobile) {
            return response()->json([
                'success' => false,
                'error' => 'Either email or mobile is required'
            ]);
        }

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()->first()
            ]);
        }

        // Check duplicate mobile
        $customerm = Customer::where('mobile', $request->mobile)->first();
        if ($customerm) {
            return response()->json([
                'success' => false,
                'error' => 'Mobile number already exists'
            ]);
        }

        $customer = new Customer();
        $customer->account_type = $request->accountType;
        $customer->legal_name = $request->accountType === 'entity' ? $request->legal_name : null;
        $customer->first_name = ucfirst($request->first_name);
        $customer->last_name = ucfirst($request->last_name);
        $customer->email = $request->email;
        $customer->mobile = $request->mobile;
        $customer->customer_id = 'Flippingo' . date('y') . rand(1000, 9999);
        $customer->password = Hash::make($request->password);
        // $customer->country = $request->country ?? null;

        // Mobile verified instantly if signup with mobile
        if ($request->mobile) {
            $customer->mobile_verified_at = now();
        }

        // Email verification required if registered with email
        if ($request->email) {
            $customer->email_verified_at = now();
        }

        $customer->save();

        // Send email verification only if email exists and not verified
        if ($request->email && !$customer->email_verified_at) {
            $token = Str::random(64);

            CustomerVerify::create([
                'customer_id' => $customer->id,
                'token' => $token
            ]);

            $mailData = ['token' => $token];
            Mail::to($request->email)->send(new EmailVerificationEmail($mailData));

            return response()->json([
                'success' => true,
                'message' => 'Verification Email sent, Please check your inbox/spam',
                'redirect' => route('authentication-signin')
            ]);
        }

        // **Auto-login customer after registration**
        Auth::guard('customer')->login($customer);

        // Redirect URL from request or default after login
        $redirectUrl = $request->input('redirect', route('dashboard.index'));

        return response()->json([
            'success' => true,
            'message' => 'Account created and logged in successfully.',
            'redirect' => $redirectUrl,
        ]);


    }


    // 🔄 Helper for validation failure
    private function validationError($validator)
    {
        return response()->json([
            'success' => false,
            'code' => 422,
            'errors' => $validator->errors(),
        ]);
    }

    public function verifyAccount($token)
    {
        $verifyUser = customerVerify::where('token', $token)->first();

        // echo "<pre/>"; print_r($verifyUser); die('sjbfvkjber');
        $message = 'Sorry your email cannot be identified.';

        if (!is_null($verifyUser)) {
            $user = $verifyUser->customer;

            if (!$user->email_verified_at) {
                $verifyUser->customer->email_verified_at = date('Y-m-d H:i:s');
                $verifyUser->customer->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

        \Session::put('success', $message);
        return redirect()->route('authentication-signin');

    }


    public function addRequiredDetails(Request $request)
    {

        $user_id = session()->get('id_tempuser');

        $data['user'] = CustomerTemp::findOrFail($user_id);
        return view('front.add-details', $data);
    }

    public function storeRequiredDetails(Request $request)
    {
        $request->validate([
            'mobile' => 'required|unique:customers',
            'password' => 'required|min:8',
            'country' => 'required'
        ]);


        $user_id = session()->get('id_tempuser');

        $customer_temp = customerTemp::find($user_id);

        if (!$user_id) {
            return redirect()->back()->with('error', 'User not found in session.');
        }

        $nameArr = explode(' ', $customer_temp->name);

        $customer = Customer::create([
            'first_name' => $nameArr[0] ?? "",
            'last_name' => $nameArr[1] ?? "",
            'email' => $customer_temp->email,
            'google_id' => $customer_temp->google_id,
            'profile_pic' => $customer_temp->profile_pic,
            'mobile_verified_at' => date('Y-m-d H:i:s'),
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make($request->password)
        ]);

        $customer = Customer::find($customer->id);
        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found.');
        }

        $customer->customer_id = 'Flippingo' . date('y') . rand(1000, 9999);
        $customer->mobile = $request->mobile;
        $customer->save();

        Auth::guard('customer')->login($customer);

        return redirect()->route('dashboard.index');
    }

    public function showForgetPasswordForm()
    {
        return view('front.forgot-password');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $mailData = ['token' => $token];
        // Mail::to($request->email)->send(new MailForgotPassword($mailData));
        try {
            Mail::to($request->email)->send(new MailForgotPassword($mailData));
        } catch (\Exception $e) {
            dd(Config::get('mail.mailers.smtp'), $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send password reset email. Please try again later.'
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'We have e-mailed your password reset link! Please check your email in inbox, spam and junk folder.'
        ]);
    }

    public function showResetPasswordForm($token)
    {
        return view('front.forget-password-link', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')->where(['token' => $request->token])->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = Customer::where('email', $updatePassword->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')->where(['token' => $request->token])->delete();

        return redirect()->route('authentication-signin')->with('success', 'Your password has been changed!');
    }

    public function dashboard()
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('authentication-signin')
                ->withErrors('Please login to access the dashboard.');
        }

        $user_id = Auth::guard('customer')->user()->id;
        $data['user'] = Customer::findOrFail($user_id);

        // 🔹 Wallet Balance
        $data['walletBalance'] = $data['user']->wallet->balance ?? 0;

        // 🔹 Active Orders
        $data['activeOrders'] = ProductOrder::where('customer_id', $user_id)
            ->whereHas(
                'currentStatus',
                fn($q) =>
                $q->whereNotIn('status', ['delivered', 'cancelled', 'deleted'])
            )
            ->count();

        // 🔹 Completed Purchases
        $data['completedPurchases'] = ProductOrder::where('customer_id', $user_id)
            ->whereHas(
                'currentStatus',
                fn($q) =>
                $q->where('status', 'delivered')
            )
            ->count();

        $data['wishlistCount'] = Wishlist::where('customer_id', $user_id)->count();

        // 🔹 Wishlist
        $data['wishlist'] = Wishlist::with(
            'submission.form.category',
            'submission.customer',
            'submission.files'
        )
            ->where('customer_id', $user_id)
            ->latest()
            ->paginate(20);

        /* ======================================================
| 🌍 IP BASED CURRENCY DETECTION
====================================================== */
        $countryCode = IpHelper::countryCode();
        // Currency logic
        $viewerCurrency = $countryCode === 'in' ? 'INR' : 'USD';
        // Exchange rate (base price assumed INR)
        $usdRate = CurrencyHelper::usdRate(); // REAL TIME

        // 🔹 Build summary fields (ADMIN CONTROLLED)
        foreach ($data['wishlist'] as $item) {
            $submission = $item->submission;

            if (!$submission) {
                continue;
            }

            $fields = is_array($submission->data)
                ? $submission->data
                : json_decode($submission->data, true);

            $fields = is_array($fields) ? $fields : [];

                /* =====================================
                | BASE PRICE FROM FORM
                ===================================== */
                $basePrice = ($fields['urgent_sale']['value'] ?? '') === 'Yes'
                    ? ($fields['offered_price']['value'] ?? 0)
                    : ($fields['mrp']['value'] ?? 0);

                $basePrice = (float) $basePrice;

                /* =====================================
                 | SUBMISSION & VIEWER CURRENCY
                 ===================================== */
                $submissionCurrency = $submission->currency ?? 'USD'; // stored
                $displayPrice = $basePrice;
                /* =====================================
                 | CONVERSION MATRIX
                 ===================================== */
                if ($submissionCurrency === 'INR' && $viewerCurrency === 'USD') {
                    // INR → USD
                    $displayPrice = round($basePrice * $usdRate, 2);

                } elseif ($submissionCurrency === 'USD' && $viewerCurrency === 'INR') {
                    // USD → INR
                    $displayPrice = round($basePrice / $usdRate, 2);
                }

                // else: same currency → no conversion

                $submission->display_price = $displayPrice;
                $submission->currency = $viewerCurrency;
                $submission->currency_symbol = $viewerCurrency === 'INR' ? '₹' : '$';


            // ✅ Fetch summary cards
            $summaryCards = FormSummaryCard::where('form_id', $submission->form_id)
                ->orderBy('position')
                ->get();

            $summaryFields = [];

            foreach ($summaryCards as $card) {
                $key = $card->field_key;

                if (!isset($fields[$key])) {
                    continue;
                }

                $value = $fields[$key]['value'] ?? null;

                if (is_array($value)) {
                    $value = implode(', ', array_map('strval', $value));
                }

                if ($value === null || $value === '') {
                    continue;
                }

                $summaryFields[] = [
                    'field_id' => $key,
                    'label' => $card->label,
                    'icon' => $card->icon,
                    'value' => $value,
                    'color' => $card->color,
                ];
            }

            $submission->summaryFields = $summaryFields;
            $submission->category = $submission->form->category;

            // Image
            $submission->imageFile = collect($submission->files)
                ->firstWhere('show_on_summary', true)
                ?? $submission->files->first();
        }

        // 🔹 Enquiry Revenues
        $data['enquiryRevenues'] = Enquiry::where('customer_id', $user_id);

        // 🔹 Recent Sales
        $data['recentSales'] = ProductOrder::with(['submission', 'currentStatus'])
            ->where('customer_id', $user_id)
            ->latest()
            ->take(5)
            ->get();

        // 🔹 Wallet Transactions
        $data['recentTransactions'] = WalletTransaction::whereHas(
            'wallet',
            fn($q) =>
            $q->where('customer_id', $user_id)
        )
            ->latest()
            ->take(5)
            ->get();

        // 🔹 Earnings Statistics (Year)
        $earningStatsYear = ProductOrder::where('seller_id', $user_id)
            ->whereHas(
                'currentStatus',
                fn($q) =>
                $q->whereNotIn('status', ['cancelled', 'deleted'])
            )
            ->selectRaw('MONTH(created_at) as month, SUM(seller_earning) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('total', 'month')
            ->map(fn($v) => (float) $v);

        $data['earningStatsYear'] = collect(range(1, 12))
            ->mapWithKeys(fn($m) => [$m => $earningStatsYear->get($m, 0.0)]);

        // 🔹 Weekly earnings (current month)
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $weeks = [];
        $period = new \DatePeriod(
            $startOfMonth,
            new \DateInterval('P1W'),
            $endOfMonth->copy()->addDay()
        );

        foreach ($period as $weekStart) {
            $weekStart = Carbon::instance($weekStart);
            $weekEnd = min($weekStart->copy()->endOfWeek(), $endOfMonth);

            $weeks[] = [
                'label' => $weekStart->format('d M') . ' - ' . $weekEnd->format('d M'),
                'total' => (float) ProductOrder::where('seller_id', $user_id)
                    ->whereHas(
                        'currentStatus',
                        fn($q) =>
                        $q->whereNotIn('status', ['cancelled', 'deleted'])
                    )
                    ->whereBetween('created_at', [$weekStart, $weekEnd])
                    ->sum('seller_earning'),
            ];
        }

        $data['earningThisMonthWeeks'] = $weeks;

        // 🔹 Earnings by country
        $orders = ProductOrder::where('seller_id', $user_id)
            ->whereHas(
                'currentStatus',
                fn($q) =>
                $q->whereNotIn('status', ['cancelled', 'deleted'])
            )
            ->with('customer.countryname')
            ->get();

        $locationEarnings = $orders
            ->groupBy(fn($o) => $o->customer->country ?? 'India')
            ->map(fn($orders, $country) => [
                'country' => $country,
                'total' => $orders->sum('seller_earning'),
            ]);

        $totalEarnings = $locationEarnings->sum('total');

        $data['locationEarnings'] = $locationEarnings->map(fn($item) => [
            'country' => $item['country'],
            'total' => $item['total'],
            'percent' => $totalEarnings ? round(($item['total'] / $totalEarnings) * 100) : 0,
        ]);

        return view('user.dashboard', $data);
    }




    public function downloads()
    {
        if (Auth::guard('customer')->check()) {
            $user_id = Auth::guard('customer')->user()->id;
            $data['user'] = Customer::findOrFail($user_id);
            return view('front.account-downloads', $data);
        } else {
            return redirect()->route('authentication-signin')
                ->withErrors('Please login to access the dashboard.');
        }
    }
    public function paymentmethods()
    {
        if (Auth::guard('customer')->check()) {
            $user_id = Auth::guard('customer')->user()->id;
            $data['user'] = Customer::findOrFail($user_id);
            return view('front.account-payment-methods', $data);
        } else {
            return redirect()->route('authentication-signin')
                ->withErrors('Please login to access the dashboard.');
        }
    }
    public function addresses()
    {
        if (Auth::guard('customer')->check()) {
            $user_id = Auth::guard('customer')->user()->id;
            $data['user'] = Customer::findOrFail($user_id);
            $data['addresses'] = Auth::guard('customer')->user()->addresses()->get();
            return view('front.account-addresses', $data);
        } else {
            return redirect()->route('authentication-signin')
                ->withErrors('Please login to access the dashboard.');
        }
    }
    public function userDetails()
    {
        if (Auth::guard('customer')->check()) {
            $user_id = Auth::guard('customer')->user()->id;
            $data['user'] = Customer::with('countryname')->where('id', $user_id)->first();
            return view('front.account-user-details', $data);
        } else {
            return redirect()->route('authentication-signin')
                ->withErrors('Please login to access the dashboard.');
        }
    }

    public function updateProfilePic(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            $user = Auth::guard('customer')->user();

            $request->validate([
                'profile_pic' => 'required|image|max:2048',
            ]);

            if ($request->hasFile('profile_pic')) {
                $path = $request->file('profile_pic')->store('customers', 'public');// Example storage locatio
                $user->profile_pic = $path;
            }

            $user->save();

            return response()->json(['success' => true, 'message' => 'Profile updated successfully.']);
        } else {
            return redirect()->route('authentication-signin')
                ->withErrors('Please login to access the dashboard.');
        }
    }

    public function changePassword(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            $request->validate([
                'old_password' => 'required|string',
                'new_password' => 'required|string|min:8|confirmed',
            ]);

            $user = Auth::guard('customer')->user();

            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json(['errors' => ['old_password' => ['Old password is incorrect.']]], 422);
            }

            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            return response()->json(['success' => true, 'message' => 'Password successfully updated.']);
        } else {
            return redirect()->route('authentication-signin')
                ->withErrors('Please login to access the dashboard.');
        }

    }

    public function addressStore(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            $data = $request->validate([
                'type' => 'required|in:billing,shipping',
                'address_line1' => 'required',
                'address_line2' => 'nullable',
                'city' => 'required',
                'state' => 'required',
                'postal_code' => 'required',
                'country' => 'required',
                'is_default' => 'boolean',
                'address_tag' => 'required|in:Home,Office,Others',
            ]);


            if ($data['is_default']) {
                Auth::guard('customer')->user()->addresses()->where('type', $data['type'])->update(['is_default' => false]);
            }

            Auth::guard('customer')->user()->addresses()->create($data);

            return response()->json(['success' => true, 'message' => 'Address added successfully.']);

        } else {
            return redirect()->route('authentication-signin')
                ->withErrors('Please login to access the dashboard.');
        }
    }
    public function statesByCountry(Request $request)
    {
        $id = $request->country_id;
        $states = State::where('country_id', $id)->get();
        //dd($city);
        if (isset($states)) {
            $response = '<option value="">Select State </option>';
            foreach ($states as $row) {
                $response .= '<option value=' . $row->id . '>' . $row->name . '</option>';
            }
        } else {
            $response = "";
            $response .= '<option value="">No State Found </option>';
        }

        return response()->json($response);
    }
    public function citiesByState(Request $request)
    {
        $id = $request->state_id;
        $city = City::where('state_id', $id)->get();
        //dd($city);
        if (isset($city)) {
            $response = '<option value="">Select City </option>';
            foreach ($city as $row) {
                $response .= '<option value=' . $row->id . '>' . $row->name . '</option>';
            }
        } else {
            $response = "";
            $response .= '<option value="">No City Found </option>';
        }

        return response()->json($response);
    }
    public function logout()
    {
        if (Auth::guard('customer')->check()) // this means that the admin was logged in.
        {
            Auth::guard('customer')->logout();
            return redirect()->route('authentication-signin');
        }
    }

    public function getCustomerData()
    {

        // dd('hello',Auth::guard('customer')->check());
        if (Auth::guard('customer')->check()) {
            $user_id = Auth::guard('customer')->user()->id;
            $data['user'] = Customer::findOrFail($user_id);
            // dd($data);
            return response()->json($data);
        }

    }




}
