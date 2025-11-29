# 🔧 Guía de Solución de Problemas - Render.com

## Error 502 (Bad Gateway)

Si ves errores **502** en las peticiones al backend, significa que el servidor backend no está respondiendo correctamente.

### Pasos para diagnosticar:

1. **Verifica los logs del backend en Render:**
   - Ve a tu dashboard de Render
   - Selecciona el servicio `cheap-parts-backend`
   - Click en la pestaña **"Logs"**
   - Busca errores en rojo

2. **Verifica la configuración del servicio:**
   - **Environment**: Debe ser `PHP` (no Docker)
   - **Build Command**: 
     ```bash
     chmod +x build.sh && ./build.sh
     ```
   - **Start Command**: 
     ```bash
     php artisan serve --host=0.0.0.0 --port=$PORT
     ```

3. **Verifica las variables de entorno:**
   Asegúrate de que estas variables estén configuradas:
   ```
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://cheap-parts-backend.onrender.com
   FRONTEND_URL=https://cheap-parts-frontend.onrender.com
   
   DB_CONNECTION=pgsql
   DB_HOST=[tu_host_de_postgres]
   DB_PORT=5432
   DB_DATABASE=cheapparts
   DB_USERNAME=[tu_usuario]
   DB_PASSWORD=[tu_password]
   ```

4. **Problemas comunes:**

   **a) El backend no inicia:**
   - Verifica que `APP_KEY` esté generada (se genera automáticamente con `php artisan key:generate`)
   - Verifica que la base de datos esté accesible
   - Revisa los logs para ver errores específicos

   **b) Error de conexión a la base de datos:**
   - Verifica que la URL de la base de datos sea correcta
   - Asegúrate de usar la **Internal Database URL** de Render (no la externa)
   - Verifica que el servicio de base de datos esté activo

   **c) Error de permisos:**
   - Render maneja los permisos automáticamente, pero si hay problemas, verifica que `storage` y `bootstrap/cache` tengan permisos de escritura

5. **Forzar un nuevo deploy:**
   - En Render, ve a tu servicio backend
   - Click en **"Manual Deploy"** → **"Deploy latest commit"**
   - Esto forzará un nuevo build e instalación

## Error CORS

Si ves errores de CORS después de que el backend esté funcionando:

1. **Verifica que el middleware CORS esté registrado:**
   - El archivo `backend/app/Http/Middleware/HandleCors.php` debe existir
   - Debe estar registrado en `backend/bootstrap/app.php`

2. **Verifica que el origen del frontend esté permitido:**
   - En `HandleCors.php`, verifica que `https://cheap-parts-frontend.onrender.com` esté en el array `$allowedOrigins`

3. **Limpia la caché de configuración:**
   ```bash
   php artisan config:clear
   php artisan config:cache
   ```

## Verificar que el backend funciona

1. **Prueba el endpoint de health:**
   ```
   https://cheap-parts-backend.onrender.com/up
   ```
   Debería devolver `{"status":"ok"}`

2. **Prueba un endpoint de la API:**
   ```
   https://cheap-parts-backend.onrender.com/api/products
   ```
   Debería devolver un JSON con los productos (o un array vacío si no hay productos)

## Contacto

Si después de seguir estos pasos el problema persiste, comparte:
- Los logs del backend de Render
- La configuración del servicio (sin mostrar contraseñas)
- Los errores específicos que ves en la consola del navegador

