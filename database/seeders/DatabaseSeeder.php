<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat 1 Admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_admin' => true,
        ]);

        // 2. Buat 100 user biasa ➜ TOTAL 101 user
        $users = User::factory(100)->create();

        // 3. Buat 100 todo untuk admin
        Todo::factory(100)->create([
            'user_id' => $admin->id,
        ]);

        // 4. Buat todo untuk user biasa ➜ 400 todo
        foreach ($users as $user) {
            Todo::factory(4)->create([
                'user_id' => $user->id,
            ]);
        }

        
    }
}
