FROM php:8.2-cli

WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libsqlite3-dev \
    && docker-php-ext-install zip mbstring pdo pdo_sqlite

# Copy composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Ensure SQLite database file exists
RUN mkdir -p database && \
    touch database/database.sqlite

# Set proper permissions
RUN chmod -R 775 storage bootstrap/cache database

EXPOSE 10000

# Run migrations automatically, then start server
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000
