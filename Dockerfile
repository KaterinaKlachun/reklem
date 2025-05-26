FROM php:8.2-fpm

# Устанавливаем зависимости
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev libzip-dev libpq-dev \
    nginx nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql mbstring zip exif pcntl gd bcmath \
    && apt-get clean

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Указываем рабочую директорию
WORKDIR /var/www

# 👇 Сначала копируем package.json и composer.json — чтобы кэшировать слои
COPY composer.json composer.lock package.json package-lock.json ./

# Устанавливаем зависимости
RUN composer install --no-dev --optimize-autoloader
RUN npm ci

# 👇 Потом копируем всё остальное
COPY . .

# Билдим ассеты
ARG ASSET_URL
ENV ASSET_URL=${ASSET_URL}
RUN npm run build

# Laravel кеш
RUN php artisan config:clear && \
    php artisan config:cache && \
    php artisan view:cache && \
    php artisan route:cache

RUN chown -R www-data:www-data /var/www

COPY nginx/nginx.conf /etc/nginx/nginx.conf

EXPOSE 80

# Fix PHP-FPM socket
RUN sed -i 's|listen = /run/php/php-fpm.sock|listen = 9000|' /usr/local/etc/php-fpm.d/www.conf

CMD php-fpm -D && nginx -g "daemon off;"
