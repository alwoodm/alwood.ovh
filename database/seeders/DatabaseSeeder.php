<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Uruchamiamy seeder administratora
        $this->call(AdminUserSeeder::class);
        
        // Uruchamiamy seeder ustawień
        $this->call(SettingsSeeder::class);
        
        // User::factory(10)->create();

        // Tworzymy testowego użytkownika (opcjonalnie)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
