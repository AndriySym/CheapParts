# 🔧 Solución: Forzar PHP en Render (cuando no aparece la opción)

## Problema
Render no muestra la opción de PHP porque detecta Docker automáticamente o el servicio ya está creado con Docker.

## Solución: Usar Blueprint (render.yaml)

Render puede usar el archivo `render.yaml` para configurar automáticamente los servicios. Esto fuerza PHP en lugar de Docker.

### Opción 1: Usar Blueprint (Recomendado)

1. Ve a https://dashboard.render.com
2. Click en **"New +"** → **"Blueprint"**
3. Conecta tu repositorio de GitHub
4. Selecciona el repositorio `CheapPartsAndriy`
5. Render detectará automáticamente el archivo `render.yaml`
6. Click en **"Apply"**
7. Render creará todos los servicios automáticamente con la configuración correcta

### Opción 2: Eliminar y Recrear el Servicio

Si ya tienes el servicio creado:

1. **Elimina el servicio actual:**
   - Ve a `cheap-parts-backend` en Render
   - Click en **"Settings"** → Scroll hasta abajo
   - Click en **"Delete Service"**
   - Confirma la eliminación

2. **Crea un nuevo servicio:**
   - Click en **"New +"** → **"Web Service"**
   - Conecta tu repositorio
   - **IMPORTANTE**: En lugar de configurar manualmente, click en **"Use Blueprint"** o **"From render.yaml"**
   - Render usará el archivo `render.yaml` que ya está en tu repositorio
   - Esto forzará PHP automáticamente

### Opción 3: Configuración Manual (si Blueprint no funciona)

Si ninguna de las opciones anteriores funciona:

1. **Elimina el servicio actual**
2. **Crea un nuevo Web Service:**
   - Name: `cheap-parts-backend`
   - **Root Directory**: `backend`
   - **Environment**: Debería aparecer automáticamente como "Auto-detected" o similar
   - Si aparece "Docker", **NO** lo selecciones
   - En su lugar, en **"Build Command"** escribe:
     ```bash
     chmod +x build.sh && ./build.sh
     ```
   - En **"Start Command"** escribe:
     ```bash
     php artisan serve --host=0.0.0.0 --port=$PORT
     ```
   - Esto debería forzar que Render use PHP

## Verificación

Después de crear el servicio, en los logs deberías ver:
```
Starting Laravel development server...
Laravel development server started: http://0.0.0.0:XXXX
```

**NO** deberías ver mensajes de nginx o Docker.

## Nota Importante

El archivo `render.yaml` ya está configurado correctamente con:
- `env: php` (fuerza PHP)
- `rootDir: backend` (directorio correcto)
- `buildCommand` y `startCommand` correctos

Si usas Blueprint, Render aplicará esta configuración automáticamente.

