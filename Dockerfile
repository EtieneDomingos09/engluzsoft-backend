# Usar PHP 8.1 com FPM
FROM php:8.1-fpm

# Instalar dependências e extensões PHP necessárias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libonig-dev \
    libzip-dev \
    zip \
    curl \
    && docker-php-ext-install pdo_mysql mbstring zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www/html

# Copiar os arquivos do projeto para dentro do container
COPY . .

# Instalar dependências do Laravel via Composer
RUN composer install --no-dev --optimize-autoloader

# Ajustar permissões (caso precise)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expor porta que o PHP-FPM vai usar
EXPOSE 9000

# Comando padrão para rodar PHP-FPM
CMD ["php-fpm"]
