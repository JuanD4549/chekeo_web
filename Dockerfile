FROM elrincondeisma/php-for-laravel:8.3.7

WORKDIR /app
COPY . .

RUN composer install
RUN composer require laravel/octane
COPY .envDev .env
RUN mkdir -p /app/storage/logs
RUN npm install

RUN php artisan octane:install --server="swoole"

CMD php artisan octane:start --server="swoole" --host="0.0.0.0"
#RUN php artisan migrate --seed
EXPOSE 8000