<?php

use App\Http\Controllers\backend\AboutController;
use App\Http\Controllers\backend\BannerController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\SocialMediaController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('homepage');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// dashboard update routes...

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::prefix('banner')->controller(BannerController::class)->name('banner.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::delete('delete/{id}', 'destroy')->name('delete');
    });

    // about routes...

    Route::controller(AboutController::class)->prefix('about')->name('about.')->group(function () {
        Route::get('index', 'index')->name('index');
        // Route::post('store', 'store')->name('about.store');
        // Route::get('edit/{id}', 'edit')->name('about.edit');
        // Route::post('update/{id}', 'update')->name('about.update');
        // Route::delete('delete/{id}', 'destroy')->name('about.delete');
    });


    // profile routes...
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('storeOrUpdate', 'storeOrUpdate')->name('storeOrUpdate');
        Route::POST('update/{id}', 'update')->name('update');
    });

    // social media routes...
    Route::prefix('profile')->name('social.')->controller(SocialMediaController::class)->group(function () {
        Route::post('/social/store/{profileId}',  'store')->name('store');
        Route::delete('/social/delete/{id}',  'delete')->name('delete');
    });
});





