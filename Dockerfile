# Этап сборки Node.js
FROM node:20 AS node

WORKDIR /app

# Копирование файлов для сборки фронтенда
COPY package*.json ./
COPY vite.config.js ./
COPY resources ./resources
COPY public ./public
COPY composer.json composer.lock ./

# Установка Composer и PHP для генерации Ziggy
RUN apt-get update && apt-get install -y \
    php \
    php-xml \
    php-mbstring \
    php-zip \
    unzip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --no-scripts \
    && php artisan ziggy:generate

# Установка зависимостей и сборка
RUN npm install && \
    npm run build

# Основной этап
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
    nginx \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql mbstring zip exif pcntl gd bcmath \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Установка Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Установка рабочей директории
WORKDIR /var/www

# Создание необходимых директорий
RUN mkdir -p /var/log/php \
    && mkdir -p /var/www/storage/logs \
    && mkdir -p /var/www/bootstrap/cache \
    && touch /var/log/php/php_errors.log

# Копирование файлов проекта
COPY . /var/www

# Копирование собранных ассетов из этапа node
COPY --from=node /app/public/build /var/www/public/build

# Установка прав
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache \
    && chmod -R 755 /var/www/public/build \
    && chmod -R 775 /var/www/storage/logs \
    && chown -R www-data:www-data /var/log/php

# Копирование конфигурации PHP
COPY docker/php/local.ini /usr/local/etc/php/conf.d/local.ini

# Копирование конфигурации Nginx
COPY docker/nginx/default.conf /etc/nginx/sites-available/default

# Установка зависимостей PHP
RUN composer install --no-dev --optimize-autoloader

# Создание .env файла и настройка приложения
RUN cp .env.example .env && \
    php artisan key:generate --force && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan storage:link

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
