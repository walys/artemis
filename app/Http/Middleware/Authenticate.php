<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // dd([
        //     'Auth::check()' => Auth::check(),
        //     'Auth::user()' => Auth::user(),
        //     'session()' => session()->all(),
        // ]);
        if (Auth::check()) {
            return null;
        }
        return $request->expectsJson() ? null : url('/login');
    }
}