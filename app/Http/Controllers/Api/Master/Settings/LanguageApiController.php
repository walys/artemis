<?php

namespace App\Http\Controllers\Api\Master\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class LanguageApiController extends Controller
{
    /**
     * Retorna todas as traduções do idioma português.
     */
    public function index(): JsonResponse
    {
        $directories = [
            app_path('Http/Controllers'),
            resource_path('js/Pages'),
            resource_path('js/components'),
            resource_path('js/lib'),
        ];

        $translations = [];

        $pattern = <<<'REGEX'
    ~_\(\s*(['"])((?:\\.|(?!\1).)*)\1\s*\)~s
    REGEX;

        foreach ($directories as $directory) {

            if (!File::isDirectory($directory)) {
                continue;
            }

            $files = File::allFiles($directory);

            foreach ($files as $file) {

                $content = File::get($file->getPathname());

                preg_match_all(
                    $pattern,
                    $content,
                    $matches
                );

                foreach ($matches[2] as $phrase) {

                    $phrase = trim($phrase);

                    if ($phrase === '') {
                        continue;
                    }

                    $translations[$phrase] = $phrase;
                }
            }
        }

        return response()->json([
            'language' => 'pt-BR',
            'translations' => $translations,
        ]);
    }

    public function savePortuguese(Request $request)
    {
        $validated = $request->validate([
            'translations' => ['required', 'array'],
        ]);

        $translations = $validated['translations'];
        $lang  =$request->input('lang');
        $directory = lang_path();

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        switch($lang) {
            case 'pt-BR':
                $filePath = $directory . '/pt-BR.json';
                break;
            case 'en-US':
                $filePath = $directory . '/en-US.json';
                break;
            case 'es-ES':
                $filePath = $directory . '/es-ES.json';
                break;
            default:
                return response()->json([
                    'success' => false,
                    'message' => _('Idioma não suportado.'),
                ], 400);
        }

        $json = json_encode(
            $translations,
            JSON_PRETTY_PRINT |
            JSON_UNESCAPED_UNICODE |
            JSON_UNESCAPED_SLASHES
        );

        if ($json === false) {
            return response()->json([
                'success' => false,
                'message' => _('Não foi possível gerar o JSON das traduções.'),
            ], 500);
        }

        file_put_contents($filePath, $json);

        return response()->json([
            'success' => true,
            'message' => _('Traduções atualizadas com sucesso!'),
        ]);
    }
}