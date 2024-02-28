<?php

use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserAjaxController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ScrapController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\JobLogController;
use App\Http\Controllers\Admin\PriceUpdateLogController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::get('/', function () {
    return (Auth::check()) ? redirect('dashboard') : redirect('login');
});

Route::get('/register', function () {
    return (Auth::check()) ? redirect('dashboard') : redirect('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/scrap', [ScrapController::class, 'scrap'])->name('scrap');

    /* Routes For users */
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('get-data', [UserController::class, 'getData'])->name('getData');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [UserController::class, 'update'])->name('update');
        Route::get('view/{id}', [UserController::class, 'view'])->name('view');
        Route::post('delete', [UserController::class, 'delete'])->name('delete');

        Route::post('/import', [ImportController::class, 'import'])->name('import');
        Route::get('/export-excel', [ExportController::class, 'exportExcel'])->name('export-excel');
        Route::get('/export-csv', [ExportController::class, 'exportCsv'])->name('export-csv');
        Route::get('/generate-pdf', [UserController::class, 'generatePdf'])->name('generatePdf');
    });

    /* Routes For users ajax */
    Route::group(['prefix' => 'users-ajax', 'as' => 'users.ajax.'], function () {
        Route::get('/', [UserAjaxController::class, 'index'])->name('index');
        Route::post('get-data', [UserAjaxController::class, 'getData'])->name('getData');
        Route::post('detail', [UserAjaxController::class, 'detail'])->name('detail');
        Route::any('addupdate', [UserAjaxController::class, 'addupdate'])->name('addupdate');
        Route::post('delete', [UserAjaxController::class, 'delete'])->name('delete');
    });

    /* Routes For offers */
    Route::group(['prefix' => 'offers', 'as' => 'offers.'], function () {
        Route::get('/', [OfferController::class, 'index'])->name('index');
        Route::post('get-data', [OfferController::class, 'getData'])->name('getData');
        Route::post('detail', [OfferController::class, 'detail'])->name('detail');
        Route::post('product/sync', [OfferController::class, 'sync'])->name('product.sync');
        Route::any('addupdate', [OfferController::class, 'addupdate'])->name('addupdate');        
    });

    /* Routes For PriceUpdateLog */
    Route::group(['prefix' => 'priceUpdatelogs', 'as' => 'priceUpdatelogs.'], function () {
        Route::get('/', [PriceUpdateLogController::class, 'index'])->name('index');
        Route::post('get-data', [PriceUpdateLogController::class, 'getData'])->name('getData');                
    });

    /* Routes For JobLog */
    Route::group(['prefix' => 'jobLogs', 'as' => 'jobLogs.'], function () {
        Route::get('/', [JobLogController::class, 'index'])->name('index');
        Route::post('get-data', [JobLogController::class, 'getData'])->name('getData');                
    });

    /* Routes For profile */
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/edit-profile', [ProfileController::class, 'editProfile'])->name('editProfile');
        Route::post('/store-profile', [ProfileController::class, 'storeProfile'])->name('storeProfile');
    });

    /* Routes For Change Password */
    Route::group(['prefix' => 'change-password', 'as' => 'change-password.'], function () {
        Route::get('/', [ChangePasswordController::class, 'index'])->name('index');
        Route::post('/', [ChangePasswordController::class, 'store'])->name('store');
    });

    /* Routes For Demo form elements */
    Route::get('/basic-elements', [DashboardController::class, 'basicElements'])->name('basicElements');
    Route::get('/advance-elements', [DashboardController::class, 'advanceElements'])->name('advanceElements');
});

