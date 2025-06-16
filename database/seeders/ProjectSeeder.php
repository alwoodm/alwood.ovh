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
            'category' => 'osobiste',
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
            'category' => 'komercyjne',
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
            'category' => 'osobiste',
        ]);
        
        Project::create([
            'title' => 'E-commerce API',
            'slug' => 'ecommerce-api',
            'short_description' => 'RESTful API dla sklepu internetowego z pełną funkcjonalnością',
            'full_description' => '<p>Kompleksowe API dla sklepu internetowego obsługujące produkty, zamówienia, płatności i zarządzanie użytkownikami.</p>
                <h3>Funkcjonalności:</h3>
                <ul>
                    <li>Zarządzanie produktami i kategoriami</li>
                    <li>System koszyków i zamówień</li>
                    <li>Integracje z bramkami płatności</li>
                    <li>System recenzji i ocen</li>
                    <li>Analityka sprzedaży</li>
                </ul>',
            'thumbnail_path' => 'projects/ecommerce-api.jpg',
            'show_thumbnail' => true,
            'technologies' => ['Laravel', 'MySQL', 'Redis', 'Sanctum', 'PHPUnit'],
            'demo_url' => 'https://api.shop.example.com/docs',
            'code_url' => 'https://github.com/alwood/ecommerce-api',
            'is_featured' => false,
            'sort_order' => 40,
            'category' => 'komercyjne',
        ]);
        
        Project::create([
            'title' => 'Weather App React Native',
            'slug' => 'weather-app',
            'short_description' => 'Mobilna aplikacja pogodowa z prognozami i alertami',
            'full_description' => '<p>Mobilna aplikacja pogodowa z pięknym interfejsem, oferująca aktualne dane pogodowe i prognozy długoterminowe.</p>
                <h3>Funkcjonalności:</h3>
                <ul>
                    <li>Prognoza pogody 7-dniowa</li>
                    <li>Alerty pogodowe</li>
                    <li>Radar opadów</li>
                    <li>Ulubione lokalizacje</li>
                    <li>Tryb ciemny/jasny</li>
                </ul>',
            'thumbnail_path' => 'projects/weather-app.jpg',
            'show_thumbnail' => true,
            'technologies' => ['React Native', 'TypeScript', 'Redux', 'OpenWeather API'],
            'demo_url' => null,
            'code_url' => 'https://github.com/alwood/weather-app',
            'is_featured' => false,
            'sort_order' => 50,
            'category' => 'osobiste',
        ]);
        
        Project::create([
            'title' => 'Blog CMS',
            'slug' => 'blog-cms',
            'short_description' => 'System zarządzania treścią dla blogów z edytorem markdown',
            'full_description' => '<p>Minimalistyczny CMS dla blogów z obsługą markdown, komentarzy i kategorii.</p>
                <h3>Funkcjonalności:</h3>
                <ul>
                    <li>Edytor markdown z podglądem na żywo</li>
                    <li>System tagów i kategorii</li>
                    <li>Moderacja komentarzy</li>
                    <li>Optymalizacja SEO</li>
                    <li>RSS feeds</li>
                </ul>',
            'thumbnail_path' => 'projects/blog-cms.jpg',
            'show_thumbnail' => true,
            'technologies' => ['Next.js', 'PostgreSQL', 'Prisma', 'TailwindCSS'],
            'demo_url' => 'https://blog.example.com',
            'code_url' => null,
            'is_featured' => false,
            'sort_order' => 60,
            'category' => 'wspolpracowane',
        ]);
        
        Project::create([
            'title' => 'Cryptocurrency Dashboard',
            'slug' => 'crypto-dashboard',
            'short_description' => 'Dashboard z analizą kryptowalut i portfolio tracking',
            'full_description' => '<p>Zaawansowany dashboard do śledzenia kryptowalut z wykresami, alertami cenowymi i analizą portfolio.</p>
                <h3>Funkcjonalności:</h3>
                <ul>
                    <li>Real-time ceny kryptowalut</li>
                    <li>Portfolio tracking</li>
                    <li>Wykresy techniczne</li>
                    <li>Alerty cenowe</li>
                    <li>Analiza zysków/strat</li>
                </ul>',
            'thumbnail_path' => 'projects/crypto-dashboard.jpg',
            'show_thumbnail' => true,
            'technologies' => ['Vue.js', 'Chart.js', 'WebSocket', 'CoinGecko API'],
            'demo_url' => 'https://crypto.example.com',
            'code_url' => 'https://github.com/alwood/crypto-dashboard',
            'is_featured' => false,
            'sort_order' => 70,
            'category' => 'osobiste',
        ]);
    }
}
