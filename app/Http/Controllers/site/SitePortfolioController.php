<?php

namespace App\Http\Controllers\site;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as Controller;
use Inertia\Inertia;

class SitePortfolioController extends Controller
{
    public function index()
    {
        return Inertia::render('site/Portfolio');
    }
}
