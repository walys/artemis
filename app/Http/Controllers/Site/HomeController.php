<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Plans\Plan;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        $plans = Plan::query()
            ->where('is_active', true)
            ->with([
                'descriptions.language',
                'features',
                'prices' => function ($query) {
                    $query->where('is_active', true);
                },
                'paymentMethods' => function ($query) {
                    $query->where('is_active', true);
                },
            ])
            ->orderBy('sort_order')
            ->get();

        return Inertia::render('site/Home', [
            'plans' => $plans,
        ]);
    }
}