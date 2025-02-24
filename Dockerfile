FROM php:8.3-fpm

WORKDIR /var/www/html

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
 && rm -rf /var/lib/apt/lists/*

# Instalar extensión pdo_mysql
RUN docker-php-ext-install pdo pdo_mysql

# Copiar Composer desde la imagen oficial de Composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Copiar solo los archivos de Composer para aprovechar la caché de Docker
COPY composer.json composer.lock ./

# Instalar dependencias de Composer
RUN composer install --no-dev --optimize-autoloader

# Copiar el resto del código de la aplicación
COPY . .

EXPOSE 9000
CMD ["php-fpm"]
