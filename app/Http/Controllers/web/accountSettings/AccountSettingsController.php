<?php

namespace App\Http\Controllers\web\accountSettings;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

use function Termwind\render;

class AccountSettingsController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        return Inertia::render('account-settings/Index');
    }

    public function create(Request $request)
    {
        return Inertia::render('account-settings/Index');
    }

    public function update(Request $request)
    {
        return Inertia::render('account-settings/Index');
    }
}