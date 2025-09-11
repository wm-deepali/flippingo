<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    HomeController,
    CategoryController,
    SliderController,
    FormController,
    FormBuilderController,
    FormTemplateController,
    ListingController,
    FormLayoutController,
    PageController,
    TestimonialController,
    FaqController,
    BlogController,
    BlogCategoryController,
    FaqCategoryController,
    ClientReelController,
    AccountDeletionRequestController,
    CustomerController,
    SettingController,
    PackageController,
    SubscriptionController,
    ProductOrderController
};


use App\Http\Controllers\{
    WalletController,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/foo', function () {
    $target = '/var/www/vhosts/bookempire.co.uk/httpdocs/storage/app/public';
    $shortcut = '/var/www/vhosts/bookempire.co.uk/httpdocs/public/storage';
    symlink($target, $shortcut);
});
Auth::routes(['register' => false]);


Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [HomeController::class, 'profile'])
        ->name('profile.show');

    Route::get('/account-settings', [HomeController::class, 'profileSettings'])
        ->name('profile.account-setting');

    Route::post('/admin/footer-contact/update', [HomeController::class, 'updateFooterContact'])
        ->name('footer-contact.update')
        ->middleware('auth');


    Route::post('social-form-submission', [HomeController::class, 'socialFormSubmit'])
        ->name('social-form.submit');

    Route::post('user-info-form-submission', [HomeController::class, 'userInfoSubmit'])
        ->name('user-bio.submit');

    Route::post('user-basic-info-submission', [HomeController::class, 'userBasicInfoSubmit'])
        ->name('user-basicinfo.submit');

    Route::post('change-password', [HomeController::class, 'changePassword'])
        ->name('change-password');

    Route::get('save-basic-settings', [HomeController::class, 'basicSettingSubmit'])
        ->name('basic-setting.save');

    Route::get('get-states', [HomeController::class, 'getStateList'])
        ->name('get-states');

    Route::get('get-cities', [HomeController::class, 'getCityList'])
        ->name('get-cities');

    // Route for Slider
    Route::resource('slider', SliderController::class);

    // Route for Site Meta Tags
    Route::get('site/metas', [HomeController::class, 'manageSiteMetas'])->name('admin.manageSiteMetas');
    Route::get('site/meta/edit/{id}', [HomeController::class, 'editMetaContent'])->name('admin.editMetaContent');
    Route::post('update/site/metas', [HomeController::class, 'updateSiteMetas'])->name('admin.updateSiteMetas');
});



Route::group(['middleware' => 'auth'], function () {
    Route::name('admin.')->group(function () {

        Route::get('/home', [HomeController::class, 'index'])
            ->name('home');

        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('settings/update', [SettingController::class, 'update'])->name('settings.update');

        // ===== Category route ===== //
        Route::resource('manage-categories', CategoryController::class);

        // RESTful resource for forms (index, create, store, show, edit, update, destroy)
        Route::resource('form', FormController::class);

        // Extra routes for your dropdown actions
        Route::get('form/{id}/settings', [FormController::class, 'settings'])
            ->name('form.settings');
        Route::post('form/{id}/settings', [FormController::class, 'updateSettings'])
            ->name('form.settings.update');

        Route::get('form/{id}/conditional-rules', [FormController::class, 'conditionalRules'])
            ->name('form.conditionalRules');

        Route::get('form/{id}/copy', [FormController::class, 'copy'])
            ->name('form.copy');

        Route::get('form/{id}/publish-share', [FormController::class, 'publishShare'])
            ->name('form.publishShare');

        Route::get('form/{id}/submissions', [FormController::class, 'submissions'])
            ->name('form.submissions');

        Route::get('form/{id}/addons', [FormController::class, 'addons'])
            ->name('form.addons');

        Route::get('form/{id}/submissions-report', [FormController::class, 'submissionsReport'])
            ->name('form.submissionsReport');

        // for template route
        Route::resource('/form-templates', FormTemplateController::class);
        Route::get('/forms/create-from-template/{template}', [FormTemplateController::class, 'createFormFromTemplate'])
            ->name('form.create-from-template');

        // get form components and phrases
        Route::get('/ajax/builder-components', [FormBuilderController::class, 'builderComponents'])
            ->name('ajax.builder.components');

        Route::get('/ajax/builder-phrases', [FormBuilderController::class, 'actionBuilderPhrases'])
            ->name('ajax.builder.phrases');

        Route::get('/form-submissions', [ListingController::class, 'index'])->name('form-submissions.index');
        // Show submission details
        Route::get('form-submissions/{submission}', action: [ListingController::class, 'show'])->name('form-submissions.show');
        // Publish submission (POST)
        Route::patch('form-submissions/{submission}/update-status', [ListingController::class, 'updateStatus'])->name('form-submissions.update-status');
        // Show all sales for a specific submission
        Route::get('form-submissions/{submission}/sales', [ListingController::class, 'viewAllSales'])
            ->name('form-submissions.sales');

        Route::get('enquiry', [ListingController::class, 'enquiryIndex'])->name('enquiry.index');

        // In routes file
        Route::get('form-layout/{id}/edit', [FormLayoutController::class, 'edit'])->name('form-layout.edit');
        Route::post('form-layout/{id}', [FormLayoutController::class, 'update'])->name('form-layout.update');


    Route::get('wallets', [WalletController::class, 'index'])->name('wallets.index');
        Route::get('wallets/{wallet}/transactions', [WalletController::class, 'transactions'])->name('wallet.transactions');

    Route::get('seller-payouts', [WalletController::class, 'sellerPayout'])->name('seller_payouts.index');
    Route::get('withdrawal-requests', [WalletController::class, 'withdrawalRequests'])->name('withdrawal-requests.index');



        // content managemnent
        Route::get('content/dynamic-pages', [PageController::class, 'index'])->name('content.dynamic.pages');
        Route::prefix('pages')->name('pages.')->group(function () {
            Route::post('/store', [PageController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [PageController::class, 'edit'])->name('edit');
            Route::post('/{id}/update', [PageController::class, 'update'])->name('update');
            Route::delete('/{id}', [PageController::class, 'destroy'])->name('destroy');
        });
        Route::resource('testimonials', TestimonialController::class);
        Route::resource('faq-categories', FaqCategoryController::class);
        Route::resource('faqs', FaqController::class);
        Route::resource('blog-categories', BlogCategoryController::class);
        Route::post('blogs/update/{id}', [BlogController::class, 'update'])->name('blog-update');
        Route::resource('blogs', BlogController::class);
        Route::resource('client-reels', ClientReelController::class);

        Route::resource('packages', PackageController::class);

        Route::get('/subscriptions/orders', [SubscriptionController::class, 'index'])->name('subscriptions.orders');
        Route::get('/subscriptions/show/{id}', [SubscriptionController::class, 'show'])->name('subscriptions.show');
        Route::get('subscriptions/cancellation-requests', [SubscriptionController::class, 'cancellationRequests'])->name('subscriptions.cancellationRequests');
        Route::post('subscriptions/{subscription}/approve-cancellation', [SubscriptionController::class, 'approveCancellation'])
            ->name('subscriptions.approveCancellation');
        Route::get('/subscription-reports', [SubscriptionController::class, 'reports'])->name('subscriptions.reports');

        Route::get('reports/subscriptions/custom-date', [SubscriptionController::class, 'customDate'])
            ->name('reports.subscriptions.customDate');

        Route::post('subscriptions/{subscription}/reject-cancellation', [SubscriptionController::class, 'rejectCancellation'])
            ->name('subscriptions.rejectCancellation');

        Route::get('/orders/invoice/{type}/{id}', [SubscriptionController::class, 'viewInvoice'])->name('orders.invoice');
        Route::get('invoice/download/{type}/{id}', [SubscriptionController::class, 'download'])
            ->name('invoice.download');


        Route::resource('product-orders', ProductOrderController::class);
        Route::patch('/product-orders/{id}/update-status', [ProductOrderController::class, 'updateStatus'])->name('product-orders.update-status');
        Route::get('/product-orders/{id}/invoice', [ProductOrderController::class, 'viewInvoice'])->name('product-orders.invoice');


        Route::get('/payments', [SubscriptionController::class, 'payments'])->name('payments.index');



        Route::resource('deletion_reasons', \App\Http\Controllers\Admin\DeletionReasonController::class);

        Route::get('account_deletion_requests', [AccountDeletionRequestController::class, 'index'])
            ->name('account_deletion_requests.index');

        Route::post('account_deletion_requests/{id}/delete-instant', [AccountDeletionRequestController::class, 'deleteInstant'])
            ->name('account_deletion_requests.delete_instant');

        // Customer list
        Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('/customers/{id}/view', [CustomerController::class, 'view'])->name('customers.view');
        Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    });
});
