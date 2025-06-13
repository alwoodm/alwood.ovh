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
        
        // Uruchamiamy seeder ustawień dla sekcji hero
        $this->call(HeroSettingsSeeder::class);
        
        // Uruchamiamy seeder ustawień dla sekcji "O mnie"
        $this->call(AboutSettingsSeeder::class);
        
        // Uruchamiamy seeder ustawień SEO
        $this->call(SeoSettingsSeeder::class);
        
        // User::factory(10)->create();

        // Tworzymy testowego użytkownika (opcjonalnie)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
