#!/bin/bash

# Script de build para Render.com
# Este script se ejecuta automáticamente durante el despliegue

echo "🔨 Iniciando build del frontend..."

# Instalar dependencias
npm install

# Build de producción
npm run build

echo "✅ Build completado!"

