<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        // Insert multiple users at once
        User::insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
                'role' => 'admin',
                'status' => 'active',
                'password' => Hash::make('111'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Regular User',
                'email' => 'regular@regular.com',
                'role' => 'user', // Corrected to 'user' to distinguish roles
                'status' => 'active',
                'password' => Hash::make('111'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
