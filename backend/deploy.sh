#!/usr/bin/env bash
set -e

# Parse DATABASE_URL FIRST, before any Laravel commands
if [ -n "$DATABASE_URL" ]; then
    echo "Parsing DATABASE_URL..."
    echo "DATABASE_URL: ${DATABASE_URL:0:50}..." # Show first 50 chars for debugging
    
    # Set DB_URL for Laravel (Laravel uses DB_URL)
    export DB_URL="$DATABASE_URL"
    
    # Also parse and set individual variables as fallback
    # Parse postgresql://user:pass@host:port/database
    # Remove protocol prefix first
    DB_STRING="${DATABASE_URL#postgresql://}"
    
    # Extract components
    DB_USER_PASS="${DB_STRING%%@*}"
    DB_USERNAME="${DB_USER_PASS%%:*}"
    DB_PASSWORD="${DB_USER_PASS#*:}"
    
    DB_HOST_PORT_DB="${DB_STRING#*@}"
    DB_HOST_PORT="${DB_HOST_PORT_DB%%/*}"
    DB_HOST="${DB_HOST_PORT%%:*}"
    DB_PORT="${DB_HOST_PORT#*:}"
    DB_DATABASE="${DB_HOST_PORT_DB#*/}"
    
    # Remove query string if present
    DB_DATABASE="${DB_DATABASE%%\?*}"
    
    export DB_USERNAME
    export DB_PASSWORD
    export DB_HOST
    export DB_PORT="${DB_PORT:-5432}"
    export DB_DATABASE
    export DB_CONNECTION="pgsql"
    
    echo "Database configuration parsed successfully"
    echo "Host: $DB_HOST"
    echo "Port: $DB_PORT"
    echo "Database: $DB_DATABASE"
    echo "Username: $DB_USERNAME"
fi

echo "Running composer..."
composer install --no-dev --optimize-autoloader --working-dir=/var/www/html

echo "Verifying database variables..."
echo "DB_CONNECTION: ${DB_CONNECTION:-not set}"
echo "DB_HOST: ${DB_HOST:-not set}"
echo "DB_DATABASE: ${DB_DATABASE:-not set}"

echo "Caching config..."
# Clear config cache first to ensure fresh read
php artisan config:clear
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

