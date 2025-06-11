<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\HeroSettings;

class HeroSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HeroSettings::create([
            'title' => config('app.name'),
            'description' => 'Fullstack Developer z pasją do tworzenia nowoczesnych aplikacji webowych. Specjalizuję się w Laravel, Vue.js i nowoczesnych technologiach frontendowych.',
            'primary_button_text' => 'Zobacz projekty',
            'primary_button_url' => '#portfolio',
            'secondary_button_text' => 'Skontaktuj się',
            'secondary_button_url' => '#kontakt',
        ]);
    }
}
