<?php

namespace Database\Seeders;

use App\Models\SeoSettings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeoSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SeoSettings::create([
            'site_title' => config('app.name', 'Portfolio'),
            'site_description' => 'Portfolio osobiste - projekty, umiejętności i kontakt',
            'site_keywords' => 'portfolio, projekty, umiejętności, kontakt, web developer, programmer',
            'use_site_name_in_title' => true,
            'title_separator' => ' - ',
        ]);
    }
}
