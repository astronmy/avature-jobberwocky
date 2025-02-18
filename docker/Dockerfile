FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    libonig-dev \
    libxml2-dev \
    libxslt-dev \
    libzip-dev \
    libssl-dev \
    curl \
    git \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd soap zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY ./docker/php/php.ini /usr/local/etc/php/

WORKDIR /var/www

EXPOSE 9000

COPY ./docker/scripts/init.sh /init.sh
RUN chmod +x /init.sh

CMD ["/init.sh"]
