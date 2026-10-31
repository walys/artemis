<?php

namespace App\Http\Controllers\Master\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends Controller
{
    public function index()
    {
        return Inertia::render('master/login/Login');
    }
}
