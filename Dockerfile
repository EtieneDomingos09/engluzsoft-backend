FROM php:8.1-fpm

# Instalar dependências do sistema e PHP
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libonig-dev \
    libzip-dev \
    libpng-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        mbstring \
        zip \
        tokenizer \
        xml \
        curl

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Instalar dependências Laravel
RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
