# Construir y levantar los contenedores
docker-compose up -d --build

# Instalar Laravel si no lo has instalado aún
docker exec -it jobberwocky_api composer create-project --prefer-dist laravel/laravel .

# Configurar permisos para Laravel
docker exec -it jobberwocky_api chmod -R 777 storage bootstrap/cache

# Generar clave de la aplicación
docker exec -it jobberwocky_api php artisan key:generate

# Migrar la base de datos
docker exec -it jobberwocky_api php artisan migrate
