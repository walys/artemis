<?php

namespace App\Http\Controllers\Api\Master\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Autenticar usuário Master.
     */
    public function store(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $guard = Auth::guard('master');

        if (!$guard->attempt($credentials, false)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais informadas são inválidas.'],
            ]);
        }

        $user = $guard->user();

        if (!$user->is_active) {
            $guard->logout();

            throw ValidationException::withMessages([
                'email' => ['Esta conta Master está desativada.'],
            ]);
        }

        $request->session()->regenerate();

        $user->forceFill([
            'last_login_at' => now(),
        ])->save();

        return response()->json([
            'message' => 'Login realizado com sucesso.',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    /**
     * Consultar usuário Master autenticado.
     */
    public function me(Request $request): JsonResponse
    {
        $user = Auth::guard('master')->user();

        if (!$user || !$user->is_active) {
            Auth::guard('master')->logout();

            return response()->json([
                'message' => 'Não autenticado.',
            ], 401);
        }

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    /**
     * Encerrar sessão Master.
     */
    public function destroy(Request $request): JsonResponse
    {
        Auth::guard('master')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Sessão encerrada com sucesso.',
        ]);
    }
}
