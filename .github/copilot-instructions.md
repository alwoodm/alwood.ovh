## Design System Guidelines

### Color Palette

:root {
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
}

### Typography System

/* Font Stack */
--font-mono: 'JetBrains Mono', 'Roboto Mono', 'Fira Code', monospace;
--font-sans: 'Inter', 'Roboto', system-ui, sans-serif;

/* Font Sizes */
--text-xs: 0.75rem;
--text-sm: 0.875rem;
--text-base: 1rem;
--text-lg: 1.125rem;
--text-xl: 1.25rem;
--text-2xl: 1.5rem;
--text-3xl: 2rem;

/* Font Weights */
--font-normal: 400;
--font-medium: 500;
--font-semibold: 600;
--font-bold: 700;

### Layout Patterns

/* Container Widths */
--container-sm: 640px;
--container-md: 768px;
--container-lg: 1024px;
--container-xl: 1280px;

/* Spacing Scale */
--space-1: 0.25rem;
--space-2: 0.5rem;
--space-3: 0.75rem;
--space-4: 1rem;
--space-6: 1.5rem;
--space-8: 2rem;
--space-12: 3rem;
--space-16: 4rem;

/* Border Radius */
--radius-sm: 4px;
--radius-md: 8px;
--radius-lg: 12px;

### Component Design Rules

#### Buttons

.btn-primary {
background: var(--primary-green);
color: var(--bg-primary);
border: none;
padding: var(--space-3) var(--space-6);
border-radius: var(--radius-sm);
font-family: var(--font-mono);
font-weight: var(--font-medium);
transition: all 0.2s ease;
}

.btn-primary:hover {
background: var(--primary-green-dark);
transform: translateY(-1px);
}

.btn-secondary {
background: transparent;
color: var(--primary-green);
border: 1px solid var(--primary-green);
}

#### Cards

.card {
background: var(--bg-secondary);
border: 1px solid var(--border-primary);
border-radius: var(--radius-md);
padding: var(--space-6);
transition: border-color 0.2s ease;
}

.card:hover {
border-color: var(--border-accent);
}

#### Navigation

.nav {
background: var(--bg-primary);
border-bottom: 1px solid var(--border-primary);
backdrop-filter: blur(10px);
}

.nav-link {
color: var(--text-secondary);
font-family: var(--font-mono);
transition: color 0.2s ease;
}

.nav-link:hover,
.nav-link.active {
color: var(--primary-green);
}

### Design Principles

#### Minimalism
- Use whitespace generously
- Limit color usage to essential elements
- Prioritize content over decoration
- Keep typography hierarchy simple

#### Consistency
- Always use defined color variables
- Maintain consistent spacing using the scale
- Use monospace fonts for technical content
- Apply hover effects consistently across interactive elements

#### Accessibility
- Ensure minimum 4.5:1 contrast ratio
- Use semantic HTML elements
- Provide focus indicators
- Support keyboard navigation

#### Animation Guidelines

/* Standard transitions */
--transition-fast: 0.15s ease;
--transition-normal: 0.2s ease;
--transition-slow: 0.3s ease;

/* Preferred easing */
--ease-out-cubic: cubic-bezier(0.33, 1, 0.68, 1);
--ease-in-out-cubic: cubic-bezier(0.65, 0, 0.35, 1);

### Responsive Breakpoints

/* Mobile first approach */
--bp-sm: 640px;
--bp-md: 768px;
--bp-lg: 1024px;
--bp-xl: 1280px;

### Code Block Styling

.code-block {
background: var(--bg-tertiary);
border: 1px solid var(--border-primary);
border-left: 4px solid var(--primary-green);
padding: var(--space-4);
border-radius: var(--radius-sm);
font-family: var(--font-mono);
color: var(--text-primary);
overflow-x: auto;
}

### Usage Instructions
1. Always use CSS custom properties for colors and spacing
2. Prefer flexbox and grid for layouts
3. Use the monospace font for code, technical content, and navigation
4. Apply the Manjaro green (#35BF5C) sparingly as accent color
5. Maintain dark theme as primary with light text
6. Ensure all interactive elements have hover states
7. Use subtle animations with the defined timing functions

## Standardy kodowania

### Konwencje nazewnictwa

#### Ogólne
- Nazwy klas, metod, zmiennych i atrybutów w języku angielskim
- Nazwy wyświetlane dla użytkownika w języku polskim
- Nazwy plików zgodne z konwencjami Laravel i Filament

#### Klasy i nazwy plików
- **Modele**: rzeczowniki w liczbie pojedynczej, PascalCase (np. `Photo`, `Message`, `HeroSettings`)
- **Kontrolery**: rzeczowniki + "Controller", PascalCase (np. `ContactController`, `HomeController`)
- **Migracje**: snake_case, początek nazwy to timestamp (np. `2025_06_07_091556_create_photos_table`)
- **Seedery**: PascalCase + "Seeder" (np. `SettingsSeeder`, `AdminUserSeeder`)
- **Zasoby Filament**: rzeczowniki + "Resource", PascalCase (np. `PhotoResource`, `MessageResource`)

#### Metody
- **Kontrolery**:
  - `index()` - wyświetlanie listy rekordów
  - `show($id)` - wyświetlanie pojedynczego rekordu
  - `create()` - formularz tworzenia
  - `store(Request $request)` - zapisywanie nowego rekordu
  - `edit($id)` - formularz edycji
  - `update(Request $request, $id)` - aktualizacja rekordu
  - `destroy($id)` - usuwanie rekordu

- **Modele**:
  - metody relacji w liczbie mnogiej dla hasMany/belongsToMany (np. `photos()`)
  - metody relacji w liczbie pojedynczej dla hasOne/belongsTo (np. `user()`)
  - metody pomocnicze opisowe, w formie czasowników (np. `markAsRead()`)

#### Zmienne
- **Zmienne lokalne**: camelCase (np. `$userSettings`, `$contactForm`)
- **Parametry funkcji**: camelCase (np. `$userId`, `$fileUpload`)
- **Atrybuty prywatne**: rozpoczynające się od znaku podkreślenia (np. `$_configCache`)

#### Stałe
- **Stałe klasowe**: UPPER_SNAKE_CASE (np. `DEFAULT_SORT_FIELD`)

### Struktura projektu

#### Modele

```php
class Photo extends Model
{
    // 1. Użycie traitów
    use HasFactory;
    
    // 2. Właściwości (properties)
    protected $fillable = [
        'title',
        'description',
        'path',
    ];
    
    protected $casts = [
        'is_featured' => 'boolean',
    ];
    
    // 3. Akcesory i mutatory
    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }
    
    // 4. Relacje - alfabetycznie
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // 5. Metody pomocnicze - alfabetycznie
    public function getImageUrl()
    {
        return asset('storage/' . $this->path);
    }
    
    // 6. Scope'y
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
```

#### Kontrolery

```php
class ContactController extends Controller
{
    // 1. Wstrzyknięte zależności
    protected $validator;
    
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }
    
    // 2. Metody CRUD zgodnie z kolejnością: index, create, store, show, edit, update, destroy
    
    // 3. Metody prywatne pomocnicze na końcu
    private function processContactForm($data)
    {
        // logika przetwarzania
    }
}
```

### Zasoby Filament

#### Formularze

```php
public static function form(Form $form): Form
{
    return $form
        ->schema([
            // 1. Najpierw sekcje ogólne
            Section::make('Informacje podstawowe')
                ->schema([
                    TextInput::make('title')
                        ->label('Tytuł')
                        ->required()
                        ->maxLength(255),
                    
                    Textarea::make('description')
                        ->label('Opis')
                        ->maxLength(1000),
                ]),
                
            // 2. Potem sekcje z opcjami zaawansowanymi
            Section::make('Opcje zaawansowane')
                ->schema([
                    Toggle::make('is_featured')
                        ->label('Wyróżnione'),
                ])
                ->collapsible(),
                
            // 3. Na końcu sekcje relacji jeśli są wyświetlane w formularzu
        ]);
}
```

#### Tabele

```php
public static function table(Table $table): Table
{
    return $table
        ->columns([
            // 1. Podstawowe kolumny identyfikacyjne
            TextColumn::make('id'),
            TextColumn::make('title'),
            
            // 2. Kolumny opisowe
            TextColumn::make('description')
                ->limit(50),
            
            // 3. Kolumny relacji
            TextColumn::make('user.name'),
            
            // 4. Kolumny stanu/statusu
            IconColumn::make('is_featured')
                ->boolean(),
            
            // 5. Kolumny dat
            TextColumn::make('created_at')
                ->dateTime()
                ->sortable(),
        ])
        ->filters([
            // Filtry alfabetycznie
        ])
        ->actions([
            // Akcje
        ]);
}
```

## Standardy bazy danych

### Tabele
- Nazwy tabel w liczbie mnogiej, snake_case (np. `photos`, `users`, `hero_settings`)
- Prefiksy dla tabel powiązań (np. `photo_tag` dla tabeli powiązań)
- Domyślne kolumny:
  - `id` - klucz główny
  - `created_at` i `updated_at` - znaczniki czasu

### Kolumny
- Nazwy w snake_case
- Klucze obce nazywane jako `{nazwa_tabeli_w_liczbie_poj}_id` (np. `user_id`)
- Unikanie skrótów w nazwach kolumn
- Określanie domyślnych wartości dla kolumn gdzie to możliwe
- Stosowanie odpowiednich typów danych (np. `boolean` zamiast `tinyint(1)`)

### Indeksy
- Kolumny używane w zapytaniach WHERE powinny być indeksowane
- Klucze obce powinny być indeksowane
- Nazwy indeksów w formacie: `{tabela}_{kolumna(y)}_{typ}` (np. `users_email_unique`)

## Standardy widoków Blade

### Komponenty
- Używanie komponentów Blade dla powtarzalnych elementów
- Nazwy w kebab-case (np. `<x-alert-message />`)
- Organizacja w katalogach według przeznaczenia (np. `/ui`, `/forms`, `/layout`)

### Struktura szablonów
- Sekcja `@section('title')` zawsze zdefiniowana
- Unikanie bezpośredniego osadzania CSS/JS w widoku
- Wykorzystanie szablonu głównego (`main.blade.php`) jako układu bazowego

```blade
@extends('layouts.main')

@section('title', 'Tytuł strony')

@section('content')
    <div class="container">
        <h1>Nagłówek strony</h1>
        
        <x-alert type="success" :message="$message" />
        
        <div class="content">
            <!-- Treść strony -->
        </div>
    </div>
@endsection
```

## Dobre praktyki

### Walidacja
- Walidacja danych w Request lub w kontrolerze (ale nie w modelu)
- Używanie niestandardowych klas Request dla złożonej walidacji
- Stosowanie walidacji po stronie frontendu jako dodatkowej, ale nie jedynej

### Komunikaty błędów
- Wyświetlanie błędów w komponencie Blade
- Precyzyjne komunikaty błędów
- Ujednolicony wygląd komunikatów

### Środowisko Docker
- Ustawienia w `.env` zgodne z konfiguracją Docker
- Zmienne środowiskowe dla wszystkich krytycznych ustawień
- Mapowanie volumenów dla przyspieszenia developmentu

### Bezpieczeństwo
- Filtrowanie danych wejściowych
- Używanie autoryzacji w Filament 
- CSRF ochrona dla wszystkich formularzy
- Poprawna konfiguracja CORS