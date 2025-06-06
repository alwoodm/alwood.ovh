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

Projekt używa jednej sieci:
- **laravel_internal** - Sieć typu bridge internal dla komunikacji wewnętrznej między kontenerami

Ważne: Wszystkie usługi są dostępne tylko poprzez wewnętrzną sieć, co oznacza, że bezpośredni dostęp z hosta nie jest możliwy. Aby dostać się do aplikacji, należy podpiąć inny kontener do tej sieci.

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

Ponieważ stosowana jest sieć typu internal bridge, aplikacja nie będzie dostępna bezpośrednio z hosta. 
Aby uzyskać dostęp do aplikacji, należy podpiąć dodatkowy kontener do sieci `laravel_internal`.

### Przykład kontenera dostępowego

Stwórz nowy plik `docker-compose.access.yml` z następującą zawartością:

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

Oraz plik konfiguracyjny `docker/nginx-proxy.conf`:

```
server {
    listen 80;
    
    location / {
        proxy_pass http://nginx;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
```

Następnie uruchom ten kontener:

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
