# 📝 Crear Frontend Manualmente en Render

Como Render no soporta `static_site` en Blueprints, necesitas crear el frontend manualmente después de crear el backend con Blueprint.

## Pasos para crear el Frontend

1. Ve a https://dashboard.render.com
2. Click en **"New +"** → **"Static Site"**
3. Conecta tu repositorio de GitHub
4. Selecciona el repositorio `CheapPartsAndriy`
5. Configura:
   - **Name**: `cheap-parts-frontend`
   - **Region**: `Frankfurt`
   - **Branch**: `main`
   - **Root Directory**: `frontend`
   - **Build Command**: 
     ```bash
     chmod +x build.sh && ./build.sh
     ```
   - **Publish Directory**: `dist`

6. **Environment Variables**:
   ```
   VITE_API_URL=https://cheap-parts-backend.onrender.com/api
   ```
   (Reemplaza con la URL real de tu backend después de que se cree)

7. Click en **"Create Static Site"**
8. Espera a que termine el build (3-5 minutos)
9. **Copia la URL del frontend** (ej: `https://cheap-parts-frontend.onrender.com`)

## Actualizar Backend con URL del Frontend

1. Ve al **Backend** en Render
2. **Environment Variables** → Edita `FRONTEND_URL`:
   ```
   FRONTEND_URL=https://cheap-parts-frontend.onrender.com
   ```
   (Usa la URL real de tu frontend)

3. Click en **"Save Changes"**
4. El servicio se reiniciará automáticamente

## Verificación

1. **Backend API**: Visita `https://cheap-parts-backend.onrender.com/up`
   - Debería devolver: `{"status":"ok"}`

2. **Frontend**: Visita `https://cheap-parts-frontend.onrender.com`
   - Deberías ver la aplicación funcionando
   - Los productos deberían cargarse
   - El login debería funcionar
   - El chatbot debería aparecer

