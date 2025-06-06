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
docker-compose up -d --build

# Czekanie aż kontenery będą gotowe
echo "Czekanie na uruchomienie kontenerów..."
sleep 5

# Instalacja zależności i konfiguracja Laravel
echo "Instalacja zależności Composer..."
docker-compose exec app composer install

echo "Generowanie klucza aplikacji..."
docker-compose exec app php artisan key:generate

echo "Uruchamianie migracji bazy danych..."
docker-compose exec app php artisan migrate:fresh

echo "Czyszczenie cache..."
docker-compose exec app php artisan optimize:clear

# Wyświetlanie informacji o aplikacji
echo ""
echo "=== Środowisko Docker zostało pomyślnie skonfigurowane ==="
echo "Aplikacja dostępna pod adresem: http://localhost:8000"
echo ""
echo "Aby uruchomić kontener dostępowy (jeśli sieci są wewnętrzne):"
echo "docker-compose -f docker-compose.access.yml up -d"
echo ""
echo "Przydatne komendy:"
echo "- docker-compose exec app bash    # Wejście do kontenera PHP"
echo "- docker-compose logs -f          # Podgląd logów"
echo "- docker-compose down             # Zatrzymanie kontenerów"
