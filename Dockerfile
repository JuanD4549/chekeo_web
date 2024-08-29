FROM elrincondeisma/php-for-laravel:8.3.7

WORKDIR /app
COPY . .

RUN composer install
RUN composer require laravel/octane
COPY .envDev .env
RUN mkdir -p /app/storage/logs
RUN npm install
RUN npm run build
RUN php artisan octane:install --server="swoole"

CMD php artisan octane:start --server="swoole" --host="0.0.0.0"
#RUN php artisan migrate --seed
#docker exec -it bdbb97f17948 bash
#docker run -d -p 8000:8000 checkeosqllite
#docker build . -t checkeosqllite
EXPOSE 8000