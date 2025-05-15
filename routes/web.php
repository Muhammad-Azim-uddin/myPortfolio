<?php

use App\Http\Controllers\backend\BannerController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'] )->name('homepage');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// dashboard update routes...

Route::middleware('auth')->prefix('dashboard')->group(function () {

    // Redirect dashboard/banner to dashboard/banner/index
    Route::redirect('banner', 'banner/index');

    Route::prefix('banner')->controller(BannerController::class)->name('banner.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::delete('delete/{id}', 'destroy')->name('delete');
    });
});
