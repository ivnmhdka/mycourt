#!/bin/bash

# Terminate on error
set -e

echo "Deploying on PORT: ${PORT:-80}"

# -----------------------------------------------------------------------------
# 1. Configure Nginx
# -----------------------------------------------------------------------------
# Replaces 'listen 80;' with 'listen $PORT;'
if [ -n "$PORT" ]; then
    sed -i "s/listen 80;/listen ${PORT};/g" /etc/nginx/sites-enabled/default
fi

# -----------------------------------------------------------------------------
# 2. Configure PHP-FPM (Proactive Fixes)
# -----------------------------------------------------------------------------
# Locate www.conf (varies by distro, usually in /usr/local/etc/php-fpm.d/www.conf)
PHP_CONF="/usr/local/etc/php-fpm.d/www.conf"

if [ -f "$PHP_CONF" ]; then
    echo "Configuring PHP-FPM at $PHP_CONF"
    
    # Force listen on 127.0.0.1:9000 (Matches Nginx fastcgi_pass)
    sed -i 's/^listen = .*/listen = 127.0.0.1:9000/' "$PHP_CONF"
    
    # Ensure environment variables are not cleared (Critical for Laravel)
    sed -i 's/^;clear_env = no/clear_env = no/' "$PHP_CONF"
    
    # Enable worker output for debugging
    sed -i 's/^;catch_workers_output = yes/catch_workers_output = yes/' "$PHP_CONF"
else
    echo "WARNING: $PHP_CONF not found. Skipping PHP config tweaks."
fi

# -----------------------------------------------------------------------------
# 3. Application Setup
# -----------------------------------------------------------------------------
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# -----------------------------------------------------------------------------
# 4. Start Services
# -----------------------------------------------------------------------------
# Start PHP-FPM in background (daemon mode)
echo "Starting PHP-FPM..."
php-fpm -D

# Wait for PHP-FPM to start
sleep 1

# Start Nginx in foreground
echo "Starting Nginx..."
nginx -g "daemon off;"
