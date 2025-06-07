<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sprawdzamy czy admin już istnieje
        $admin = User::where('email', 'admin@domain.example')->first();

        // Jeśli nie istnieje, to go tworzymy
        if (!$admin) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@domain.example',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]);
            
            $this->command->info('Konto administratora zostało utworzone.');
        } else {
            $this->command->info('Konto administratora już istnieje.');
        }
    }
}
