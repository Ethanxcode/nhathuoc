#!/bin/bash

# Chạy các lệnh Artisan
php artisan storage:link
php artisan migrate --force

# Chạy Apache trong chế độ foreground
apache2-foreground
