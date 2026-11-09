
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Master\Auth\LoginController;
use App\Http\Controllers\Api\Master\Settings\LanguageApiController;

use App\Http\Controllers\Site\LanguageController;

# Rotas públicas do site
Route::get('/site/languages', [LanguageController::class, 'index']);

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

        // Rotas de idiomas
        Route::get('/settings/languages', [LanguageApiController::class, 'index'])
            ->name('master.settings.languages.index');
        Route::post('/settings/languages/portuguese', [
            LanguageApiController::class,
            'savePortuguese'
        ])->name('master.settings.languages.post');

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
