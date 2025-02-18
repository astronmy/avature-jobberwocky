#!/bin/bash

set -e
echo "Instalando dependencias de Composer..."
composer install --no-dev --optimize-autoloader

echo "Creando enlace simbólico ..."
php artisan storage:link

echo "Haciendo una instalación limpia de datos corriendo las migraciones"
php artisan migrate:fresh
php artisan config:clear
php artisan cache:clear
php artisan optimize:clear
composer dump-autoload

echo "Iniciando PHP"
php-fpm
