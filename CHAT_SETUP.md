# Configuración del Chatbot con Google AI Studio

## Pasos para obtener la API Key

1. **Crear cuenta en Google AI Studio**
   - Ve a: https://aistudio.google.com/
   - Inicia sesión con tu cuenta de Google

2. **Crear una API Key**
   - En el dashboard, haz clic en "Get API Key" o "Create API Key"
   - Selecciona o crea un proyecto de Google Cloud
   - Copia la API key generada

3. **Configurar la API Key en el proyecto**
   - Abre el archivo `backend/.env`
   - Añade la siguiente línea:
   ```
   GOOGLE_AI_API_KEY=tu_api_key_aqui
   ```
   - Reemplaza `tu_api_key_aqui` con tu API key real

4. **Reiniciar el servidor Laravel**
   - Si el servidor está corriendo, deténlo (Ctrl+C)
   - Vuelve a ejecutar: `php artisan serve`

## Notas importantes

- **No subas tu API key a Git**: El archivo `.env` ya está en `.gitignore`
- **Límites gratuitos**: Google AI Studio ofrece un tier gratuito generoso para desarrollo
- **Seguridad**: Mantén tu API key privada y no la compartas públicamente

## Verificar que funciona

1. Inicia el proyecto (backend y frontend)
2. Abre cualquier página del sitio
3. Deberías ver un botón flotante de chat en la esquina inferior derecha
4. Haz clic en el botón y prueba enviando un mensaje como: "¿Qué procesadores tienes disponibles?"

## Solución de problemas

- **Error "Google AI API key no configurada"**: Verifica que la variable `GOOGLE_AI_API_KEY` esté en tu archivo `.env`
- **Error 401/403**: Verifica que tu API key sea válida y tenga los permisos correctos
- **Error de timeout**: Verifica tu conexión a internet




