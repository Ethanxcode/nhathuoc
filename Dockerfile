# Sử dụng hình ảnh Railway Nixpacks làm cơ sở
FROM ghcr.io/railwayapp/nixpacks:ubuntu-1716249803

# Thiết lập thư mục làm việc
WORKDIR /app

# Sao chép tệp cấu hình Nixpacks
COPY .nixpacks /app/.nixpacks

# Sao chép toàn bộ mã nguồn của bạn vào container
COPY . /app

# Cài đặt các phụ thuộc PHP và Node.js
RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
  && npm install \
  && npm run prod

# Thiết lập các tệp cache và migrate cơ sở dữ liệu
RUN php artisan migrate --force \
  && php artisan config:cache \
  && php artisan route:cache \
  && php artisan view:cache

# Chạy PHP-FPM và Nginx
CMD ["sh", "-c", "php-fpm && nginx -g 'daemon off;'"]
