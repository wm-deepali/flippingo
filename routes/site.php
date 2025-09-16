<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ClientReelController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;

use App\Http\Controllers\ListingController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\OrderController;
/*
|--------------------------------------------------------------------------
| Site Routes
|--------------------------------------------------------------------------
|
| Here is where you can register site routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| not contains the middleware group. Now create something great!
|
*/

Route::get('/artisan', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    // \Artisan::call('optimize');
    dd('cleared');
});
Route::get("/pass", function () {
    echo Hash::make("Empire@123#$");
});
Route::get('/stl', function () {
    \Artisan::call('storage:link');
    dd('linked');
});

Route::get('/', [SiteController::class, 'index'])->name('home');


Route::post('/subscription/cancel-request', [App\Http\Controllers\SubscriptionController::class, 'cancelRequest'])
    ->name('subscription.cancelRequest');


Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');
Route::get('add-listing', [SiteController::class, 'addListing'])->name('add-listing');
Route::get('/forms/{id}', [FormController::class, 'showFormHtml'])->name('forms');
Route::get('/form-submissions', [ListingController::class, 'apiIndex'])->name('form-submissions');
Route::post('/send-enquiry', [ListingController::class, 'sendEnquiry'])->name('send-enquiry');
Route::get('/testimonials', [TestimonialController::class, 'publicIndex'])->name('testimonials');
Route::get('/reels', [ClientReelController::class, 'publicIndex'])->name('reels');

Route::post('/listing/store', [ListingController::class, 'store'])->name('listing.store');
Route::get('listing-details', [ListingController::class, 'apiShow'])->name('listing-details');
Route::get('listing-list', [SiteController::class, 'FormSubmissionList'])->name('listing-list');

Route::get('blogs', [BlogController::class, 'publicIndex'])->name('blogs');
Route::get('/blog/{slug}', [BlogController::class, 'publicShow'])->name('blogs.show');
Route::get('/blogs/category/{slug}', [BlogController::class, 'category'])->name('blogs.category');
Route::get('/blogs/search', [BlogController::class, 'search'])->name('blogs.search');


Route::get('faq', [FaqController::class, 'publicIndex'])->name('faq');
Route::get('faq/category/{slug}', [FaqController::class, 'category'])->name('faq.category');





Route::get('order-tracking', function () {
    return view('front.order-tracking');
})->name('order-tracking');


Route::get('about-us', function () {
    return view('front.about-us');
})->name('about-us');


Route::get('meet-our-team', function () {
    return view('front.meet-our-team');
})->name('meet-our-team');

Route::get('our-services', function () {
    return view('front.our-services');
})->name('our-services');

Route::get('how-it-works', function () {
    return view('front.how-it-works');
})->name('how-it-works');

Route::get('contact-us', function () {
    return view('front.contact-us');
})->name('contact-us');


Route::get('user-profile', function () {
    return view('front.user-profile');
})->name('user-profile');

Route::get('recover', function () {
    return view('front.recover');
})->name('recover');



Route::post('states-by-country', [CustomerController::class, 'statesByCountry'])->name('states-by-country');
Route::post('cities-by-state', [CustomerController::class, 'citiesByState'])->name('cities-by-state');

Route::controller(GoogleController::class)->group(function () {
    Route::get('customer/google/redirect', 'redirectToGoogle')->name('google.redirect');
    Route::middleware(['web'])->get('customer/google/callback', 'handleGoogleCallback')->name('google.callback');
});

Route::get('login', function () {
    return view('front.authentication-signin');
})->name('authentication-signin');

Route::get('signup', function () {
    return view('front.authentication-signup');
})->name('authentication-signup');

Route::get('/customer-data/{id}', [CustomerController::class, 'getCustomerData']);


Route::middleware(['web'])->group(function () {

    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customer-data', 'getCustomerData');
        Route::post('send-otp', 'sendOtp')->name('send.otp');
        Route::post('/verify-otp', 'verifyOTP')->name('verify.otp');
        Route::post('/resend-otp', 'resendOtp')->name('resend.otp');

        Route::get('add-required-details', 'addRequiredDetails')->name('first.details');
        Route::post('/check-email', 'checkEmail')->name('check-email');
        Route::get('account/verify/{token}', 'verifyAccount')->name('customer.verify');
        Route::post('/customer-register', 'register')->name('customer.register');
        Route::post('/authenticate', 'authenticate')->name('customer.authenticate');
        Route::post('/account/restore', 'restoreAccount')->name('customer.restore');

        Route::post('first/add-details/store', 'storeRequiredDetails')->name('first.details.store');
        Route::get('authentication-forgot-password', 'showForgetPasswordForm')->name('authentication-forgot-password.get');
        Route::post('authentication-forgot-password', 'submitForgetPasswordForm')->name('authentication-forgot-password.post');
        Route::get('reset-password/{token}', 'showResetPasswordForm')->name('reset.password.get');
        Route::post('reset-password', 'submitResetPasswordForm')->name('reset.password.post');
    });


    // Update front routes and functions start
    Route::middleware(['auth:customer'])->group(function () {
        Route::post('/wallet/add-funds', [WalletController::class, 'addFunds'])->name('wallet.add_funds');
        Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place-order');
        Route::get('/orders/thank-you/{order?}', [CheckoutController::class, 'thankYou'])->name('orders.thank-you');
        Route::get('pricing', [SubscriptionController::class, 'ListPackage'])->name('pricing');
        Route::post('subscription/store', [SubscriptionController::class, 'Store'])->name('subscription.store');



        Route::prefix('dashboard')->group(function () {

            Route::get('/', [CustomerController::class, 'dashboard'])->name('dashboard.index');
            // Profile routes
            Route::get('/profile', [ProfileController::class, 'profile'])->name('dashboard.profile');
            Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('dashboard.profile.update');
            Route::post('/send-otp-both', [ProfileController::class, 'sendOtpBoth'])->name('send.otp.both');
            Route::post('/verify-otp-both', [ProfileController::class, 'verifyOTPBoth'])->name('verify.otp.both');
            Route::post('/Supdate-password', [ProfileController::class, 'updatePassword'])->name('update.password');
            Route::post('/delete-account', [ProfileController::class, 'deleteAccount'])->name('delete.account');
            Route::post('/kyc-update', [ProfileController::class, 'updateKyc'])->name('kyc.update');

            // subscriptions
            Route::get('/subscription', [SubscriptionController::class, 'index'])->name('dashboard.subscriptions');
            Route::post('/subscription/renew', [SubscriptionController::class, 'renew'])->name('subscription.renew');
            Route::get('/subscription-plan', [SubscriptionController::class, 'SubscriptionPlans'])->name('dashboard.subscription-plan');

            // orders 
            Route::get('/orders/buyer', [OrderController::class, 'buyerOrders'])->name('dashboard.buyer-orders');
            Route::get('/orders/seller', [OrderController::class, 'sellerOrders'])->name('dashboard.seller-orders');
            Route::post('/orders/cancel', [OrderController::class, 'cancelOrder'])->name('orders.cancel');
            Route::get('/{order}/detail', [OrderController::class, 'show'])->name('orders.detail');
            Route::get('/{order}/invoice', [OrderController::class, 'viewInvoice'])->name('orders.invoice');

            Route::get('/wallet', [WalletController::class, 'wallet'])->name('dashboard.wallet');
            Route::post('/wallet/withdraw', [WalletController::class, 'withdrawStore'])->name('wallet.withdraw.store');

            // bank accounts details
            Route::get('/bank-account', [PaymentMethodController::class, 'index'])->name('dashboard.bank');
            Route::post('/payment-method/banksave', [PaymentMethodController::class, 'saveBank'])->name('payment-method.save.bank');
            Route::post('/payment-method/upisave', [PaymentMethodController::class, 'saveUpi'])->name('payment-method.save.upi');
            Route::post('/payment-method/wiresave', [PaymentMethodController::class, 'saveWire'])->name('payment-method.save.wire');
            Route::post('/payment-method/paypalsave', [PaymentMethodController::class, 'savePaypal'])->name('payment-method.save.paypal');

            // Listing products and their routes
            Route::get('/listing', [ListingController::class, 'index'])->name('dashboard.listing');
            Route::get('/listing/{id}/edit', [ListingController::class, 'edit'])
                ->name('listing.edit');
            Route::put('/listing/{id}/update', [ListingController::class, 'update'])
                ->name('listing.update');
            Route::get('/listing/{id}/show', [ListingController::class, 'show'])
                ->name('listing.show');
            Route::delete('/listing/{id}', [ListingController::class, 'destroy'])->name('listing.destroy');

            // Business Enquiries
            Route::get('/business-enquiries', [ListingController::class, 'enquiryIndex'])->name('dashboard.enquiries');
            // Wishlist
            Route::get('/wishlist', [ListingController::class, 'wishlistIndex'])->name('dashboard.wishlist');

            // help & support routes
            Route::get('/faq', [FaqController::class, 'userFaq'])->name('dashboard.faq');

            // ticket raise request      
            Route::get('/raise-ticket', [TicketController::class, 'index'])->name('dashboard.raise-ticket');
            Route::post('/tickets/store', [TicketController::class, 'store'])->name('tickets.store');
            Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
            Route::patch('/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])->name('tickets.updateStatus');
            Route::post('/tickets/reply', [TicketController::class, 'reply'])->name('tickets.reply');

            Route::get('/analytics', [ListingController::class, 'analytics'])->name('dashboard.analytics');


            Route::get('/notifications', function () {
                return view('user.notifications');
            })->name('dashboard.notifications');
            // Contact Us
            Route::get('/contact-us', function () {
                return view('user.contact-us');
            })->name('dashboard.contact');


        });

        Route::get('account-logout', [CustomerController::class, 'logout'])->name('account-logout');
    });
});