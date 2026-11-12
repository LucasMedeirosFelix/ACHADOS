<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->firstOrCreate(
            ['email' => 'admin@achados.local'],
            [
                'name' => 'Administrador',
                'username' => config('admin.username'),
                'password' => config('admin.password'),
            ],
        );
    }
}
