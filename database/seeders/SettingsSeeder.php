<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'contact_email',
                'value' => 'kontakt@domain.example',
                'group' => 'contact',
                'description' => 'Adres email do kontaktu wyświetlany na stronie',
            ],
            [
                'key' => 'github_url',
                'value' => 'https://github.com/username',
                'group' => 'contact',
                'description' => 'Link do profilu GitHub',
            ],
            [
                'key' => 'linkedin_url',
                'value' => 'https://linkedin.com/in/username',
                'group' => 'contact',
                'description' => 'Link do profilu LinkedIn',
            ],
            [
                'key' => 'made_by_text',
                'value' => 'Made by',
                'group' => 'footer',
                'description' => 'Tekst "Made by" w stopce',
            ],
        ];

        foreach ($settings as $setting) {
            \App\Models\Settings::create($setting);
        }
    }
}
