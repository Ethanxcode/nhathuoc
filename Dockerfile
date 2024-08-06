FROM php:7.4.1-apache

# Cài đặt các gói cần thiết
RUN apt-get update && apt-get install -y \
    vim wget zip unzip libwebp-dev libjpeg-dev libpng-dev libfreetype6-dev libonig-dev libbz2-dev libzip-dev libxml2-dev libpq-dev

# Cài đặt và cấu hình các extension PHP
RUN docker-php-ext-install ctype fileinfo json mbstring bz2 pdo tokenizer xml zip pgsql pdo_pgsql bcmath gd \
    && docker-php-ext-enable bz2 gd

# Liên kết tệp php.ini-production thành php.ini
RUN ln -s /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini \
    && sed -i -e 's/;extension=pgsql/extension=pgsql/' /usr/local/etc/php/php.ini \
    && sed -i -e 's/;extension=pdo_pgsql/extension=pdo_pgsql/' /usr/local/etc/php/php.ini

# Thiết lập thư mục gốc của Apache
ENV APACHE_DOCUMENT_ROOT=/var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Kích hoạt mod_rewrite và mod_headers
RUN a2enmod rewrite headers

# Sao chép script entrypoint.sh vào container
COPY entrypoint.sh /usr/local/bin/

# Đặt quyền thực thi cho script
RUN chmod +x /usr/local/bin/entrypoint.sh

# Đặt script làm entrypoint của container
ENTRYPOINT ["entrypoint.sh"]
