<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnimalSexTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('animal_sex')->insert([
            ['name' => 'Macho', 'description' => 'Macho'],
            ['name' => 'Fêmea', 'description' => 'Femea'],
            ['name' => 'Indefinido', 'description' => 'Indefinido'],
        ]);
    }
}
