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

# Копирование файлов проекта
COPY . /var/www

# Установка зависимостей PHP
RUN composer install --no-dev --optimize-autoloader

# Установка зависимостей Node.js и сборка фронтенда
RUN npm install && \
    npm run build && \
    npm cache clean --force && \
    rm -rf node_modules

# Создание директории для логов и установка прав
RUN mkdir -p /var/log/php && \
    touch /var/log/php/php_errors.log && \
    chown -R www-data:www-data /var/log/php

# Установка прав
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache \
    && chmod -R 755 /var/www/public/build \
    && chmod -R 777 /var/www/storage/logs

# Копирование конфигурации PHP
COPY docker/php/local.ini /usr/local/etc/php/conf.d/local.ini

# Копирование конфигурации Nginx
COPY docker/nginx/default.conf /etc/nginx/sites-available/default

# Создание .env файла если его нет
RUN if [ ! -f .env ]; then \
    cp .env.example .env && \
    php artisan key:generate; \
    fi

# Очистка кэша
RUN php artisan config:clear && \
    php artisan cache:clear && \
    php artisan view:clear && \
    php artisan route:clear

# Открытие порта
EXPOSE 80

# Запуск Nginx и PHP-FPM
CMD service nginx start && php-fpm
