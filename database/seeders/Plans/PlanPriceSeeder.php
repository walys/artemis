<?php

namespace Database\Seeders\Plans;

use Illuminate\Database\Seeder;
use App\Models\Plans\Plan;

class PlanPriceSeeder extends Seeder
{
    public function run(): void
    {
        $prices = [
            'free' => [
                'monthly' => 0,
                'yearly' => 0,
            ],

            'start' => [
                'monthly' => 9990,
                'yearly' => 99900,
            ],

            'pro' => [
                'monthly' => 19990,
                'yearly' => 199900,
            ],

            'business' => [
                'monthly' => 39990,
                'yearly' => 399900,
            ],
        ];

        foreach ($prices as $planCode => $planPrices) {
            $plan = Plan::where('code', $planCode)->first();

            if (!$plan) {
                continue;
            }

            foreach ($planPrices as $interval => $amount) {
                $plan->prices()->updateOrCreate(
                    [
                        'currency' => 'BRL',
                        'billing_interval' => $interval,
                    ],
                    [
                        'amount' => $amount,
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}
