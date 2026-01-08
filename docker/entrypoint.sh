#!/bin/bash

# Terminate on error
set -e

echo "Deploying on PORT: ${PORT}"

# Configure Nginx to listen on Railway's dynamic PORT
if [ -n "$PORT" ]; then
    sed -i "s/listen 80;/listen ${PORT};/g" /etc/nginx/sites-enabled/default
fi

# Verify Nginx Config
echo "Testing Nginx Config..."
nginx -t

# Show modified config (first few lines) to verify sed
echo "Nginx Config Head:"
head -n 10 /etc/nginx/sites-enabled/default

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start Nginx
echo "Starting Nginx..."
nginx

# Check if Nginx is running
echo "Process List:"
ps aux | grep nginx

# Start PHP-FPM
echo "Starting PHP-FPM..."
php-fpm
