<?php

namespace App\Http\Controllers\Master\Plans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        return inertia('master/plans/Index');
    }
}
