<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserMasterSeeder;
use Database\Seeders\LanguagesSeeder;
use Database\Seeders\Plans\PlanSeeder;
use Database\Seeders\Plans\PlanDescriptionSeeder;
use Database\Seeders\Plans\PlanFeatureSeeder;
use Database\Seeders\Plans\PlanPriceSeeder;
use Database\Seeders\Plans\PlanPaymentMethodSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserMasterSeeder::class,
            LanguagesSeeder::class,
            PlanSeeder::class,
            PlanDescriptionSeeder::class,
            PlanFeatureSeeder::class,
            PlanPriceSeeder::class,
            PlanPaymentMethodSeeder::class,
        ]);
    }
}
