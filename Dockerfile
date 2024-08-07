FROM php:7.4.1-apache

# Set working directory
WORKDIR /var/www/html

# Install dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    vim wget zip unzip libwebp-dev libjpeg-dev libpng-dev libfreetype6-dev libonig-dev libbz2-dev libzip-dev libxml2-dev libpq-dev \
    && docker-php-ext-install ctype fileinfo json mbstring bz2 pdo tokenizer xml zip bcmath gd \
    && docker-php-ext-enable bz2 gd \
    && ln -s /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

# Set Apache document root to public directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Enable Apache modules
RUN a2enmod rewrite headers

# Set ServerName to suppress warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Set DirectoryIndex to index.php
RUN echo "DirectoryIndex index.php" >> /etc/apache2/apache2.conf

COPY .env.production /var/www/html/.env

# Copy existing application directory contents and set permissions
COPY --chown=www-data:www-data . /var/www/html

# Ensure correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

