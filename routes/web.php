<?php

use App\Http\Controllers\web\settings\CompanyController;
use App\Http\Controllers\web\dashboard\DashboardController;
use App\Http\Controllers\web\Logincontroller;
use App\Http\Controllers\site\SitePortfolioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\CsrfToken;
use Inertia\Inertia;

#Login
Route::get('/', [SitePortfolioController::class, 'index']);
Route::get('/login', [Logincontroller::class, 'index']);
Route::get('/logout', [Logincontroller::class, 'logout']);
Route::post('/auth', [Logincontroller::class, 'auth']);

#Csrf-token
Route::get('/csrf-token', function () {
    $token = csrf_token();
    return response()->json(['csrf_token' => $token]);
});


    #Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

Route::group(['middleware' => 'auth'], function () {


    #Settings
    Route::get('/company', [CompanyController::class, 'index']);

    #Settings
    // Route::get('/dashboard', [DashboardController::class, 'index']);
});
    