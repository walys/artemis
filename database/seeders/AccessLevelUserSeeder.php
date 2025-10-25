<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessLevelUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'level_name' => 'Super Administrador',
            ],
            [
                'level_name' => 'Administrador',
            ],
            [
                'level_name' => 'Cliente',
            ],
            [
                'level_name' => 'Estudiante',
            ],
            [
                'level_name' => 'Patologista',
            ],
            [
                'level_name' => 'Colaborador',
            ],

        ];

        DB::table('access_level_user')->insert($data);
    }
}
