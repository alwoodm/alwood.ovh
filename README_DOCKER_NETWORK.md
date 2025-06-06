## Konfiguracja sieci Docker i dostęp do internetu

### Sieci w projekcie

Domyślnie w pliku `docker-compose.yml` sieć `laravel_internal` ma wyłączoną flagę `internal: true`:

```yaml
networks:
  laravel_internal:
    driver: bridge
    internal: false  # Domyślnie wyłączone dla dostępu do internetu
```

Dzięki temu kontenery mają dostęp do internetu, co jest konieczne do:
- Pobierania zależności Composer
- Aktualizacji pakietów npm
- Dostępu do zewnętrznych API

### Problemy z połączeniem internetowym

Jeśli napotkasz problemy z pobieraniem zależności z internetu, upewnij się, że:

1. Sieć Docker nie ma ustawionej flagi `internal: true`
2. DNS działa poprawnie (sprawdź konfigurację `/etc/resolv.conf` w kontenerach)
3. Firewall nie blokuje ruchu wychodzącego z kontenerów

Typowy problem z DNS może wyglądać tak:
```
The following exception probably indicates you are offline or have misconfigured DNS resolver(s)
In CurlDownloader.php line 390:
curl error 6 while downloading https://api.github.com/: Could not resolve host: api.github.com
```

### Zmiana konfiguracji na sieć wewnętrzną

Jeśli ze względów bezpieczeństwa potrzebujesz użyć sieci wewnętrznej (bez dostępu do internetu), zmień konfigurację w `docker-compose.yml`:

```yaml
networks:
  laravel_internal:
    driver: bridge
    internal: true
```

Pamiętaj, że po tej zmianie:
1. Musisz wcześniej zainstalować wszystkie zależności
2. Kontenery nie będą miały dostępu do internetu
3. Będziesz potrzebował kontenera dostępowego do komunikacji z aplikacją
