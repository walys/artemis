<?php

namespace Database\Seeders\Plans;

use Illuminate\Database\Seeder;
use App\Models\Plans\Plan;

class PlanPaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        $paymentMethods = [
            'free' => [],

            'start' => [
                'pix',
                'credit_card',
                'boleto',
            ],

            'pro' => [
                'pix',
                'credit_card',
                'boleto',
            ],

            'business' => [
                'pix',
                'credit_card',
                'boleto',
            ],
        ];

        foreach ($paymentMethods as $planCode => $methods) {
            $plan = Plan::where('code', $planCode)->first();

            if (!$plan) {
                continue;
            }

            foreach ($methods as $method) {
                $plan->paymentMethods()->updateOrCreate(
                    ['payment_method' => $method],
                    ['is_active' => true]
                );
            }
        }
    }
}
