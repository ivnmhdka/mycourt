# ----------------------
# Stage 1: Build Frontend Assets
# ----------------------
FROM node:18-alpine as frontend
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run build

# ----------------------
# Stage 2: Serve Application
# ----------------------
FROM php:8.2-cli

WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existsing application directory contents
COPY . .

# Copy built frontend assets from Stage 1
COPY --from=frontend /app/public/build /var/www/public/build

# Install dependencies (production optimized)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Permissions
RUN chmod -R 775 storage bootstrap/cache

# Expose port (Railway will override this via $PORT, but 8000 is default for artisan)
EXPOSE 8080

# Start command
# Using sh -c to ensure environment variables are expanded correctly in the CMD
CMD sh -c "php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"
