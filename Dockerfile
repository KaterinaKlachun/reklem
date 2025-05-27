FROM php:8.2-fpm

# Установка системных зависимостей
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    nodejs \
    npm \
    nginx \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql mbstring zip exif pcntl gd bcmath \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Установка Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Установка рабочей директории
WORKDIR /var/www

# Создание необходимых директорий и установка базовых прав
RUN mkdir -p /var/log/php \
    && mkdir -p /var/www/storage/logs \
    && mkdir -p /var/www/bootstrap/cache \
    && touch /var/log/php/php_errors.log \
    && chown -R www-data:www-data /var/log/php \
    && chmod -R 755 /var/log/php

# Копирование файлов проекта
COPY --chown=www-data:www-data . /var/www

# Установка зависимостей PHP
RUN composer install --no-dev --optimize-autoloader

# Установка зависимостей Node.js и сборка фронтенда
RUN npm install && \
    npm run build && \
    npm cache clean --force && \
    rm -rf node_modules

# Установка прав на директории Laravel
RUN chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache \
    && chmod -R 755 /var/www/public/build \
    && chmod -R 775 /var/www/storage/logs \
    && chown -R www-data:www-data /var/www/storage \
    && chown -R www-data:www-data /var/www/bootstrap/cache \
    && chown -R www-data:www-data /var/www/public/build

# Копирование конфигурации PHP
COPY docker/php/local.ini /usr/local/etc/php/conf.d/local.ini

# Копирование конфигурации Nginx
COPY docker/nginx/default.conf /etc/nginx/sites-available/default

# Создание .env файла и настройка приложения
RUN cp .env.example .env && \
    php artisan key:generate --force && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Открытие порта
EXPOSE 80

# Создание скрипта для запуска
RUN echo '#!/bin/bash\n\
service nginx start\n\
php-fpm\n\
' > /usr/local/bin/start.sh && \
    chmod +x /usr/local/bin/start.sh

# Запуск Nginx и PHP-FPM
CMD ["/usr/local/bin/start.sh"]
