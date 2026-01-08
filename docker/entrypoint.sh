#!/bin/bash

# Terminate on error
set -e

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations (Optional: be careful with this in production if you have multiple replicas)
# php artisan migrate --force

# Start Nginx
nginx

# Start PHP-FPM
php-fpm
