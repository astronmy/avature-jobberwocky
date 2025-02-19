#!/bin/bash

set -e
echo "Installing composer dependencies..."
composer install  --optimize-autoloader

echo "Making symbolic link ..."
php artisan storage:link

echo "Recreate database instance"
php artisan migrate:fresh

echo "load initial information"
php artisan db:seed

echo "Clean cache and configs"
php artisan config:clear
php artisan cache:clear
php artisan optimize:clear
composer dump-autoload

echo "Run tests"
php artisan test

echo "Start PHP"
php-fpm
