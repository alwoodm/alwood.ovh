FROM php:8.3-fpm

# Argumenty używane podczas budowania
ARG user=laravel
ARG uid=1000

# Instalacja zależności systemowych
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    nodejs \
    npm

# Czyszczenie cache apt-get
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalacja zależności dla rozszerzenia intl
RUN apt-get update && apt-get install -y \
    libicu-dev

# Instalacja rozszerzeń PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

# Pobierz najnowszą wersję Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Tworzenie użytkownika systemowego dla uruchamiania poleceń Composer i Artisan
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Ustawienie katalogu roboczego
WORKDIR /var/www

# Kopiowanie plików aplikacji
COPY . /var/www

# Ustawienie właściciela plików aplikacji
RUN chown -R $user:$user /var/www

# Przełączenie na użytkownika laravel
USER $user

# Eksponowanie portu PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
