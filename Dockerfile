FROM php:8.2-fpm

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl

# Установка расширений PHP
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установка рабочей директории
WORKDIR /var/www

# Копирование файлов проекта
COPY . .

# Установка зависимостей проекта
RUN composer install --no-dev --optimize-autoloader

# Генерация ключа приложения
RUN php artisan key:generate

# Кеширование конфигурации и маршрутов
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Установка прав доступа
RUN chown -R www-data:www-data /var/www

# Установка Nginx
RUN apt-get install -y nginx

# Копирование конфигурации Nginx
COPY ./nginx/default.conf /etc/nginx/sites-available/default

# Экспонирование портов
EXPOSE 80

# Запуск Nginx и PHP-FPM
CMD service nginx start && php-fpm
