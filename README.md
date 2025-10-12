# CheapParts - E-commerce de Componentes Informáticos

Tienda online de componentes informáticos construida con React (frontend) y Laravel (backend).

## Estructura del Proyecto

```
CheapPartsAndriy/
├── backend/        # API Laravel + Sanctum
├── frontend/       # React + Vite + TypeScript (próximamente)
└── README.md
```

## Backend (Laravel)

### Requisitos
- PHP 8.2+
- Composer
- SQLite (incluido por defecto)

### Instalación

```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

La API estará disponible en `http://localhost:8000`.

### Endpoints Principales

#### Públicos
- `GET /api/products` - Listado de productos (con paginación y búsqueda)
- `GET /api/products/{id}` - Detalle de un producto

#### Autenticación
- `POST /api/auth/register` - Registro de usuario
- `POST /api/auth/login` - Inicio de sesión (devuelve token)
- `GET /api/auth/me` - Usuario autenticado (requiere token)
- `POST /api/auth/logout` - Cerrar sesión (revoca token)

#### Carrito (requiere autenticación)
- `GET /api/cart` - Listar items del carrito
- `POST /api/cart` - Añadir producto al carrito
- `PUT /api/cart/{id}` - Actualizar cantidad
- `DELETE /api/cart/{id}` - Eliminar item del carrito

## Frontend (React)

_En desarrollo_

## Documentación

- [Tarea de Seguimiento 1 (TS1)](./backend/docs/TS1_Seguimiento.md)
- [Diagrama MER](./backend/docs/db_mer.png)

## Licencia

Proyecto educativo - Andriy Symonenko Oliynyk

