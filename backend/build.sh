#!/bin/bash

# Script de build para Render.com
# Este script se ejecuta automáticamente durante el despliegue

echo "🔨 Iniciando build del backend..."

# Instalar dependencias
composer install --no-dev --optimize-autoloader

# Generar clave de aplicación
php artisan key:generate --force

# Limpiar caché
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Ejecutar migraciones
php artisan migrate --force

# Ejecutar seeders
php artisan db:seed --force

# Optimizar para producción
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Build completado!"

