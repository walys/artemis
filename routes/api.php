
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Master\Auth\LoginController;
use App\Http\Controllers\Api\Master\Settings\LanguageApiController;

use App\Http\Controllers\Site\LanguageController;
use App\Http\Controllers\Api\Master\Plans\PlansApiController;
use App\Http\Controllers\Api\Master\Plans\PlanDescriptionsApiController;
use App\Http\Controllers\Api\Master\Plans\PlanFeaturesApiController;
use App\Http\Controllers\Api\Master\Plans\PlanPricesApiController;

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
        Route::get('/settings/languages', [LanguageApiController::class, 'index'])->name('master.settings.languages.index');
        Route::post('/settings/languages/portuguese', [LanguageApiController::class, 'savePortuguese'])->name('master.settings.languages.post');
        Route::get('/settings/get-languages', [LanguageApiController::class, 'getLanguages'])->name('master.settings.languages-list');

        //Rotas de planos
        Route::get('/settings/languages', [LanguageApiController::class, 'index'])->name('master.settings.languages.index');
        Route::post('/settings/languages/portuguese', [LanguageApiController::class, 'savePortuguese'])->name('master.settings.languages.post');

        //Rotas de planos
        Route::apiResource('plans', PlansApiController::class)->names('master.plans');      
        Route::post('/plans/update-order', [PlansApiController::class, 'updateOrder'])->name('master.plans.update-order');
        Route::get('plans/plan-list', [PlansApiController::class, 'planList'])->name('master.plans.plan-list');

        //Rotas de descrições dos Planos
        Route::apiResource('plan-description', PlanDescriptionsApiController::class)->names('master.plans.description');

        //Rotas de configuração dos Planos
        Route::apiResource('plan-feature', PlanFeaturesApiController::class)->names('master.plans.feature');

        //Rotas de Preços dos Planos
        Route::apiResource('plan-price', PlanPricesApiController::class)->names('master.plans.price');
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
