
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Master\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Rotas públicas Master
|--------------------------------------------------------------------------
*/

Route::prefix('master')->group(function () {

    Route::post('/login', [LoginController::class, 'store'])
        ->middleware('guest:master');

    /*
    |--------------------------------------------------------------------------
    | Rotas protegidas Master
    |--------------------------------------------------------------------------
    */

    Route::middleware('master.auth')->group(function () {

        Route::post('/logout', [LoginController::class, 'destroy']);

        Route::get('/me', [LoginController::class, 'me']);

    });

});

/*
|--------------------------------------------------------------------------
| Usuário autenticado padrão
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
