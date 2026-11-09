<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

# Site
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\ExempleController;

# Master
use App\Http\Controllers\Master\Auth\LoginController;
use App\Http\Controllers\Master\Dashboard\DashboardController;
use App\Http\Controllers\Master\Settings\LanguageController;
use App\Http\Controllers\Master\Plans\PlanController;

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
        # Rotas do Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        # Rotas de Idiomas
        Route::get('/languages', [LanguageController::class, 'index'])->name('languages');

        # Rotas de Planos
        Route::get('/plans', [PlanController::class, 'index'])->name('plans');
    });
});