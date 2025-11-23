#!/usr/bin/env bash
set -e

# Parse DATABASE_URL FIRST, before any Laravel commands
if [ -n "$DATABASE_URL" ]; then
    echo "Parsing DATABASE_URL..."
    echo "DATABASE_URL: ${DATABASE_URL:0:50}..." # Show first 50 chars for debugging
    
    # Set DB_URL for Laravel (Laravel uses DB_URL)
    export DB_URL="$DATABASE_URL"
    
    # Also parse and set individual variables as fallback
    # Use PHP to parse the URL properly (more reliable than bash string manipulation)
    DB_PARSE_RESULT=$(php -r "
        \$url = parse_url('$DATABASE_URL');
        echo json_encode([
            'host' => \$url['host'] ?? '',
            'port' => \$url['port'] ?? '5432',
            'user' => \$url['user'] ?? '',
            'pass' => \$url['pass'] ?? '',
            'path' => ltrim(\$url['path'] ?? '', '/')
        ]);
    ")
    
    DB_HOST=$(echo "$DB_PARSE_RESULT" | php -r "echo json_decode(file_get_contents('php://stdin'))->host;")
    DB_PORT=$(echo "$DB_PARSE_RESULT" | php -r "echo json_decode(file_get_contents('php://stdin'))->port;")
    DB_USERNAME=$(echo "$DB_PARSE_RESULT" | php -r "echo json_decode(file_get_contents('php://stdin'))->user;")
    DB_PASSWORD=$(echo "$DB_PARSE_RESULT" | php -r "echo json_decode(file_get_contents('php://stdin'))->pass;")
    DB_DATABASE=$(echo "$DB_PARSE_RESULT" | php -r "echo json_decode(file_get_contents('php://stdin'))->path;")
    
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

