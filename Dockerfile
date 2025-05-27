# Этап сборки
FROM php:8.2-cli AS builder

# Установка системных зависимостей
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    nodejs \
    npm \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Установка Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Копирование файлов проекта
COPY . .

# Установка зависимостей PHP
RUN composer install --no-dev --optimize-autoloader

# Генерация Ziggy
RUN php artisan ziggy:generate

# Установка зависимостей Node.js и сборка
RUN npm install && \
    npm run build && \
    npm cache clean --force && \
    rm -rf node_modules

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

# Копирование собранных ассетов из этапа сборки
COPY --from=builder /app/public/build /var/www/public/build

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
