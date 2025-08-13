<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    HomeController,
    CategoryController,
    SliderController,
    FormController,
    FormBuilderController
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

    Route::get('/settings', [HomeController::class, 'profileSettings'])
        ->name('profile.setting');

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

        // ===== Category MANAGEMENT ROUTES ===== //
        Route::resource('manage-categories', CategoryController::class);
        Route::resource('form', FormController::class);

        Route::get('/ajax/builder-components', [FormBuilderController::class, 'builderComponents'])
            ->name('ajax.builder.components');
            
        Route::get('/ajax/builder-phrases', [FormBuilderController::class, 'builderPhrases'])
            ->name('ajax.builder.phrases');

               Route::get('/ajax/initForm', [FormBuilderController::class, 'builderComponents'])
            ->name('ajax.initForm');
            
        Route::get('/ajax/createForm', [FormBuilderController::class, 'builderPhrases'])
            ->name('ajax.createForm');

    });
});
