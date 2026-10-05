<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Only create the admin if it does not already exist
        $email = 'admin@abyzone.com';

        if (!User::where('email', $email)->exists()) {
            User::create([
                'name' => 'Administrator',
                'email' => $email,
                'password' => bcrypt('admin123456'),
                'role' => 'admin',
                'status' => 1,
            ]);
            $this->command->info('Admin user created: ' . $email . ' / password: admin123456');
        } else {
            $this->command->info('Admin user already exists: ' . $email);
        }
    }
}
