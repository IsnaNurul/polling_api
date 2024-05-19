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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'id_user' => 1,
            'name' => 'Test User',
            'email' => 'test@example.com',
            'divisi' => 'test',
            'level' => 'admin',
            'password' => bcrypt('12341234')
        ]);
    }

    
}
