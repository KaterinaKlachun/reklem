FROM php:8.2-apache

# Установка необходимых расширений PHP
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установка Node.js
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Настройка Apache
RUN a2enmod rewrite
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Копирование файлов проекта
WORKDIR /var/www/html
COPY . .

# Установка зависимостей
RUN composer install --no-dev --optimize-autoloader \
    && npm install \
    && npm run build

# Настройка прав доступа
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

EXPOSE 8080

# Запуск Apache
CMD ["apache2-foreground"]
