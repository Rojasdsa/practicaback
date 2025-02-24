# Usar la imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instalar extensiones necesarias para Laravel 11
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    curl \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mbstring zip pdo pdo_mysql

# Instalar Composer (gestor de dependencias de PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiamos el archivo de configuración del servidor para que apunte a public
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Configurar permisos correctos para Laravel
WORKDIR /var/www/html 

RUN chown -R www-data:www-data /var/www/html

# Habilitar mod_rewrite de Apache (necesario para Laravel)
RUN a2enmod rewrite

# Exponer el puerto 80
EXPOSE 80

# Comando de inicio
CMD ["apache2-foreground"]
