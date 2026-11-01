<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings\Language;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Language::create([
            'name' => 'Português',
            'code' => 'pt-BR',
        ]);

        Language::create([
            'name' => 'English',
            'code' => 'en-US',
        ]);

        Language::create([
            'name' => 'Spanish',
            'code' => 'es-ES',
        ]);
    }
}
