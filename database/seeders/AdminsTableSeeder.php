<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = 'admin@abyzone.com';

        $admin = Admin::where('email', $email)->first();

        if (! $admin) {
            Admin::create([
                'name' => 'Administrator',
                'email' => $email,
                'password' => Hash::make('admin123456'),
                'role' => 'admin',
                'status' => 1,
            ]);

            $this->command->info("Admin account created in admins table: {$email} / password: admin123456");
        } else {
            $this->command->info("Admin already exists in admins table: {$email}");
        }
    }
}
