FROM php:8.2-fpm

# Instala extensões e dependências
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
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

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define diretório de trabalho
WORKDIR /var/www

# Copia os arquivos da aplicação
COPY . .

# Instala dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Permissões (ajuste conforme necessário)
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Comando padrão
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
