# Guía de Despliegue en Render.com

## 📋 Requisitos Previos

1. Cuenta en [Render.com](https://render.com) (gratuita)
2. Repositorio en GitHub con tu proyecto
3. Variables de entorno necesarias

## 🚀 Pasos para Desplegar

### 1. Preparar el Repositorio

Asegúrate de que tu proyecto esté en GitHub con la siguiente estructura:
```
CheapPartsAndriy/
├── backend/          # Laravel
├── frontend/         # React
└── render.yaml       # Configuración de Render
```

### 2. Crear Servicios en Render

#### A. Base de Datos PostgreSQL

1. Ve a [Render Dashboard](https://dashboard.render.com)
2. Click en **"New +"** → **"PostgreSQL"**
3. Configuración:
   - **Name**: `cheap-parts-db`
   - **Database**: `cheapparts`
   - **User**: `cheapparts`
   - **Region**: `Frankfurt` (o la más cercana)
   - **Plan**: `Free`
4. Click **"Create Database"**
5. Copia la **Internal Database URL** (la necesitarás después)

#### B. Backend Laravel

1. Click en **"New +"** → **"Web Service"**
2. Conecta tu repositorio de GitHub
3. Configuración:
   - **Name**: `cheap-parts-backend`
   - **Region**: `Frankfurt`
   - **Branch**: `main` (o tu rama principal)
   - **Root Directory**: `backend`
   - **Environment**: `PHP`
   - **Build Command**: 
     ```bash
     composer install --no-dev --optimize-autoloader && php artisan key:generate --force && php artisan migrate --force && php artisan db:seed --force
     ```
   - **Start Command**: 
     ```bash
     php artisan serve --host=0.0.0.0 --port=$PORT
     ```
4. En **Environment Variables**, añade:
   ```
   APP_ENV=production
   APP_DEBUG=false
   LOG_LEVEL=error
   DB_CONNECTION=pgsql
   DB_HOST=[de la URL de PostgreSQL]
   DB_PORT=5432
   DB_DATABASE=cheapparts
   DB_USERNAME=cheapparts
   DB_PASSWORD=[de la URL de PostgreSQL]
   FRONTEND_URL=[se configurará después del frontend]
   STRIPE_KEY=[tu clave pública de Stripe]
   STRIPE_SECRET=[tu clave secreta de Stripe]
   STRIPE_WEBHOOK_SECRET=[tu webhook secret de Stripe]
   GOOGLE_AI_API_KEY=[tu API key de Google AI]
   ```
5. Click **"Create Web Service"**

#### C. Frontend React

1. Click en **"New +"** → **"Static Site"**
2. Conecta tu repositorio de GitHub
3. Configuración:
   - **Name**: `cheap-parts-frontend`
   - **Region**: `Frankfurt`
   - **Branch**: `main`
   - **Root Directory**: `frontend`
   - **Build Command**: 
     ```bash
     npm ci && npm run build
     ```
   - **Publish Directory**: `dist`
4. En **Environment Variables**, añade:
   ```
   VITE_API_URL=https://[tu-backend-url].onrender.com/api
   ```
5. Click **"Create Static Site"**

### 3. Configurar URLs

1. Una vez desplegado el frontend, copia su URL (ej: `https://cheap-parts-frontend.onrender.com`)
2. Ve al backend en Render → **Environment** → Edita `FRONTEND_URL`:
   ```
   FRONTEND_URL=https://cheap-parts-frontend.onrender.com
   ```
3. Reinicia el servicio backend

### 4. Configurar CORS

El archivo `backend/config/cors.php` ya está configurado para usar `FRONTEND_URL` automáticamente.

### 5. Configurar Storage (Imágenes)

Para que las imágenes funcionen en producción:

1. En Render, ve al backend → **Shell**
2. Ejecuta:
   ```bash
   php artisan storage:link
   ```
3. Las imágenes deben estar en `backend/public/images/products/`

### 6. Verificar Despliegue

1. **Backend**: Visita `https://[tu-backend].onrender.com/api/products`
2. **Frontend**: Visita `https://[tu-frontend].onrender.com`

## 🔧 Troubleshooting

### Error: "No application encryption key has been specified"
- Solución: El build command ya incluye `php artisan key:generate --force`

### Error: CORS
- Verifica que `FRONTEND_URL` en el backend sea correcta
- Asegúrate de que el frontend use `VITE_API_URL` correcta

### Imágenes no se muestran
- Verifica que `php artisan storage:link` se haya ejecutado
- Asegúrate de que las imágenes estén en `backend/public/images/products/`

### Base de datos vacía
- Verifica que el seeder se ejecute: `php artisan db:seed --force` en build command

## 📝 Notas para la Exposición

### Puntos a mencionar:

1. **Arquitectura**:
   - Backend Laravel (API REST)
   - Frontend React (SPA)
   - Base de datos PostgreSQL
   - Separación de servicios (microservicios)

2. **Despliegue**:
   - Plataforma: Render.com (similar a Heroku, Vercel)
   - CI/CD automático desde GitHub
   - HTTPS automático
   - Escalabilidad horizontal

3. **Seguridad**:
   - Variables de entorno para secretos
   - CORS configurado
   - HTTPS obligatorio para Stripe

4. **Ventajas de Render**:
   - Tier gratuito para desarrollo
   - Deploy automático desde Git
   - Base de datos gestionada
   - Logs en tiempo real

## 🔗 URLs de Ejemplo

- Backend: `https://cheap-parts-backend.onrender.com`
- Frontend: `https://cheap-parts-frontend.onrender.com`
- API: `https://cheap-parts-backend.onrender.com/api`

## 📚 Recursos

- [Documentación de Render](https://render.com/docs)
- [Laravel en Render](https://render.com/docs/deploy-laravel)
- [React en Render](https://render.com/docs/deploy-create-react-app)


