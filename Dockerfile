# Sử dụng hình ảnh chính thức của PHP với Apache và PHP 7.4.1
FROM php:7.4.1-apache

# Cài đặt các extension PHP cần thiết và các công cụ khác
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    libzip-dev \
    unzip \
    git \
    curl \
    libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip \
    && a2enmod rewrite

# Enable PostgreSQL extensions
RUN ln -s /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini \
    && sed -i -e 's/;extension=pgsql/extension=pgsql/' /usr/local/etc/php/php.ini \
    && sed -i -e 's/;extension=pdo_pgsql/extension=pdo_pgsql/' /usr/local/etc/php/php.ini

# Apache configs + document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Thiết lập thư mục làm việc
WORKDIR /var/www/html

# Tạo và sử dụng một người dùng không phải root
RUN useradd -m appuser
USER appuser

# Sao chép toàn bộ mã nguồn của bạn vào container
COPY --chown=appuser:appuser . /var/www/html

# Sao chép tệp .env.production và tạo tệp .env
COPY --chown=appuser:appuser .env.production /var/www/html/.env

# Cài đặt các phụ thuộc PHP
RUN composer install --no-dev --optimize-autoloader

# Cài đặt Node.js và npm, sau đó cài đặt các phụ thuộc Node.js
USER root
RUN curl -fsSL https://deb.nodesource.com/setup_14.x | bash - \
    && apt-get install -y nodejs \
    && npm install \
    && npm run prod

# Thiết lập quyền cho thư mục storage và bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Chạy các lệnh Laravel
USER appuser
RUN php artisan key:generate \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Trở về root để thực hiện các lệnh yêu cầu quyền root
USER root

# Tạo entrypoint để chạy lệnh migrate khi container khởi động
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Expose port 80
EXPOSE 80

# Khởi động Apache và chạy lệnh migrate
ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
