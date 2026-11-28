<?php

namespace App\Http\Controllers\Master\Plans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plans\PlanFeature;
use Inertia\Inertia;

class PlanDescriptionsController extends Controller
{
    public function index()
    {
        return inertia('master/plan-descriptions/Index');
    } 
}