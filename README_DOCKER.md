# Docker dla Laravel Portfolio

Ten dokument zawiera informacje na temat konfiguracji Docker dla projektu Laravel Portfolio.

## Struktura projektu

```
portfolio/
├── app/               # Kod aplikacji Laravel
├── docker/            # Konfiguracje Docker
│   ├── mysql/         # Konfiguracja MySQL
│   ├── nginx/         # Konfiguracja Nginx
│   └── php/           # Konfiguracja PHP
├── Dockerfile         # Plik Dockerfile dla PHP
└── docker-compose.yml # Konfiguracja Docker Compose
```

## Architektura Docker

Projekt wykorzystuje następujące kontenery:

1. **app** - Serwer PHP-FPM z Laravel
2. **nginx** - Serwer WWW
3. **db** - Baza danych MySQL
4. **redis** - Serwer Redis dla cache i kolejek

## Sieci Docker

Projekt używa dwóch sieci:
- **laravel_internal** - Sieć typu bridge internal dla komunikacji wewnętrznej między kontenerami
- **laravel_external** - Sieć bridge do komunikacji z zewnątrz (tylko dla Nginx)

## Uruchomienie projektu

Aby uruchomić projekt, wykonaj następujące kroki:

1. Upewnij się, że masz zainstalowany Docker i Docker Compose
2. Skopiuj plik `.env.example` do `.env` i dostosuj ustawienia:
   ```
   cp .env.example .env
   ```
3. Zbuduj i uruchom kontenery:
   ```
   docker-compose up -d
   ```
4. Zainstaluj zależności Composer:
   ```
   docker-compose exec app composer install
   ```
5. Wygeneruj klucz aplikacji:
   ```
   docker-compose exec app php artisan key:generate
   ```
6. Wykonaj migracje bazy danych:
   ```
   docker-compose exec app php artisan migrate
   ```

## Dostęp do aplikacji

Aplikacja będzie dostępna pod adresem: http://localhost:8000

## Przydatne komendy

- Sprawdzenie logów:
  ```
  docker-compose logs -f
  ```
- Wejście do kontenera PHP:
  ```
  docker-compose exec app bash
  ```
- Zatrzymanie kontenerów:
  ```
  docker-compose down
  ```
