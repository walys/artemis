<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

# Site
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\ExempleController;

# Master
use App\Http\Controllers\Master\Auth\LoginController;
use App\Http\Controllers\Master\Dashboard\DashboardController;

#Admin 


/*
|--------------------------------------------------------------------------
| Site
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/exemple', [ExempleController::class, 'index'])->name('exemple');
/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| Master
|--------------------------------------------------------------------------
*/
Route::prefix('master')->name('master.')->group(function () {

    // Acesso público
    Route::get('/login', [LoginController::class, 'index'])->name('login');

    // Área protegida
    Route::middleware('master.auth')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    });
});