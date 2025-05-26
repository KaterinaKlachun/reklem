# Используем официальный PHP-образ с нужными расширениями
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

# Устанавливаем рабочую директорию
WORKDIR /var/www

# Копируем только файлы Composer для кэширования слоёв
COPY composer.json composer.lock ./

# Копируем artisan, чтобы composer install не упал
COPY artisan artisan

# Устанавливаем зависимости Laravel
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader

# Копируем всё остальное
COPY . .

# Устанавливаем Node-зависимости и билдим фронтенд
RUN npm ci && npm run build

# Кешируем конфигурации Laravel
RUN php artisan config:clear \
 && php artisan route:clear \
 && php artisan view:clear \
 && php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache

# Устанавливаем правильные права
RUN chown -R www-data:www-data /var/www

# Копируем конфиг Nginx
COPY nginx/nginx.conf /etc/nginx/nginx.conf

# Меняем сокет на порт для php-fpm
RUN sed -i 's|listen = /run/php/php-fpm.sock|listen = 9000|' /usr/local/etc/php-fpm.d/www.conf

# Открываем порт 80
EXPOSE 80

# Запускаем и PHP, и Nginx
CMD php-fpm -D && nginx -g "daemon off;"
