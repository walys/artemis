<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $supportedLocales = [
            'pt-BR',
            'en-US',
            'es-ES',
        ];

        $guard = Auth::guard('master');

        $language = $user->settings->language ?? 'pt-BR';

        $locale = $request->header('Accept-Language', $language);

        if (!in_array($locale, $supportedLocales, true)) {
            $locale = $language;
        }

        App::setLocale($locale);

        return $next($request);
    }
}