#!/bin/sh
set -e

# Chạy lệnh migrate
php artisan migrate --force

# Chạy lệnh đã được chỉ định trong Dockerfile (apache2-foreground)
exec "$@"
