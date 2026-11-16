<?php

namespace Database\Seeders\Plans;

use Illuminate\Database\Seeder;
use App\Models\Plans\Plan;

class PlanFeatureSeeder extends Seeder
{
    public function run(): void
    {
        $features = [
            'free' => [
                'max_exams' => 30,
                'max_laboratories' => 1,
                'max_users' => 1,
                'max_branches' => 0,
                'reports' => false,
                'financial_management' => false,
                'custom_branding' => false,
                'data_export' => false,
            ],

            'start' => [
                'max_exams' => 300,
                'max_laboratories' => 1,
                'max_users' => 3,
                'max_branches' => 1,
                'reports' => false,
                'financial_management' => false,
                'custom_branding' => false,
                'data_export' => true,
            ],

            'pro' => [
                'max_exams' => 1000,
                'max_laboratories' => 3,
                'max_users' => 10,
                'max_branches' => 3,
                'reports' => true,
                'financial_management' => true,
                'custom_branding' => false,
                'data_export' => true,
            ],

            'business' => [
                'max_exams' => -1,
                'max_laboratories' => -1,
                'max_users' => -1,
                'max_branches' => -1,
                'reports' => true,
                'financial_management' => true,
                'custom_branding' => true,
                'data_export' => true,
            ],
        ];

        foreach ($features as $planCode => $planFeatures) {
            $plan = Plan::where('code', $planCode)->first();

            if (!$plan) {
                continue;
            }

            foreach ($planFeatures as $featureKey => $featureValue) {
                $plan->features()->updateOrCreate(
                    ['feature_key' => $featureKey],
                    ['feature_value' => $featureValue]
                );
            }
        }
    }
}
