# Docker dla Laravel Portfolio

Ten dokument zawiera informacje na temat konfiguracji Docker dla projektu Laravel Portfolio.

## Struktura projektu

```
portfolio/
├── app/               # Kod aplikacji Laravel
├── docker/            # Konfiguracje Docker
│   ├── mysql/         # Konfiguracja MySQL
│   ├── nginx/         # Konfiguracja Nginx
│   ├── php/           # Konfiguracja PHP
│   └── nginx-proxy.conf # Konfiguracja dla kontenera dostępowego
├── Dockerfile         # Plik Dockerfile dla PHP
├── docker-compose.yml # Podstawowa konfiguracja Docker Compose
└── docker-compose.access.yml # Konfiguracja kontenera dostępowego
```

## Architektura Docker

Projekt wykorzystuje następujące kontenery:

1. **app** - Serwer PHP-FPM z Laravel
2. **nginx** - Serwer WWW
3. **db** - Baza danych MySQL
4. **redis** - Serwer Redis dla cache i kolejek
5. **access** - Kontener Nginx służący jako proxy do dostępu z zewnątrz (opcjonalnie)

## Sieci Docker

Projekt używa dwóch sieci:
- **laravel_internal** - Sieć typu bridge dla komunikacji wewnętrznej między kontenerami
- **access_external** - Sieć dla kontenera dostępowego (opcjonalnie)

Konfiguracja jest elastyczna - domyślnie sieć `laravel_internal` nie jest wewnętrzna (nie ma flagi `internal: true`), co pozwala na dostęp do internetu z kontenerów. Jest to konieczne do pobierania zależności Composera. Jeśli wymagana jest większa izolacja, można ustawić `internal: true`, ale wtedy kontenery nie będą miały dostępu do internetu i trzeba będzie skorzystać z kontenera dostępowego.

## Uruchomienie projektu

Aby uruchomić projekt, wykonaj następujące kroki:

1. Upewnij się, że masz zainstalowany Docker i Docker Compose (wymagana wersja co najmniej 2.0)

### Metoda automatyczna (zalecana)

Użyj przygotowanego skryptu inicjalizacyjnego:
   ```
   ./docker-init.sh
   ```

Skrypt ten automatycznie wykona wszystkie niezbędne kroki, w tym:
- Kopiowanie pliku `.env.example` do `.env`
- Tworzenie pliku bazy danych SQLite (jeśli to konfiguracja SQLite)
- Budowanie i uruchamianie kontenerów
- Instalację zależności Composer
- Generowanie klucza aplikacji
- Uruchomienie migracji bazy danych

### Metoda manualna

Wykonaj kolejno poniższe kroki:

1. Skopiuj plik `.env.example` do `.env` i dostosuj ustawienia:
   ```
   cp .env.example .env
   ```
2. Zbuduj i uruchom kontenery:
   ```
   docker-compose up -d
   ```
3. Zainstaluj zależności Composer:
   ```
   docker-compose exec app composer install
   ```
4. Wygeneruj klucz aplikacji:
   ```
   docker-compose exec app php artisan key:generate
   ```
5. Wykonaj migracje bazy danych:
   ```
   docker-compose exec app php artisan migrate
   ```

## Dostęp do aplikacji

W domyślnej konfiguracji aplikacja będzie dostępna pod adresem http://localhost:8000.

Jeśli włączysz flagę `internal: true` dla sieci `laravel_internal` w `docker-compose.yml`, 
aplikacja nie będzie dostępna bezpośrednio z hosta. 
Aby uzyskać dostęp do aplikacji, będziesz musiał wtedy uruchomić dodatkowy kontener dostępowy.

### Uruchamianie kontenera dostępowego

Masz już przygotowany plik `docker-compose.access.yml` z następującą zawartością:

```yaml
version: '3'

services:
  access:
    image: nginx:alpine
    ports:
      - "8080:80"
    volumes:
      - ./docker/nginx-proxy.conf:/etc/nginx/conf.d/default.conf
    networks:
      - portfolio_laravel_internal
      - access_external

networks:
  portfolio_laravel_internal:
    external: true
  access_external:
    driver: bridge
```

Ten kontener używa pliku konfiguracyjnego `docker/nginx-proxy.conf`:

```nginx
server {
    listen 80;
    
    location / {
        proxy_pass http://portfolio-nginx:80;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
```

Aby uruchomić ten kontener dostępowy:

1. Najpierw upewnij się, że główne kontenery są uruchomione:
   ```bash
   docker-compose up -d
   ```

2. Następnie uruchom kontener dostępowy:
   ```bash
   docker-compose -f docker-compose.access.yml up -d
   ```

Aplikacja będzie wtedy dostępna pod adresem: http://localhost:8080

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

## Znaczenie zmiennej ASSET_URL=/

Zmienna `ASSET_URL=/` w plikach `.env` i `.env.example` określa ścieżkę bazową dla zasobów
aplikacji (CSS, JavaScript, obrazy itd.). Ustawienie jej na `/` sprawia, że wszystkie zasoby będą ładowane
względem głównego katalogu serwera (root URL).

Jest to szczególnie istotne przy pracy z Dockerem i proxy, aby upewnić się, że zasoby są poprawnie odnajdywane 
niezależnie od tego, przez jaki punkt wejścia dostajemy się do aplikacji. Gdyby ta wartość nie była ustawiona,
mogłyby wystąpić problemy z ładowaniem zasobów statycznych przy kierowaniu ruchu przez proxy.

## Problemy z dostępem do internetu

Jeśli masz problemy z dostępem do internetu z kontenerów Docker, sprawdź dokument [README_DOCKER_NETWORK.md](./README_DOCKER_NETWORK.md), który zawiera szczegółowe informacje na temat konfiguracji sieci i rozwiązywania problemów z połączeniem.
