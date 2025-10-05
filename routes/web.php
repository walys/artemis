<?php

use App\Http\Controllers\web\settings\CompanyController;
use App\Http\Controllers\web\dashboard\DashboardController;
use App\Http\Controllers\web\accountSettings\AccountSettingsController;
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

Route::group(['middleware' => 'auth'], function () {
    #Dashboard
    Route::resource("dashboard", DashboardController::class);

    #Settings
    Route::resource('/company', CompanyController::class);

    #Account Settings
    Route::resource('/account-settings', AccountSettingsController::class);
    #Settings
    // Route::get('/dashboard', [DashboardController::class, 'index']);
});
    