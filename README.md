# <span style="color: var(--primary-green);">alwood.ovh</span> - Portfolio z panelem administracyjnym

![Status projektu](https://img.shields.io/badge/status-w%20rozwoju-brightgreen)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-3.3-4299E1?style=for-the-badge&logo=laravel&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-Compose-2496ED?style=for-the-badge&logo=docker&logoColor=white)

Nowoczesne portfolio osobiste z systemem zarządzania treścią opartym na Laravel i Filament, z eleganckim ciemnym interfejsem inspirowanym kolorystyką jasnej zieleni.

## 📑 Spis treści

- [🌟 Funkcjonalności](#-funkcjonalności)
- [📋 Wymagania](#-wymagania)
- [🚀 Szybki start](#-szybki-start)
- [🧰 Struktura projektu](#-struktura-projektu)
- [🎨 System designu](#-system-designu)
- [👥 Panel administracyjny](#-panel-administracyjny)
- [🔧 Konfiguracja](#-konfiguracja)
- [🐳 Docker](#-docker)
- [🛠️ Rozwiązywanie problemów](#-rozwiązywanie-problemów)
- [📝 Aktualizacje i konserwacja](#-aktualizacje-i-konserwacja)
- [📚 Dokumentacja techniczna](#-dokumentacja-techniczna)

## 🌟 Funkcjonalności

- **Elegancki interfejs**
  - Minimalistyczny design z ciemnym motywem
  - Responsywny dla wszystkich urządzeń
  - Zgodny z aktualnymi trendami UI/UX

- **Portfolio i prezentacja**
  - Sekcja projektów z galeriami zdjęć
  - Prezentacja umiejętności i doświadczenia
  - Interaktywny formularz kontaktowy

- **System zarządzania treścią**
  - Panel administracyjny oparty na Filament 3.3
  - Zarządzanie projektami i zdjęciami
  - System wiadomości kontaktowych
  - Konfiguracja ustawień strony

- **Technologie i optymalizacja**
  - Pełna konteneryzacja (Docker)
  - Baza danych SQLite (lub opcjonalnie MySQL)
  - Optymalizacja SEO i wydajności

## 📋 Wymagania

- PHP 8.2 lub nowszy
- Composer 2.x
- Node.js 18+ i npm (dla kompilacji zasobów)
- Docker i Docker Compose 2.0+ (opcjonalnie)
- Baza danych SQLite (domyślnie) lub MySQL/PostgreSQL

## 🚀 Szybki start

### Instalacja z wykorzystaniem Docker (zalecana)

```bash
# Klonowanie repozytorium
git clone https://github.com/username/alwood.ovh.git
cd alwood.ovh

# Uruchomienie skryptu inicjalizacyjnego
./docker-init.sh
```

Po zakończeniu instalacji, aplikacja będzie dostępna pod adresem: http://localhost:8000

Panel administracyjny: http://localhost:8000/admin

### Instalacja manualna

```bash
# Klonowanie repozytorium
git clone https://github.com/username/alwood.ovh.git
cd alwood.ovh

# Instalacja zależności
composer install
npm install

# Konfiguracja
cp .env.example .env
touch database/database.sqlite
php artisan key:generate

# Migracja i seed bazy danych
php artisan migrate --seed

# Kompilacja zasobów
npm run dev

# Uruchomienie serwera
php artisan serve
```

## 🧰 Struktura projektu

Projekt ma standardową strukturę Laravel z dodatkowymi katalogami dla Filament:

```
alwood.ovh/
├── app/                         # Kod źródłowy aplikacji
│   ├── Filament/                # Komponenty panelu administracyjnego
│   │   ├── Pages/               # Niestandardowe strony panelu
│   │   ├── Resources/           # Zasoby Filament (CRUD)
│   │   │   ├── MessageResource/ # Zarządzanie wiadomościami
│   │   │   │   ├── Pages/       # Strony zasobu (lista, edycja)
│   │   │   │   └── Widgets/     # Widgety zasobu (statystyki)
│   │   │   │
│   │   │   ├── PhotoResource/   # Zarządzanie zdjęciami
│   │   │   │   ├── Pages/       # Strony zasobu (lista, edycja)
│   │   │   │   └── RelationManagers/ # Relacje z innymi zasobami
│   │   │   │
│   │   │   └── SettingsResource/ # Zarządzanie ustawieniami
│   │   │
│   │   └── Widgets/            # Widgety dashboardu
│   │
│   ├── Http/                   # Kontrolery i middleware
│   │   ├── Controllers/        # Kontrolery aplikacji
│   │   │   └── ContactController.php # Obsługa formularza kontaktowego
│   │   └── Middleware/         # Middleware aplikacji
│   │
│   ├── Models/                 # Modele danych
│   │   ├── Message.php         # Model wiadomości kontaktowych
│   │   ├── Photo.php           # Model zdjęć
│   │   ├── Settings.php        # Model ustawień
│   │   └── User.php            # Model użytkownika
│   │
│   └── Providers/              # Dostawcy usług
│       └── Filament/           # Dostawca Filament
│           └── AdminPanelProvider.php # Konfiguracja panelu admin
│
├── config/                     # Pliki konfiguracyjne
├── database/                   # Migracje i seedery
│   ├── factories/              # Fabryki testowe
│   ├── migrations/             # Migracje bazy danych
│   └── seeders/                # Seedery z danymi początkowymi
│       ├── AdminUserSeeder.php # Seeder administratora
│       └── SettingsSeeder.php  # Seeder ustawień
│
├── docker/                     # Konfiguracja kontenerów Docker
├── public/                     # Zasoby publiczne
├── resources/                  # Widoki, style i skrypty
│   ├── css/                    # Style CSS
│   │   └── app.css             # Główny plik CSS
│   │
│   ├── js/                     # Skrypty JavaScript
│   │   ├── app.js              # Główny plik JavaScript
│   │   └── bootstrap.js        # Inicjalizacja JavaScript
│   │
│   ├── lang/                   # Pliki językowe
│   │   ├── en/                 # Angielskie tłumaczenia
│   │   └── pl/                 # Polskie tłumaczenia
│   │
│   └── views/                  # Szablony Blade
│       ├── components/         # Komponenty wielokrotnego użytku
│       │   ├── contact/        # Komponenty sekcji kontaktowej
│       │   │   ├── form.blade.php  # Formularz kontaktowy
│       │   │   └── info.blade.php  # Informacje kontaktowe
│       │   │
│       │   └── ui/             # Komponenty interfejsu
│       │       ├── button.blade.php # Przycisk
│       │       └── card.blade.php  # Karta
│       │
│       ├── layouts/            # Szablony układów
│       │   ├── main.blade.php  # Główny układ strony
│       │   └── sections/       # Sekcje strony głównej
│       │       └── contact.blade.php # Sekcja kontaktowa
│       │
│       └── welcome.blade.php   # Strona główna
│
├── routes/                     # Definicje tras
│   └── web.php                # Trasy webowe
│
├── storage/                    # Pliki przechowywane
│   └── app/                    # Pliki aplikacji
│       └── public/             # Pliki publiczne
│           └── photos/         # Przesłane zdjęcia
│
├── tests/                      # Testy aplikacji
├── .env.example                # Przykładowy plik konfiguracyjny
├── .github/                    # Pliki konfiguracyjne GitHub i Copilot
├── composer.json               # Zależności PHP
├── docker-compose.yml          # Konfiguracja Docker Compose
├── docker-compose.access.yml   # Konfiguracja kontenera dostępowego
├── Dockerfile                  # Instrukcje budowania obrazu Docker
├── docker-init.sh              # Skrypt inicjalizacji Docker
└── README.md                   # Dokumentacja projektu
```

## 🎨 System designu

Projekt wykorzystuje autorski system designu oparty na filozofii minimalizmu i estetyce Manjaro Linux.

### Paleta kolorów

```css
/* Primary Colors - Manjaro Green Theme */
--primary-green: #35BF5C;
--primary-green-dark: #2A9946;
--primary-green-light: #4CD964;

/* Background Colors */
--bg-primary: #1a1a1a;
--bg-secondary: #252525;
--bg-tertiary: #2f2f2f;

/* Text Colors */
--text-primary: #e8e8e8;
--text-secondary: #b3b3b3;
--text-muted: #808080;

/* Accent Colors */
--accent-success: var(--primary-green);
--accent-warning: #f39c12;
--accent-error: #e74c3c;

/* Border Colors */
--border-primary: #404040;
--border-accent: var(--primary-green);
```

### Typografia

- **Czcionki**: JetBrains Mono (kod i nagłówki) + Inter (tekst)
- **Skala**: System modularnej skali typograficznej (od 0.75rem do 2rem)
- **Hierarchia**: Wyraźne rozróżnienie nagłówków i tekstu poprzez rozmiar i wagę

### Zasady projektowe

- **Minimalizm** - ograniczone wykorzystanie kolorów, duża ilość przestrzeni
- **Spójność** - konsekwentne wykorzystanie zmiennych CSS i skali odstępów
- **Dostępność** - zachowanie minimalnego kontrastu 4.5:1
- **Typografia** - czcionka monospace dla treści technicznych, sans-serif dla pozostałych

### Komponenty interfejsu

- **Przyciski** - `.btn-primary` i `.btn-secondary` z efektami hover
- **Karty** - `.card` z subtelnymi efektami przy interakcji
- **Nawigacja** - `.nav` z przejrzystym oznaczeniem aktywnych elementów
- **Kod** - `.code-block` ze stylizowanym formatowaniem dla bloków kodu

### Animacje

Wszystkie animacje wykorzystują standardowe przejścia z czasami:
- Szybkie: `0.15s ease`
- Standardowe: `0.2s ease`
- Wolne: `0.3s ease`
- Preferowane funkcje przejścia: `ease-out-cubic` i `ease-in-out-cubic`

## 👥 Panel administracyjny

Panel administracyjny (Filament) zapewnia pełną kontrolę nad treścią strony.

### Logowanie i dostęp

Panel dostępny pod adresem `/admin` z domyślnymi danymi logowania:
- Email: `admin@domain.example` lub `admin@alwood.ovh`
- Hasło: `password`

**Zalecamy natychmiast zmienić hasło po pierwszym logowaniu!**

### Zarządzane zasoby

#### 1. Wiadomości (Messages)
- Przeglądanie wiadomości z formularza kontaktowego
- Oznaczanie jako przeczytane/nieprzeczytane
- Sortowanie i filtrowanie
- Usuwanie lub archiwizowanie

#### 2. Zdjęcia (Photos)
- Przesyłanie zdjęć z automatycznym skalowaniem
- Kategoryzacja i opisy
- Przypisywanie do projektów
- Zarządzanie galeriami

#### 3. Ustawienia (Settings)
- Linki do mediów społecznościowych (GitHub, LinkedIn)
- Adres email kontaktowy
- Konfiguracja stopki
- Inne ustawienia strony

### Dodanie konta administratora

```bash
# Za pomocą seedera
php artisan db:seed --class=AdminUserSeeder

# Lub ręcznie przez Tinker
php artisan tinker
>>> use App\Models\User;
>>> use Illuminate\Support\Facades\Hash;
>>> User::create([
    'name' => 'Administrator',
    'email' => 'twoj-email@example.com',
    'password' => Hash::make('twoje-haslo'),
]);
```

## 🔧 Konfiguracja

### Zmienne środowiskowe

Kluczowe zmienne w pliku `.env`:

| Zmienna        | Opis                                   | Domyślna wartość     |
|----------------|----------------------------------------|----------------------|
| APP_NAME       | Nazwa aplikacji                        | alwood               |
| APP_ENV        | Środowisko uruchomieniowe              | local                |
| APP_DEBUG      | Tryb debugowania                       | true                 |
| APP_URL        | URL aplikacji                          | http://localhost     |
| ASSET_URL      | Bazowy URL dla zasobów                 | /                    |
| DB_CONNECTION  | Typ połączenia z bazą danych           | sqlite               |
| APP_LOCALE     | Język aplikacji                        | pl                   |
| MAIL_MAILER    | Sterownik mailowy                      | log                  |

### Funkcja pomocnicza settings()

Aplikacja zawiera funkcję pomocniczą do pobierania ustawień:

```php
// Przykład użycia w widokach
{{ settings('contact_email') }}
{{ settings('github_url') }}
{{ settings('linkedin_url') }}
{{ settings('made_by_text') }}
```

## 🐳 Docker

Projekt jest w pełni skonteneryzowany i gotowy do uruchomienia w środowisku Docker.

### Architektura kontenerów

- **app** - PHP-FPM 8.3 z zainstalowanym Laravel
- **nginx** - Serwer WWW na porcie 8000
- **db** - MySQL 8.0 z persistent volume
- **redis** - Redis dla cache i kolejek

### Sieci Docker

- **laravel_internal** - Wewnętrzna sieć dla kontenerów aplikacji
- **access_external** - Sieć dla kontenera proxy (opcjonalnie)

### Kontener dostępowy (opcjonalnie)

```bash
docker-compose -f docker-compose.access.yml up -d
```

Aplikacja będzie wtedy dostępna na porcie 8080.

### Zmienna ASSET_URL

Zmienna `ASSET_URL=/` w plikach konfiguracyjnych określa ścieżkę bazową dla zasobów aplikacji. Ustawienie jej na `/` zapewnia poprawne ładowanie zasobów niezależnie od punktu wejścia, co jest szczególnie istotne przy pracy przez proxy.

## 🛠️ Rozwiązywanie problemów

### Problemy z logowaniem do panelu

Jeśli nie możesz się zalogować do panelu administratora:

1. Sprawdź czy posiadasz konto z właściwym adresem email
2. Zweryfikuj czy adres email jest zgodny z warunkiem w metodzie `canAccessPanel`
3. Zresetuj hasło jeśli to konieczne

```bash
# Sprawdź listę użytkowników
php artisan tinker
>>> App\Models\User::all()

# Zmień hasło istniejącego użytkownika
>>> $user = App\Models\User::where('email', 'admin@domain.example')->first();
>>> $user->password = Hash::make('nowe-haslo');
>>> $user->save();
```

### Czyszczenie cache po zmianach

```bash
# W środowisku Docker
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear

# Bez Dockera
php artisan config:clear
php artisan cache:clear
```

## 📝 Aktualizacje i konserwacja

### Po aktualizacji funkcjonalności

Po wprowadzeniu zmian w kodzie wykonaj:

1. Migracje bazy danych:
   ```bash
   php artisan migrate
   ```

2. Aktualizacja ustawień:
   ```bash
   php artisan db:seed --class=SettingsSeeder
   ```

3. Przebudowa autoloadera:
   ```bash
   composer dump-autoload
   ```

4. Wyczyszczenie cache:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

5. Kompilacja zasobów:
   ```bash
   npm run dev
   ```

## 📚 Dokumentacja techniczna

### Modele danych

1. **User** - model użytkownika z rozszerzeniem FilamentUser
2. **Message** - wiadomości z formularza kontaktowego
3. **Photo** - zdjęcia z metadanymi
4. **Settings** - ustawienia strony

### Najważniejsze klasy

- **ContactController** - obsługa formularza kontaktowego
- **AdminPanelProvider** - konfiguracja panelu Filament
- **MessageResource** - zarządzanie wiadomościami w panelu
- **PhotoResource** - zarządzanie zdjęciami w panelu

### Pomocne linki

- [Dokumentacja Laravel](https://laravel.com/docs)
- [Dokumentacja Filament](https://filamentphp.com/docs)
- [Dokumentacja Docker Compose](https://docs.docker.com/compose/)

## 📋 Licencja

alwood 2025. Wszelkie prawa zastrzeżone
