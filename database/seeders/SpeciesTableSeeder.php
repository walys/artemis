<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpeciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('species')->insert([
            ['name' => 'Cão', 'scientific_name' => 'Canis lupus', 'active' => true],
            ['name' => 'Gato', 'scientific_name' => 'Felis catus', 'active' => true],
            ['name' => 'Equino', 'scientific_name' => 'Equus caballus', 'active' => true],
            ['name' => 'Bovino', 'scientific_name' => 'Bos taurus', 'active' => true],
        ]);
    }
}
