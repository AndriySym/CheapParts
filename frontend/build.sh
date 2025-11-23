#!/bin/bash

# Script de build para Render.com
# Este script se ejecuta automáticamente durante el despliegue

echo "🔨 Iniciando build del frontend..."

# Instalar dependencias
npm install

# Verificar que sweetalert2 esté instalado
if [ ! -d "node_modules/sweetalert2" ]; then
  echo "⚠️  sweetalert2 no encontrado, reinstalando..."
  npm install sweetalert2@^11.26.3
fi

# Build de producción
npm run build

echo "✅ Build completado!"

