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

Route::middleware('auth')->prefix('dashboard/')->group(
    function(){
        Route::prefix('banner/')->controller(BannerController::class)->name('banner.')->group(
            function (){
                Route::get('create', 'index')->name('index');
                Route::post('/storeandupdate/{id?}', 'storeandupdate')->name('storeandupdate');
            }
        );
    }
);
