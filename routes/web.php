<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
# Site
use App\Http\Controllers\Site\HomeController;

# Master
use App\Http\Controllers\Master\Auth\LoginController;

#Admin 


/*
|--------------------------------------------------------------------------
| Site
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Master
|--------------------------------------------------------------------------
*/
Route::prefix('master')->name('master.')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
});
// Route::prefix('master')->name('master.')->group(function () {
//     Route::get('/login', function () {
//         return Inertia::render('master/login/Login');
//     })->name('login');
// });