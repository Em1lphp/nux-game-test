#!/bin/bash
set -e

cd /code/src

# Composer install
if [ ! -d "vendor" ]; then
    echo "📦 Installing composer dependencies..."
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

# Generate app key
if [ -f ".env" ]; then
    APP_KEY_VALUE=$(grep '^APP_KEY=' .env | cut -d '=' -f2-)

    if [ -z "$APP_KEY_VALUE" ]; then
        echo "🔑 Generating app key..."
        php artisan key:generate
    fi
fi

exec "$@"
