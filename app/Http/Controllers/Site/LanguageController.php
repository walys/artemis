<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings\Language;
use Illuminate\Http\JsonResponse;

class LanguageController extends Controller
{
    /**
     * Retorna os idiomas disponíveis.
     */
    public function index(): JsonResponse
    {
        $languages = Language::query()
            ->select('id', 'name', 'code')
            ->orderBy('name')
            ->get();

        return response()->json([
            'languages' => $languages,
        ]);
    }
}
