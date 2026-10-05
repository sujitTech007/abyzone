<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed an initial admin user
           // Seed admins to the dedicated admins table
           $this->call(\Database\Seeders\AdminsTableSeeder::class);
    }
}
