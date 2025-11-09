# CheapParts - E-commerce de Componentes Informáticos

Tienda online moderna de componentes informáticos construida con React (frontend) y Laravel (backend).

🎯 **66 productos (ampliable)** | 🏷️ **10 categorías** | 💳 **Pagos con Stripe** | 🎨 **Diseño moderno**

## Estructura del Proyecto

```
CheapPartsAndriy/
├── backend/        # API Laravel + Sanctum + Stripe
├── frontend/       # React + Vite + TypeScript + Tailwind CSS
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

## Frontend (React + Vite + TypeScript)

### Requisitos
- Node.js 18+
- NPM

### Instalación

```bash
cd frontend
npm install
npm run dev
```

El frontend estará disponible en `http://localhost:5173`.

### Características

- ✨ Interfaz moderna con Tailwind CSS
- 🔍 Búsqueda avanzada y filtros
- 🛒 Carrito de compra persistente
- 💳 Integración con Stripe Checkout
- 📱 Diseño responsive
- 🎨 Animaciones y transiciones suaves

### Páginas Principales

- `/` - Página principal con categorías destacadas
- `/products` - Catálogo con filtros (categoría, marca, precio, stock)
- `/products/:id` - Detalle de producto
- `/cart` - Carrito de compra
- `/login` - Inicio de sesión
- `/register` - Registro de usuario
- `/checkout/success` - Confirmación de pedido
- `/checkout/cancel` - Pago cancelado

## Tecnologías Utilizadas

### Backend
- Laravel 12.0
- Laravel Sanctum (autenticación)
- Stripe PHP SDK
- SQLite (desarrollo)

### Frontend
- React 19.1
- TypeScript
- Vite 7.1
- React Router DOM
- Tailwind CSS 3.4
- Axios

## Características del Proyecto

✅ **66 productos** en 10 categorías
✅ **Filtros avanzados** por categoría, marca, precio y stock
✅ **Ordenamiento** por precio, nombre, stock
✅ **Autenticación** con tokens (Laravel Sanctum)
✅ **Carrito persistente** asociado al usuario
✅ **Pagos seguros** con Stripe
✅ **Diseño responsive** para móvil, tablet y desktop
✅ **10 categorías**: CPU, GPU, RAM, Storage, Motherboard, PSU, Case, Cooling, Peripherals, Monitor

## Configuración de Stripe

### Claves de Test
El proyecto necesita claves de **modo test** de Stripe. Añádelas en `backend/.env`:

```env
STRIPE_KEY=tu_clave_publica_de_stripe
STRIPE_SECRET=tu_clave_secreta_de_stripe
FRONTEND_URL=http://localhost:5173
```

Para obtener tus claves de test:
1. Crea una cuenta en [Stripe](https://stripe.com)
2. Ve a Developers → API Keys
3. Copia las claves de Test Mode

### Tarjetas de Test
Para probar el checkout usa estas tarjetas de prueba:
- **Éxito**: `4242 4242 4242 4242`
- Fecha: Cualquier fecha futura
- CVC: Cualquier 3 dígitos

## 📦 Instalar en Otro Equipo

### Requisitos previos
- PHP 8.2+, Composer
- Node.js 18+, NPM
- Git

### Pasos de instalación

1. **Clonar el repositorio**
```bash
git clone https://github.com/AndriySym/CheapParts.git
cd CheapParts
```

2. **Configurar Backend**
```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
```

3. **Configurar Frontend**
```bash
cd ../frontend
npm install
```

4. **Ejecutar el proyecto**
```bash
# Terminal 1 - Backend
cd backend
php artisan serve

# Terminal 2 - Frontend
cd frontend
npm run dev
```

## Repositorio

🔗 **GitHub**: https://github.com/AndriySym/CheapParts

## Licencia

Proyecto educativo - Andriy Symonenko Oliynyk - 2025

