# Instrukcje uruchomienia

Po wprowadzeniu zmian, wykonaj następujące kroki:

1. Przeprowadź migrację bazy danych:
```
php artisan migrate
```

2. Uruchom seeder ustawień:
```
php artisan db:seed --class=SettingsSeeder
```

3. Przebuduj cache autoload:
```
composer dump-autoload
```

4. Wyczyść cache konfiguracji:
```
php artisan config:clear
php artisan cache:clear
```

## Jak to działa

### Panel Administracyjny
- W panelu administracyjnym (`/admin`) znajduje się sekcja "Ustawienia", gdzie możesz edytować:
  - Adres email kontaktowy
  - Link do GitHub
  - Link do LinkedIn
  - Tekst "Made by" w stopce

### Zmiany w widokach
- W nagłówku i tytule strony zamiast hardkodowanego "alwood" używana jest wartość z `APP_NAME` z pliku `.env`
- W stopce tekst "Made by" jest pobierany z ustawień
- W sekcji kontaktowej linki do emaila, GitHub i LinkedIn są pobierane z bazy danych

### Dodatkowe funkcje
- Dodano pomocniczą funkcję `settings()`, którą możesz używać w widokach do pobierania wartości ustawień, np. `settings('contact_email')`
