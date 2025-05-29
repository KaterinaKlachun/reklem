FROM php:8.2-apache

# Установка необходимых расширений PHP и зависимостей
RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установка Node.js 20
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

# Настройка Apache
RUN a2enmod rewrite \
    && sed -i 's/Listen 80/Listen 10000/g' /etc/apache2/ports.conf

COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Копирование файлов проекта
WORKDIR /var/www/html
COPY . .

# Установка зависимостей и сборка
RUN composer install --no-dev --optimize-autoloader --no-interaction \
    && npm install \
    && npm run build \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan storage:link \
    && mkdir -p public/build \
    && cp -r public/build/.vite/* public/build/ \
    && rm -rf public/build/.vite

# Настройка прав доступа
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache \
    && chmod -R 755 /var/www/html/public/build \
    && chmod 644 /var/www/html/.htaccess \
    && chmod 644 /var/www/html/public/.htaccess

# Настройка Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf \
    && a2dissite 000-default \
    && a2ensite 000-default \
    && service apache2 restart

EXPOSE 10000

# Запуск Apache
CMD ["apache2-foreground"]
