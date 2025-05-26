# Используем официальный PHP-образ
FROM php:8.2-fpm

# Устанавливаем зависимости PHP и системные пакеты
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev libzip-dev libpq-dev \
    nginx nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql mbstring zip exif pcntl gd bcmath \
    && apt-get clean

# Устанавливаем Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Рабочая директория
WORKDIR /var/www

# Копируем весь проект (и artisan, и bootstrap, и vendor/* если есть)
COPY . .

# Устанавливаем зависимости Laravel
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader

# Ставим зависимости Node и билдим ассеты
RUN npm ci && npm run build

# Кешируем конфиги Laravel
RUN php artisan config:clear \
 && php artisan route:clear \
 && php artisan view:clear \
 && php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache

# Ставим права
RUN chown -R www-data:www-data /var/www
RUN chmod -R 775 storage bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache

# Конфиг Nginx
COPY nginx/nginx.conf /etc/nginx/nginx.conf

# Меняем сокет на порт
RUN sed -i 's|listen = /run/php/php-fpm.sock|listen = 9000|' /usr/local/etc/php-fpm.d/www.conf

# Порт
EXPOSE 80

# Запускаем PHP-FPM и Nginx
CMD php-fpm -D && nginx -g "daemon off;"
