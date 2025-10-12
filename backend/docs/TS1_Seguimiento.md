# Tarea de Seguimiento 1 (TS1)

## 1. Resumen y planificación
Este proyecto es una tienda online de componentes informáticos. Estoy construyendo el frontend con React y el backend con Laravel. En esta primera entrega mi prioridad ha sido tener “algo que funcione”: una API limpia para productos, autenticación sencilla y un carrito que guarde lo que añado. Con eso, el siguiente paso (frontend) irá más rápido y con menos sorpresas.

Planificación por etapas (alto nivel):
- Fase 1: Backend base (modelos, migraciones, seeding, API de productos, auth y carrito) con pruebas locales.
- Fase 2: Frontend base (routing, catálogo, detalle, login/registro y cesta) integrándose con la API.
- Fase 3: Mejoras de UX/UI, paginación, búsqueda/filtrado y preparación de despliegue.
- Fase 4: Extras si el calendario lo permite (panel básico de administración, gestión de stock y rendimiento/SEO).

## 2. Cambios respecto al preproyecto
- He priorizado la API para no bloquear el trabajo del frontend.
- He simplificado la base de datos a lo esencial: `users`, `products`, `cart_items`.
- He optado por Laravel Sanctum para la autenticación de SPA (tokens) por su sencillez.
- En desarrollo uso SQLite para iterar rápido con migraciones y seeding.

## 3. Diseño inicial de la base de datos (MER)
Entidades y relaciones:
- `users` (id, name, email, password)
- `products` (id, name, description, stock, brand, category, image_url, price_cents)
- `cart_items` (id, user_id, product_id, quantity)

Relaciones:
- Un `user` tiene 1:N `cart_items`.
- Un `product` tiene 1:N `cart_items`.
- `cart_items.user_id` → `users.id` (ON DELETE CASCADE)
- `cart_items.product_id` → `products.id` (ON DELETE CASCADE)

Diagrama (MER simplificado):

![Diagrama MER](./db_mer_flow.png)

## 4. Grado de desarrollo (aprox.)
- Backend: 30–40%
  - Hecho: modelos y migraciones de `products` y `cart_items`, seeding de productos, API (listado/detalle), auth con Sanctum (registro/login/me/logout) y carrito (listar/añadir/actualizar/eliminar). Rutas verificadas.
  - Pendiente: validaciones más finas, filtros/búsqueda, tests y documentación de endpoints.
- Frontend: 5–10%
  - Hecho: planificación y estructura prevista (React + Vite + TS).
  - Pendiente: scaffolding, routing, páginas (catálogo, detalle, login/registro, cesta) e integración con la API.

## 5. Principales dificultades encontradas
- Encontrar el tamaño “justo” del modelo de datos para empezar a integrar sin bloquearme.
- Decidir y configurar la autenticación de la SPA con tokens y proteger rutas.
- Afinar migraciones y seeding para que cualquier entorno local arranque en minutos.

## 6. Repositorios (GitHub)
- Backend (Laravel): [pendiente de publicar]
- Frontend (React): [pendiente de publicar]

Una vez creados, añadiré enlaces y un README breve con cómo arrancar:
- Backend: dependencias, variables de entorno y `php artisan migrate --seed`.
- Frontend: dependencias, variables de entorno (URL de la API) y `npm run dev`.

## 7. Próximos pasos inmediatos (siguiente semana)
- Inicializar el proyecto frontend (Vite + TS), routing y layout base.
- Catálogo y detalle consumiendo `/api/products`.
- Login/registro conectados a la API de auth.
- Cesta en frontend (añadir/actualizar/eliminar) contra los endpoints existentes.
- README y publicación de repos en GitHub.

## 8. Otros puntos
- Para acelerar la maquetación inicial se emplearán componentes y plantillas UI reutilizables.
- Se mantendrá un enfoque incremental, priorizando una demo funcional simple sobre funcionalidades complejas.
