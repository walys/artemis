<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureMasterIsAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        $guard = Auth::guard('master');

        if (!$guard->check()) {
            return response()->json([
                'message' => 'Não autenticado.',
            ], 401);
        }

        $user = $guard->user();

        if (!$user->is_active) {
            $guard->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json([
                'message' => 'Sua conta Master está desativada.',
            ], 403);
        }

        return $next($request);
    }
}
