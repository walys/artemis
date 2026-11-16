<?php

namespace Database\Seeders\Plans;

use Illuminate\Database\Seeder;
use App\Models\Plans\Plan;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Free',
                'code' => 'free',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Start',
                'code' => 'start',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Pro',
                'code' => 'pro',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Business',
                'code' => 'business',
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($plans as $plan) {
            Plan::updateOrCreate(
                ['code' => $plan['code']],
                $plan
            );
        }
    }
}
