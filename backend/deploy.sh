#!/usr/bin/env bash
set -e

# Parse DATABASE_URL FIRST, before any Laravel commands
if [ -n "$DATABASE_URL" ]; then
    echo "Parsing DATABASE_URL..."
    echo "DATABASE_URL: ${DATABASE_URL:0:50}..." # Show first 50 chars for debugging
    
    # Set DB_URL for Laravel (Laravel uses DB_URL)
    export DB_URL="$DATABASE_URL"
    
    # Also parse and set individual variables as fallback
    # Parse postgresql://user:pass@host:port/database or postgresql://user:pass@host/database
    # Remove protocol prefix first
    DB_STRING="${DATABASE_URL#postgresql://}"
    
    # Extract user:password
    DB_USER_PASS="${DB_STRING%%@*}"
    DB_USERNAME="${DB_USER_PASS%%:*}"
    DB_PASSWORD="${DB_USER_PASS#*:}"
    
    # Extract host:port/database or host/database
    DB_HOST_PORT_DB="${DB_STRING#*@}"
    DB_DATABASE="${DB_HOST_PORT_DB#*/}"
    # Remove query string if present
    DB_DATABASE="${DB_DATABASE%%\?*}"
    
    # Extract host and port
    DB_HOST_PORT="${DB_HOST_PORT_DB%%/*}"
    # Check if port is present (contains :)
    if [[ "$DB_HOST_PORT" == *:* ]]; then
        DB_HOST="${DB_HOST_PORT%%:*}"
        DB_PORT="${DB_HOST_PORT#*:}"
    else
        DB_HOST="$DB_HOST_PORT"
        DB_PORT="5432"  # Default PostgreSQL port
    fi
    
    export DB_USERNAME
    export DB_PASSWORD
    export DB_HOST
    export DB_PORT
    export DB_DATABASE
    export DB_CONNECTION="pgsql"
    
    echo "Database configuration parsed successfully"
    echo "Host: $DB_HOST"
    echo "Port: $DB_PORT"
    echo "Database: $DB_DATABASE"
    echo "Username: $DB_USERNAME"
    
    # Update .env file with parsed database configuration
    if [ -f /var/www/html/.env ]; then
        # Update existing .env
        sed -i "s|^DB_CONNECTION=.*|DB_CONNECTION=pgsql|" /var/www/html/.env || echo "DB_CONNECTION=pgsql" >> /var/www/html/.env
        sed -i "s|^DB_HOST=.*|DB_HOST=$DB_HOST|" /var/www/html/.env || echo "DB_HOST=$DB_HOST" >> /var/www/html/.env
        sed -i "s|^DB_PORT=.*|DB_PORT=$DB_PORT|" /var/www/html/.env || echo "DB_PORT=$DB_PORT" >> /var/www/html/.env
        sed -i "s|^DB_DATABASE=.*|DB_DATABASE=$DB_DATABASE|" /var/www/html/.env || echo "DB_DATABASE=$DB_DATABASE" >> /var/www/html/.env
        sed -i "s|^DB_USERNAME=.*|DB_USERNAME=$DB_USERNAME|" /var/www/html/.env || echo "DB_USERNAME=$DB_USERNAME" >> /var/www/html/.env
        sed -i "s|^DB_PASSWORD=.*|DB_PASSWORD=$DB_PASSWORD|" /var/www/html/.env || echo "DB_PASSWORD=$DB_PASSWORD" >> /var/www/html/.env
        sed -i "s|^DB_URL=.*|DB_URL=$DATABASE_URL|" /var/www/html/.env || echo "DB_URL=$DATABASE_URL" >> /var/www/html/.env
    else
        # Create .env from example if it doesn't exist
        if [ -f /var/www/html/.env.example ]; then
            cp /var/www/html/.env.example /var/www/html/.env
        fi
        # Add database config
        echo "DB_CONNECTION=pgsql" >> /var/www/html/.env
        echo "DB_HOST=$DB_HOST" >> /var/www/html/.env
        echo "DB_PORT=$DB_PORT" >> /var/www/html/.env
        echo "DB_DATABASE=$DB_DATABASE" >> /var/www/html/.env
        echo "DB_USERNAME=$DB_USERNAME" >> /var/www/html/.env
        echo "DB_PASSWORD=$DB_PASSWORD" >> /var/www/html/.env
        echo "DB_URL=$DATABASE_URL" >> /var/www/html/.env
    fi
    echo ".env file updated with database configuration"
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

