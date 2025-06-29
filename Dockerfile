FROM webdevops/php-nginx:8.2

WORKDIR /var/www/html

COPY . .

COPY docker/nginx/default.conf /opt/docker/etc/nginx/vhost.conf

RUN composer install --no-dev --optimize-autoloader \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

EXPOSE 80
CMD ["supervisord"]