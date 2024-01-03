#!/bin/sh
cd /var/www/html
chmod 777 -R storage

if [ ! -f ".env" ]; then
    cp .env.example .env
fi
chmod 775 .env
# . .env
# Initialize
composer install
php artisan migrate
php artisan test
# php artisan db:seed --class=DatabaseSeeder
php-fpm
