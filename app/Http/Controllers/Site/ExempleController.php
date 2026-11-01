<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class ExempleController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('site/Exemple');
    }
}