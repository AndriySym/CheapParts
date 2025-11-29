# 🚀 Configuración Rápida para Render.com

## ✅ Lo que ya está preparado:

1. ✅ **CORS configurado** - Acepta el dominio del frontend automáticamente
2. ✅ **Variables de entorno** - El frontend usa `VITE_API_URL`
3. ✅ **Archivo render.yaml** - Configuración lista (opcional, puedes configurar manualmente)
4. ✅ **Scripts de build** - Preparados para producción

## 📝 Pasos para Desplegar (15 minutos)

### Paso 1: Subir a GitHub
```bash
git add .
git commit -m "Preparado para deployment en Render"
git push origin main
```

### Paso 2: Crear Base de Datos en Render

1. Ve a https://dashboard.render.com
2. Click **"New +"** → **"PostgreSQL"**
3. Configura:
   - Name: `cheap-parts-db`
   - Database: `cheapparts`
   - Region: `Frankfurt` (o la más cercana)
   - Plan: `Free`
4. Click **"Create Database"**
5. **Copia la "Internal Database URL"** (la necesitarás)

### Paso 3: Crear Backend (Laravel)

1. Click **"New +"** → **"Web Service"**
2. Conecta tu repositorio de GitHub
3. Selecciona el repositorio `CheapPartsAndriy`
4. Configura:
   - **Name**: `cheap-parts-backend`
   - **Region**: `Frankfurt`
   - **Branch**: `main`
   - **Root Directory**: `backend`
   - **Environment**: `PHP`
   - **Build Command**: 
     ```bash
     chmod +x build.sh && ./build.sh
     ```
   - **Start Command**: 
     ```bash
     php artisan serve --host=0.0.0.0 --port=$PORT
     ```

5. **Environment Variables** (añade estas):
   ```
   APP_ENV=production
   APP_DEBUG=false
   LOG_LEVEL=error
   APP_URL=https://cheap-parts-backend.onrender.com
   
   # Base de datos (usa la Internal Database URL que copiaste)
   DB_CONNECTION=pgsql
   DB_HOST=[del Internal Database URL]
   DB_PORT=5432
   DB_DATABASE=cheapparts
   DB_USERNAME=[del Internal Database URL]
   DB_PASSWORD=[del Internal Database URL]
   
   # Frontend (se configurará después)
   FRONTEND_URL=https://cheap-parts-frontend.onrender.com
   
   # Stripe
   STRIPE_KEY=pk_test_...
   STRIPE_SECRET=sk_test_...
   STRIPE_WEBHOOK_SECRET=whsec_...
   
   # Google AI
   GOOGLE_AI_API_KEY=tu_api_key_aqui
   ```

6. Click **"Create Web Service"**
7. Espera a que termine el build (5-10 minutos)
8. **Copia la URL del backend** (ej: `https://cheap-parts-backend.onrender.com`)

### Paso 4: Crear Frontend (React)

1. Click **"New +"** → **"Static Site"**
2. Conecta tu repositorio de GitHub
3. Selecciona el repositorio `CheapPartsAndriy`
4. Configura:
   - **Name**: `cheap-parts-frontend`
   - **Region**: `Frankfurt`
   - **Branch**: `main`
   - **Root Directory**: `frontend`
   - **Build Command**: 
     ```bash
     chmod +x build.sh && ./build.sh
     ```
   - **Publish Directory**: `dist`

5. **Environment Variables**:
   ```
   VITE_API_URL=https://cheap-parts-backend.onrender.com/api
   ```
   (Reemplaza con la URL real de tu backend)

6. Click **"Create Static Site"**
7. Espera a que termine el build (3-5 minutos)
8. **Copia la URL del frontend** (ej: `https://cheap-parts-frontend.onrender.com`)

### Paso 5: Actualizar URLs

1. Ve al **Backend** en Render
2. **Environment** → Edita `FRONTEND_URL`:
   ```
   FRONTEND_URL=https://cheap-parts-frontend.onrender.com
   ```
   (Usa la URL real de tu frontend)

3. Click **"Save Changes"**
4. El servicio se reiniciará automáticamente

### Paso 6: Configurar Storage (Imágenes)

1. Ve al **Backend** en Render
2. Click en **"Shell"** (terminal)
3. Ejecuta:
   ```bash
   php artisan storage:link
   ```

### Paso 7: Verificar

1. **Backend API**: Visita `https://tu-backend.onrender.com/api/products`
   - Deberías ver JSON con productos

2. **Frontend**: Visita `https://tu-frontend.onrender.com`
   - Deberías ver la aplicación funcionando

## 🎯 Para la Exposición

### Puntos Clave a Mencionar:

1. **Arquitectura Moderna**:
   - Separación frontend/backend (API REST)
   - Base de datos PostgreSQL
   - Despliegue en la nube

2. **Plataforma Render.com**:
   - Similar a Heroku, Vercel, Netlify
   - Tier gratuito para desarrollo
   - Deploy automático desde GitHub
   - HTTPS automático (necesario para Stripe)

3. **CI/CD**:
   - Cada push a GitHub despliega automáticamente
   - Build automático
   - Variables de entorno seguras

4. **Escalabilidad**:
   - Servicios independientes
   - Fácil escalar cada componente por separado

## ⚠️ Notas Importantes

- **Primera vez**: El build puede tardar 10-15 minutos
- **Siguientes deploys**: 3-5 minutos
- **Tier gratuito**: Los servicios se "duermen" después de 15 min de inactividad
- **Primera petición**: Puede tardar 30-60 segundos (wake up)

## 🔧 Troubleshooting

### Backend no responde
- Verifica que el build haya terminado
- Revisa los logs en Render
- Verifica las variables de entorno

### CORS Error
- Verifica que `FRONTEND_URL` en backend sea correcta
- Verifica que `VITE_API_URL` en frontend sea correcta

### Base de datos vacía
- Verifica los logs del build
- El seeder debería ejecutarse automáticamente

## 📞 Soporte

Si tienes problemas:
1. Revisa los logs en Render Dashboard
2. Verifica las variables de entorno
3. Asegúrate de que las URLs sean correctas


