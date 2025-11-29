FROM php:8.2-cli

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    postgresql-client \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files
COPY composer.json composer.lock ./

# Copy application files first (needed for composer scripts)
COPY . .

# Install dependencies (skip scripts that require artisan)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-scripts

# Run composer scripts after installation
RUN composer dump-autoload --optimize

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Create entrypoint script
RUN echo '#!/bin/bash\n\
set -e\n\
\n\
# Parse DATABASE_URL if provided\n\
if [ -n "$DATABASE_URL" ]; then\n\
    export DB_URL="$DATABASE_URL"\n\
    DB_URL_FOR_PARSE=$(echo "$DATABASE_URL" | sed "s|postgresql://|postgres://|")\n\
    DB_PARSE_RESULT=$(php -r "\
        \$url = parse_url(\"$DB_URL_FOR_PARSE\");\
        echo json_encode([\
            \"host\" => \$url[\"host\"] ?? \"\",\
            \"port\" => \$url[\"port\"] ?? \"5432\",\
            \"user\" => \$url[\"user\"] ?? \"\",\
            \"pass\" => \$url[\"pass\"] ?? \"\",\
            \"path\" => ltrim(\$url[\"path\"] ?? \"\", \"/\")\
        ]);\
    ")\n\
    export DB_HOST=$(echo "$DB_PARSE_RESULT" | php -r "echo json_decode(file_get_contents(\"php://stdin\"))->host;")\n\
    export DB_PORT=$(echo "$DB_PARSE_RESULT" | php -r "echo json_decode(file_get_contents(\"php://stdin\"))->port;")\n\
    export DB_USERNAME=$(echo "$DB_PARSE_RESULT" | php -r "echo json_decode(file_get_contents(\"php://stdin\"))->user;")\n\
    export DB_PASSWORD=$(echo "$DB_PARSE_RESULT" | php -r "echo json_decode(file_get_contents(\"php://stdin\"))->pass;")\n\
    export DB_DATABASE=$(echo "$DB_PARSE_RESULT" | php -r "echo json_decode(file_get_contents(\"php://stdin\"))->path;")\n\
    export DB_CONNECTION="pgsql"\n\
fi\n\
\n\
# Run migrations and seeders\n\
php artisan migrate --force || true\n\
php artisan db:seed --force || true\n\
\n\
# Create storage link\n\
php artisan storage:link || true\n\
\n\
# Start PHP server\n\
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8000}\n\
' > /entrypoint.sh && chmod +x /entrypoint.sh

EXPOSE 8000

ENTRYPOINT ["/entrypoint.sh"]
