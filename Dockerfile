# Sử dụng hình ảnh chính thức của PHP với Apache
FROM php:8.1-apache

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
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql zip \
    && a2enmod rewrite

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Thiết lập thư mục làm việc
WORKDIR /var/www/html

# Sao chép toàn bộ mã nguồn của bạn vào container
COPY . /var/www/html

# Cài đặt các phụ thuộc PHP
RUN composer install --no-dev --optimize-autoloader

# Cài đặt Node.js và npm, sau đó cài đặt các phụ thuộc Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs \
    && npm install \
    && npm run prod

# Thiết lập quyền cho thư mục storage và bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Chạy các lệnh Laravel
RUN php artisan key:generate \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan migrate --force

# Expose port 80
EXPOSE 80

# Khởi động Apache
CMD ["apache2-foreground"]
