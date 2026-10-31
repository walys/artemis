<?php

namespace Database\Seeders;

use App\Models\Users\UserMaster;
use Illuminate\Database\Seeder;

class UserMasterSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('MASTER_EMAIL');

        if (!$email) {
            throw new \RuntimeException(
                'Configure MASTER_EMAIL no arquivo .env.'
            );
        }

        $userMaster = UserMaster::firstOrCreate(
            ['email' => $email],
            [
                'name' => env('MASTER_NAME', 'Administrador Master'),
                'password' => env('MASTER_PASSWORD'),
                'is_active' => true,
            ]
        );

        $userMaster->settings()->firstOrCreate(
            ['user_master_id' => $userMaster->id],
            [
                'language' => 'pt-BR',
                'theme' => 'light',
                'notifications' => true,
            ]
        );
    }
}
