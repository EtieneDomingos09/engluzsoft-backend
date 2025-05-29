FROM laravelsail/php82-composer

# Instala dependências adicionais que o Sail ainda não cobre
RUN apt-get update && apt-get install -y \
    unzip \
    libpng-dev \
    libzip-dev \
    libonig-dev \
    zip \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql

# Define diretório de trabalho
WORKDIR /var/www

# Copia os arquivos da aplicação
COPY . .

# Instala dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Ajusta permissões
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Comando padrão
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
