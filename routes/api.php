<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\V1\AuthController;
use App\Http\Controllers\api\V1\utils\UtilController;

Route::prefix('V1')->group(function(){
    #Auth
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    #Utils
    Route::get('/countries', [UtilController::class, 'getCountries'])->name('countries');

    #Auth - Protected
    Route::group(['middleware' => 'auth'], function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/auth', [AuthController::class, 'auth'])->name('auth');
        Route::get('/autenticated', [AuthController::class, 'userAutenticated'])->name('autenticated');

        #Utils
        Route::get('/cep/{cep}', [UtilController::class, 'getCountries'])->name('cep');
    });
    
});

