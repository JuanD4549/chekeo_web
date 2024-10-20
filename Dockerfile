FROM elrincondeisma/php-for-laravel:8.3.7

RUN apk --no-cache upgrade && \
    apk --no-cache add libpq-dev \
    && docker-php-ext-install pdo_pgsql


WORKDIR /app
COPY . .

RUN composer install
RUN composer require laravel/octane

RUN mkdir -p /app/storage/logs

RUN php artisan octane:install --server="swoole"

CMD php artisan octane:start --server="swoole" --host="0.0.0.0"
EXPOSE 8000