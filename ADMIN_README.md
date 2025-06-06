# Panel administracyjny Portfolio

Ten projekt zawiera panel administracyjny zbudowany przy użyciu Filament w Laravel. Poniżej znajdują się informacje na temat dostępu i korzystania z panelu.

## Dostęp do panelu administracyjnego

1. Uruchom aplikację za pomocą:
   ```bash
   # Jeśli używasz Dockera
   docker-compose up -d
   
   # Lub za pomocą serwera deweloperskiego Laravel
   php artisan serve
   ```

2. Panel administracyjny jest dostępny pod adresem:
   - Przy użyciu Dockera: `http://localhost:8000/admin`
   - Przy użyciu serwera deweloperskiego: `http://127.0.0.1:8000/admin`

## Dane logowania domyślnego administratora

- **Email**: admin@alwood.ovh
- **Hasło**: password

## Funkcje panelu administracyjnego

1. **Zarządzanie użytkownikami**
   - Lista wszystkich użytkowników
   - Tworzenie nowych użytkowników
   - Edycja danych użytkowników
   - Resetowanie haseł użytkowników
   - Usuwanie użytkowników

## Bezpieczeństwo

Ze względów bezpieczeństwa zaleca się:
1. Zmianę hasła domyślnego administratora po pierwszym logowaniu
2. Regularne aktualizowanie haseł użytkowników
3. Ograniczenie dostępu do panelu administracyjnego tylko do zaufanych adresów IP w środowisku produkcyjnym

## Docker

Aplikacja jest skonfigurowana do pracy z Dockerem za pomocą docker-compose. 
Usługi zawarte w konfiguracji:
- **app**: Serwer aplikacji PHP
- **nginx**: Serwer web
- **db**: Baza danych MySQL
- **redis**: Serwer Redis dla cache i kolejek
