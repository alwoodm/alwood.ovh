#!/bin/bash

# Skrypt do inicjalizacji i uruchamiania środowiska Docker dla projektu Laravel

echo "=== Inicjalizacja środowiska Docker dla Laravel Portfolio ==="

# Sprawdzenie czy Docker jest zainstalowany
if ! command -v docker &> /dev/null || ! command -v docker-compose &> /dev/null
then
    echo "Błąd: Docker lub Docker Compose nie są zainstalowane."
    echo "Zainstaluj Docker i Docker Compose przed kontynuowaniem."
    exit 1
fi

# Kopiowanie pliku .env jeśli nie istnieje
if [ ! -f .env ]; then
    echo "Kopiowanie pliku .env.example do .env..."
    cp .env.example .env
    echo "Plik .env został utworzony."
fi

# Sprawdzenie czy DB_CONNECTION jest ustawiony na sqlite lub mysql
DB_CONNECTION=$(grep -E "^DB_CONNECTION=" .env | cut -d'=' -f2)
if [ "$DB_CONNECTION" = "sqlite" ]; then
    echo "Tworzenie pliku SQLite jeśli nie istnieje..."
    mkdir -p database
    touch database/database.sqlite
fi

# Budowanie i uruchamianie kontenerów
echo "Budowanie i uruchamianie kontenerów Docker..."
docker-compose down
docker-compose build --no-cache
docker-compose up -d

# Czekanie aż kontenery będą gotowe
echo "Czekanie na uruchomienie kontenerów..."
sleep 10

# Instalacja zależności i konfiguracja Laravel
echo "Instalacja zależności Composer..."
docker-compose exec app composer install --ignore-platform-req=ext-intl

echo "Ponowna instalacja zależności Composer po zainstalowaniu intl..."
docker-compose exec app composer install

echo "Generowanie klucza aplikacji..."
docker-compose exec app php artisan key:generate

echo "Uruchamianie migracji bazy danych..."
docker-compose exec app php artisan migrate:fresh

echo "Uruchamianie seederów bazy danych..."
docker-compose exec app php artisan db:seed

echo "Instalowanie pakietów node..."
docker-compose exec app npm install

echo "Kompilacja zasobów frontendowych..."
docker-compose exec app npm run build

echo "Czyszczenie cache..."
docker-compose exec app php artisan optimize:clear

# Wyświetlanie informacji o aplikacji
echo ""
echo "=== Środowisko Docker zostało pomyślnie skonfigurowane ==="
echo "Aplikacja dostępna pod adresem: http://localhost:8000"
echo "Panel administracyjny: http://localhost:8000/admin"
echo ""
echo "Dane logowania do panelu administracyjnego:"
echo "Email: admin@domain.example"
echo "Hasło: password"
echo ""
echo "Przydatne komendy:"
echo "- docker-compose exec app bash    # Wejście do kontenera PHP"
echo "- docker-compose logs -f          # Podgląd logów"
echo "- docker-compose down             # Zatrzymanie kontenerów"
