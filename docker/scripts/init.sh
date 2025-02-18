#!/bin/bash

set -e
echo "Instalando dependencias de Composer..."
composer install --no-dev --optimize-autoloader

echo "Creando enlace simbólico ..."
php artisan storage:link

echo "Haciendo una instalación limpia de datos corriendo las migraciones"
php artisan migrate:fresh

echo "Iniciando PHP"
php-fpm
