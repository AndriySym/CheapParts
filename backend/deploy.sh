#!/usr/bin/env bash
set -e

echo "Running composer..."
composer install --no-dev --optimize-autoloader --working-dir=/var/www/html

# Parse DATABASE_URL if it exists and set individual DB variables
if [ -n "$DATABASE_URL" ]; then
    echo "Parsing DATABASE_URL..."
    # Parse postgresql://user:pass@host:port/database
    DB_URL_REGEX="postgresql://([^:]+):([^@]+)@([^:]+):([^/]+)/(.+)"
    if [[ $DATABASE_URL =~ $DB_URL_REGEX ]]; then
        export DB_USERNAME="${BASH_REMATCH[1]}"
        export DB_PASSWORD="${BASH_REMATCH[2]}"
        export DB_HOST="${BASH_REMATCH[3]}"
        export DB_PORT="${BASH_REMATCH[4]}"
        export DB_DATABASE="${BASH_REMATCH[5]}"
        export DB_URL="$DATABASE_URL"
        echo "Database configuration parsed successfully"
    fi
fi

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Caching views..."
php artisan view:cache

echo "Running migrations..."
php artisan migrate --force

echo "Running seeders..."
php artisan db:seed --force

echo "Starting nginx..."
exec /start.sh

