<?php

namespace App\Http\Controllers\web\dashboard;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

use function Termwind\render;

class DashboardController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        return Inertia::render('dashboard/Index');
    }
}