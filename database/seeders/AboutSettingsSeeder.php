<?php

namespace Database\Seeders;

use App\Models\AboutSettings;
use Illuminate\Database\Seeder;

class AboutSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutSettings::create([
            'section_title' => 'O mnie',
            'content' => '<p>Jestem pasjonatem technologii z wieloletnim doświadczeniem w tworzeniu nowoczesnych aplikacji webowych. Specjalizuję się w ekosystemie Laravel oraz Vue.js.</p><p>Moja przygoda z programowaniem zaczęła się od prostych stron HTML, by z czasem przerodzić się w tworzenie zaawansowanych aplikacji internetowych.</p><p>W mojej pracy cenię sobie czytelność kodu, wydajność aplikacji i przyjazne interfejsy użytkownika.</p>',
            'show_image' => true,
            'image_position' => 'right',
            'image_path' => 'profile/01JXM44DT8JRS61B9Y543ZDJJ2.jpg',
        ]);
    }
}
