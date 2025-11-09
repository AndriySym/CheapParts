# Configuración de Stripe

## Paso 1: Obtener las claves de Stripe

1. Ve a https://dashboard.stripe.com/register y crea una cuenta (es gratis)
2. Una vez dentro, ve a https://dashboard.stripe.com/test/apikeys
3. Verás dos claves:
   - **Publishable key** (empieza con `pk_test_`) → va en `STRIPE_KEY`
   - **Secret key** (empieza con `sk_test_`) → Haz clic en "Reveal test key" para verla → va en `STRIPE_SECRET`

## Paso 2: Configurar webhook (para desarrollo local)

### Opción A: Con Stripe CLI (recomendado)

1. Descarga e instala Stripe CLI: https://stripe.com/docs/stripe-cli
2. Abre una terminal y ejecuta:
   ```
   stripe listen --forward-to localhost:8000/api/webhook/stripe
   ```
3. Te dará un `whsec_...` → cópialo y ponlo en `STRIPE_WEBHOOK_SECRET` en el `.env`

### Opción B: Sin webhook (solo para pruebas básicas)

- Deja `STRIPE_WEBHOOK_SECRET` vacío
- El checkout funcionará pero los pedidos no se completarán automáticamente

## Paso 3: Editar el archivo .env

Abre `backend\.env` y completa las variables:

```env
STRIPE_KEY=pk_test_tu_clave_aqui
STRIPE_SECRET=sk_test_tu_clave_secreta_aqui
STRIPE_WEBHOOK_SECRET=whsec_tu_webhook_secret_aqui
FRONTEND_URL=http://localhost:5173
```

## Paso 4: Reiniciar el servidor

El servidor debería detectar el cambio automáticamente, pero si no:
1. Detén el servidor (Ctrl+C)
2. Vuelve a ejecutar: `cd backend; php artisan serve`

## Tarjetas de prueba

Puedes usar estas tarjetas en el checkout de Stripe:

- **Pago exitoso**: `4242 4242 4242 4242`
- **Tarjeta rechazada**: `4000 0000 0000 0002`
- **Fecha**: Cualquier fecha futura (ej: 12/25)
- **CVC**: Cualquier 3 dígitos (ej: 123)

## Verificar que funciona

Una vez configurado:
1. Añade productos al carrito
2. Haz clic en "Proceder al Pago"
3. Deberías ser redirigido a Stripe Checkout
4. Usa la tarjeta de prueba `4242 4242 4242 4242`
5. Deberías ser redirigido a la página de éxito



