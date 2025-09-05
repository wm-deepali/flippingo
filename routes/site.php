<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ClientReelController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\ListingController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GoogleController;

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

Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');
Route::get('add-listing', [SiteController::class, 'addListing'])->name('add-listing');
Route::get('/forms/{id}', [FormController::class, 'showFormHtml'])->name('forms');
Route::get('/form-submissions', [ListingController::class, 'apiIndex'])->name('form-submissions');
Route::post('/send-enquiry', [ListingController::class, 'sendEnquiry']);
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


            Route::get('/bank-account', function () {
                return view('user.bank-account');
            })->name('dashboard.bank');

            Route::get('/notifications', function () {
                return view('user.notifications');
            })->name('dashboard.notifications');
            // FAQ
            Route::get('/faq', function () {
                return view('user.faq');
            })->name('dashboard.faq');

            Route::get('/raise-request', function () {
                return view('user.raise-request');
            })->name('dashboard.raise');

            // Contact Us
            Route::get('/contact-us', function () {
                return view('user.contact-us');
            })->name('dashboard.contact');

            // Orders
            Route::get('/orders', function () {
                return view('user.orders');
            })->name('dashboard.orders');

            // Invoice (usually linked with orders)
            Route::get('/invoices', function () {
                return view('user.invoices');
            })->name('dashboard.invoices');

            // Wallet
            Route::get('/wallet', function () {
                return view('user.wallet');
            })->name('dashboard.wallet');

            // Business Enquiries
            Route::get('/business-enquiries', function () {
                return view('user.enquiries');
            })->name('dashboard.enquiries');

            // Wishlist
            Route::get('/wishlist', function () {
                return view('user.wishlist');
            })->name('dashboard.wishlist');

            // Wishlist
            Route::get('/subscriptions', function () {
                return view('user.subscriptions');
            })->name('dashboard.subscriptions');

            // Wishlist
            Route::get('/listing', function () {
                return view('user.listing');
            })->name('dashboard.listing');

            Route::get('/reports', function () {
                return view('user.reports');
            })->name('dashboard.reports');

            Route::get('/analytics', function () {
                return view('user.analytics');
            })->name('dashboard.analytics');

        });


        Route::get('account-logout', [CustomerController::class, 'logout'])->name('account-logout');
    });
});