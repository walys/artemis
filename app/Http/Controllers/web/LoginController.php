<?php

namespace App\Http\Controllers\web;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as Controller;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Auth\User;

class Logincontroller extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        //dd(Auth::user());
        return Inertia::render('login/Login');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json(['message' => 'Authorized'], 200);
            // return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas.',
        ]);
    }
}
