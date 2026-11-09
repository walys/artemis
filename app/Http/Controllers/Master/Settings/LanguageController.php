<?php

namespace App\Http\Controllers\Master\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        return inertia('master/languages/Index');
    }
}
