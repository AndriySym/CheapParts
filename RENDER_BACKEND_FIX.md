# 🔧 Solución para Error 502 en Render

## Problema

El backend está devolviendo **502 Bad Gateway** porque Render está usando Docker automáticamente (detectó el Dockerfile), pero Render necesita usar PHP nativo para que funcione correctamente.

## Solución

He renombrado los archivos de Docker para que Render no los detecte automáticamente. Ahora necesitas **verificar la configuración en Render**:

### Pasos en Render Dashboard:

1. Ve a https://dashboard.render.com
2. Selecciona el servicio `cheap-parts-backend`
3. Click en **"Settings"** (Configuración)
4. Verifica que:

   **Environment**: Debe ser `PHP` (NO Docker)
   
   **Build Command**: 
   ```bash
   chmod +x build.sh && ./build.sh
   ```
   
   **Start Command**: 
   ```bash
   php artisan serve --host=0.0.0.0 --port=$PORT
   ```

5. Si el **Environment** está en `Docker`, cámbialo a `PHP`
6. Guarda los cambios
7. Click en **"Manual Deploy"** → **"Deploy latest commit"**

### Verificación

Después del deploy, verifica que:
- El endpoint `/up` responda: https://cheap-parts-backend.onrender.com/up
- Debería devolver: `{"status":"ok"}`

## Nota

Los archivos Docker están renombrados como:
- `Dockerfile.local` (para uso local)
- `deploy.sh.local` (para uso local)
- `.dockerignore.local` (para uso local)

Esto permite usar Docker localmente pero PHP nativo en Render.

