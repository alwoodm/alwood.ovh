<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'title' => 'Portfolio z panelem administracyjnym',
            'slug' => 'portfolio-cms',
            'short_description' => 'Strona portfolio z CMS opartym o Laravel i Filament',
            'full_description' => '<p>Nowoczesna strona portfolio z pełnym panelem administracyjnym, umożliwiającym łatwe zarządzanie projektami, danymi kontaktowymi i innymi elementami witryny. Wykorzystuje najnowsze technologie i zapewnia doskonałą wydajność.</p>
                <h3>Funkcjonalności:</h3>
                <ul>
                    <li>Zarządzanie projektami z zaawansowanym edytorem WYSIWYG</li>
                    <li>Formularz kontaktowy z walidacją i zapisem do bazy danych</li>
                    <li>Edycja sekcji powitalnej i O mnie</li>
                    <li>Statystyki odwiedzin z wykresami</li>
                    <li>Optymalizacja SEO i metatagi</li>
                </ul>
                <h3>Architektura:</h3>
                <p>Aplikacja wykorzystuje wzorzec MVC, z modelami reprezentującymi dane, kontrolerami do obsługi żądań i widokami do prezentacji. Zbudowana z myślą o skalowalności i łatwej rozbudowie w przyszłości.</p>',
            'thumbnail_path' => 'projects/portfolio-demo.jpg',
            'show_thumbnail' => true,
            'technologies' => ['Laravel', 'Filament', 'TailwindCSS', 'Alpine.js', 'MySQL', 'Docker'],
            'demo_url' => 'https://alwood.ovh',
            'code_url' => 'https://github.com/alwood/portfolio',
            'is_featured' => true,
            'sort_order' => 10,
        ]);
        
        Project::create([
            'title' => 'System rezerwacji online',
            'slug' => 'system-rezerwacji',
            'short_description' => 'Aplikacja webowa do rezerwacji usług i zasobów w czasie rzeczywistym',
            'full_description' => '<p>System rezerwacji online umożliwiający zarządzanie dostępnością zasobów, rezerwacjami i płatnościami.</p>
                <h3>Funkcjonalności:</h3>
                <ul>
                    <li>Rezerwacja zasobów w kalendarzu</li>
                    <li>Panel administracyjny dla właścicieli</li>
                    <li>Integracja z systemami płatności</li>
                    <li>Automatyczne powiadomienia SMS/email</li>
                </ul>',
            'thumbnail_path' => 'projects/reservation-system.jpg',
            'show_thumbnail' => true,
            'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Docker'],
            'demo_url' => 'https://demo.reservations.example.com',
            'code_url' => null,
            'is_featured' => true,
            'sort_order' => 20,
        ]);
        
        Project::create([
            'title' => 'Aplikacja do zarządzania zadaniami',
            'slug' => 'task-manager',
            'short_description' => 'Narzędzie zwiększające produktywność z podziałem na projekty i zespoły',
            'full_description' => '<p>Aplikacja usprawniająca zarządzanie zadaniami w zespole, z możliwością śledzenia postępów, przydzielania zadań i ustalania priorytetów.</p>
                <h3>Funkcjonalności:</h3>
                <ul>
                    <li>Tablice zadań w stylu Kanban</li>
                    <li>System komentarzy i załączników</li>
                    <li>Powiadomienia o terminach</li>
                    <li>Raporty i wykresy postępu</li>
                </ul>',
            'thumbnail_path' => 'projects/task-manager.jpg',
            'show_thumbnail' => true,
            'technologies' => ['React', 'Node.js', 'MongoDB', 'Express'],
            'demo_url' => null,
            'code_url' => 'https://github.com/alwood/task-manager',
            'is_featured' => false,
            'sort_order' => 30,
        ]);
    }
}
