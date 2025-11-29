PROYECTO INTEGRADO
CheapParts


ÍNDICE

1. Introducción

1.1. Motivación

La idea de desarrollar CheapParts surgió de la necesidad de crear una plataforma de e-commerce especializada en componentes informáticos que fuera moderna, eficiente y fácil de usar. Inspirado en tiendas online como PcComponentes, quise desarrollar una aplicación completa que permitiera a los usuarios navegar por un catálogo de productos, gestionar un carrito de compra y realizar pedidos de forma segura.

Mi objetivo principal era aprender y aplicar conocimientos sobre desarrollo full-stack, trabajando tanto en el backend como en el frontend, y enfrentándome a desafíos reales como la integración de pasarelas de pago, la autenticación de usuarios y la gestión de estado en aplicaciones web modernas.

1.2. Descripción funcional de la aplicación

CheapParts es una aplicación web de comercio electrónico dedicada a la venta de componentes informáticos. La aplicación permite a los usuarios registrarse, navegar por un catálogo de productos con información detallada, añadir productos a un carrito de compra personalizado y realizar compras mediante una pasarela de pago integrada.

Las funcionalidades principales incluyen:

- Catálogo de 171 productos en 10 categorías con paginación y búsqueda
- Filtros avanzados por categoría, marca, precio y stock
- Ordenamiento flexible por múltiples criterios
- Sistema de autenticación con registro e inicio de sesión
- Carrito de compra persistente asociado a cada usuario
- Proceso de checkout completo con integración de Stripe
- Gestión de pedidos y confirmación de compra
- Interfaz responsive y moderna con categorías en español
- Chatbot inteligente con Google AI para asistencia al cliente
- Panel de administración para gestión de productos

La aplicación está dividida en dos partes principales: un backend desarrollado con Laravel que proporciona una API REST completa, y un frontend desarrollado con React que consume esta API para ofrecer una experiencia de usuario fluida e interactiva.

1.3. Características y entorno de desarrollo

La aplicación ha sido desarrollada utilizando tecnologías modernas y estándares de la industria.

Backend:
- Laravel 12.0 como framework PHP
- Laravel Sanctum para autenticación basada en tokens
- SQLite como base de datos para desarrollo
- PostgreSQL como base de datos en producción
- Stripe como pasarela de pago
- Google AI (Gemini) para chatbot inteligente
- API REST con arquitectura separada del frontend
- Docker para despliegue en producción

Frontend:
- React 19.1.1 como librería de interfaz
- TypeScript para tipado estático
- Vite como herramienta de construcción
- React Router DOM para navegación
- Tailwind CSS 3.4 para estilos
- Axios para comunicación con la API
- SweetAlert2 para notificaciones

Entorno de desarrollo:
- Node.js para el frontend
- PHP 8.2+ para el backend
- Composer para gestión de dependencias PHP
- NPM para gestión de dependencias JavaScript

Entorno de producción:
- Render.com para hosting del backend y frontend
- PostgreSQL en Render.com para base de datos
- Docker para containerización del backend
- Static Site hosting para el frontend

He decidido usar esta separación entre backend y frontend porque me permite tener una arquitectura más escalable y flexible, además de poder desarrollar ambas partes de forma independiente. Laravel me proporciona una base sólida para la API con todas las funcionalidades que necesito ya implementadas, como autenticación, validación y manejo de base de datos. Por otro lado, React me permite crear una interfaz de usuario dinámica y reactiva que mejora significativamente la experiencia del usuario comparado con aplicaciones más tradicionales.

1.4. Elementos de investigación

Durante el desarrollo del proyecto, he tenido que investigar y aprender sobre varias tecnologías y conceptos que no había utilizado previamente.

1.4.1. Stripe (Pasarela de pago)

Stripe es la pasarela de pago que he integrado en la aplicación para procesar los pagos de los usuarios. La elección de Stripe se debió a varias razones: es una de las pasarelas más utilizadas y documentadas, tiene una integración sencilla con Laravel mediante el SDK oficial, y ofrece un entorno de pruebas completo que me permite desarrollar y probar sin necesidad de usar tarjetas reales.

La integración de Stripe me ha permitido entender cómo funcionan las pasarelas de pago en aplicaciones web, específicamente el flujo de checkout con Stripe Checkout, el manejo de webhooks para confirmar pagos de forma segura, y la gestión de sesiones de pago. He aprendido sobre la importancia de manejar correctamente los estados de las órdenes y asegurar que los pagos se procesen de forma segura.

1.4.2. Laravel Sanctum (Autenticación API)

Laravel Sanctum es el sistema de autenticación que he utilizado para proteger las rutas de la API. Elegí Sanctum sobre otras opciones como Passport porque es más simple de configurar para aplicaciones SPA y me permite trabajar con tokens de forma sencilla.

A través de Sanctum he aprendido a implementar autenticación basada en tokens, donde el frontend almacena un token que se envía en cada petición autenticada. También he implementado interceptores en Axios que añaden automáticamente el token a las peticiones y manejan la expiración del mismo, redirigiendo al usuario a la página de login cuando es necesario.

1.4.3. React Router (Navegación frontend)

React Router DOM es la librería que utilizo para la navegación en el frontend. Me permite crear una Single Page Application donde las transiciones entre páginas son instantáneas sin necesidad de recargar toda la página.

He aprendido a estructurar las rutas de forma jerárquica, crear rutas protegidas que requieren autenticación, y manejar parámetros dinámicos en las URLs para navegar a páginas de detalle de productos. También he implementado redirecciones automáticas basadas en el estado de autenticación del usuario.

1.4.4. Tailwind CSS (Framework CSS)

Tailwind CSS es el framework de utilidades que he utilizado para estilizar la aplicación. Elegí Tailwind porque me permite desarrollar interfaces de forma más rápida sin tener que escribir CSS personalizado, y porque ofrece un sistema de diseño consistente basado en clases utilitarias.

He aprendido a trabajar con el sistema de grid y flexbox de Tailwind, utilizar las clases responsive para adaptar la aplicación a diferentes tamaños de pantalla, y crear componentes reutilizables manteniendo un diseño consistente en toda la aplicación. También he implementado un diseño completamente responsive con drawer móvil para filtros y ajustes específicos para móvil, tablet y desktop.

1.4.5. Google AI (Gemini) - Chatbot

He integrado Google AI Studio (Gemini) para crear un chatbot inteligente que ayuda a los usuarios a encontrar productos y responder preguntas sobre componentes informáticos. El chatbot utiliza el contexto de los productos disponibles en la tienda para proporcionar recomendaciones personalizadas.

He aprendido sobre la integración de APIs de inteligencia artificial, el manejo de contexto en conversaciones, y cómo estructurar prompts para obtener respuestas útiles y relevantes.

1.4.6. Docker y Despliegue en Render.com

He aprendido a containerizar aplicaciones Laravel usando Docker, configurar Dockerfiles para producción, y desplegar aplicaciones en Render.com usando Blueprints. También he aprendido sobre la configuración de variables de entorno en producción, el manejo de bases de datos PostgreSQL, y la configuración de CORS para aplicaciones separadas.

2. Base de datos del proyecto

La base de datos de CheapParts está diseñada para gestionar usuarios, productos, carritos de compra y pedidos. He utilizado un diseño relacional normalizado que permite mantener la integridad de los datos y facilitar las consultas necesarias para el funcionamiento de la aplicación.

2.1. Modelo Entidad-Relación

El diseño de la base de datos consta de 5 tablas principales que se relacionan entre sí:

USERS (Usuarios)
Campos principales: id, name, email, password, is_admin

PRODUCTS (Productos)
Campos principales: id, name, description, price_cents, stock, brand, category, image_url

CART_ITEMS (Elementos del carrito)
Campos principales: id, user_id, product_id, quantity
Relación: Un usuario TIENE N elementos en el carrito (1:N con USERS)
Relación: Un producto APARECE EN N carritos (1:N con PRODUCTS)

ORDERS (Pedidos)
Campos principales: id, user_id, total_cents, status, stripe_session_id, stripe_payment_intent_id
Relación: Un usuario TIENE N pedidos (1:N con USERS)

ORDER_ITEMS (Elementos de pedido)
Campos principales: id, order_id, product_id, quantity, price_cents
Relación: Un pedido CONTIENE N elementos (1:N con ORDERS)
Relación: Un producto APARECE EN N pedidos (1:N con PRODUCTS)

El modelo sigue una estructura típica de e-commerce donde los usuarios pueden agregar productos a su carrito y posteriormente realizar pedidos. Los carritos son temporales y están asociados al usuario autenticado. Los pedidos son registros permanentes que conservan el precio del producto en el momento de la compra para mantener un histórico preciso.

2.2. Esquema de tablas

Tabla USERS:
- id: Identificador único autoincremental
- name: Nombre del usuario (string)
- email: Correo electrónico único (string)
- password: Contraseña hasheada (string)
- is_admin: Indica si el usuario es administrador (boolean, default false)
- email_verified_at: Fecha de verificación del email (timestamp nullable)
- remember_token: Token para recordar sesión (string nullable)
- created_at: Fecha de creación (timestamp)
- updated_at: Fecha de última actualización (timestamp)

Tabla PRODUCTS:
- id: Identificador único autoincremental
- name: Nombre del producto (string)
- description: Descripción detallada (text nullable)
- price_cents: Precio en céntimos para evitar problemas de precisión (unsigned bigint)
- stock: Cantidad disponible (unsigned integer, default 0)
- brand: Marca del producto (string nullable)
- category: Categoría del producto (string nullable)
- image_url: Ruta de la imagen del producto (string nullable)
- created_at: Fecha de creación (timestamp)
- updated_at: Fecha de última actualización (timestamp)

Nota: El precio se almacena en céntimos (price_cents) para evitar problemas de redondeo con decimales. Por ejemplo, 49.99€ se almacena como 4999 céntimos.

Tabla CART_ITEMS:
- id: Identificador único autoincremental
- user_id: Clave foránea a USERS (unsigned bigint)
- product_id: Clave foránea a PRODUCTS (unsigned bigint)
- quantity: Cantidad del producto (unsigned integer, default 1)
- created_at: Fecha de creación (timestamp)
- updated_at: Fecha de última actualización (timestamp)
- Restricción única: (user_id, product_id) para evitar duplicados

Tabla ORDERS:
- id: Identificador único autoincremental
- user_id: Clave foránea a USERS (unsigned bigint)
- total_cents: Total del pedido en céntimos (unsigned bigint)
- status: Estado del pedido: pending, completed, failed (string, default 'pending')
- stripe_session_id: ID de sesión de Stripe (string nullable)
- stripe_payment_intent_id: ID de intención de pago de Stripe (string nullable)
- created_at: Fecha de creación (timestamp)
- updated_at: Fecha de última actualización (timestamp)

Tabla ORDER_ITEMS:
- id: Identificador único autoincremental
- order_id: Clave foránea a ORDERS (unsigned bigint)
- product_id: Clave foránea a PRODUCTS (unsigned bigint)
- quantity: Cantidad del producto (unsigned integer)
- price_cents: Precio del producto en el momento de la compra (unsigned bigint)
- created_at: Fecha de creación (timestamp)
- updated_at: Fecha de última actualización (timestamp)

Nota: En ORDER_ITEMS se guarda el precio del producto en el momento de la compra (price_cents) para mantener un registro histórico preciso, ya que los precios pueden cambiar con el tiempo.

2.3. Relaciones entre tablas

Las relaciones implementadas en la base de datos son las siguientes:

USERS - CART_ITEMS (1:N)
Un usuario puede tener múltiples elementos en su carrito, pero cada elemento del carrito pertenece a un solo usuario. La eliminación de un usuario elimina en cascada todos sus elementos del carrito (onDelete cascade).

PRODUCTS - CART_ITEMS (1:N)
Un producto puede aparecer en múltiples carritos de diferentes usuarios, pero cada elemento del carrito hace referencia a un solo producto. La eliminación de un producto elimina en cascada todas las referencias en los carritos (onDelete cascade).

USERS - ORDERS (1:N)
Un usuario puede realizar múltiples pedidos, pero cada pedido pertenece a un solo usuario. La eliminación de un usuario elimina en cascada todos sus pedidos (onDelete cascade).

ORDERS - ORDER_ITEMS (1:N)
Un pedido contiene múltiples elementos, pero cada elemento pertenece a un solo pedido. La eliminación de un pedido elimina en cascada todos sus elementos (onDelete cascade).

PRODUCTS - ORDER_ITEMS (1:N)
Un producto puede aparecer en múltiples pedidos, pero cada elemento de pedido hace referencia a un solo producto. La eliminación de un producto elimina en cascada todas las referencias en los pedidos (onDelete cascade).

He decidido usar eliminación en cascada (onDelete cascade) para mantener la integridad referencial de la base de datos. Esto significa que cuando se elimina un registro padre, todos los registros hijos relacionados se eliminan automáticamente, evitando registros huérfanos y manteniendo la base de datos limpia.

3. Documentación de la aplicación e instalación

Esta sección documenta los pasos necesarios para instalar y configurar la aplicación CheapParts en un entorno de desarrollo local.

3.1. Requisitos previos

Para poder ejecutar la aplicación necesitas tener instalados los siguientes componentes en tu sistema:

Para el backend (Laravel):
- PHP 8.2 o superior con las extensiones requeridas por Laravel
- Composer (gestor de dependencias PHP)
- SQLite (incluido por defecto en PHP)

Para el frontend (React):
- Node.js 18.0 o superior
- NPM (incluido con Node.js) o cualquier otro gestor de paquetes compatible

Herramientas adicionales recomendadas:
- Git para control de versiones
- Un editor de código como Visual Studio Code
- Postman o similar para probar la API (opcional)

3.2. Instalación del backend (Laravel)

3.2.1. Configuración del entorno

El primer paso es clonar el repositorio desde GitHub:

```
git clone https://github.com/AndriySym/CheapParts.git
cd CheapParts/backend
```

Instalar las dependencias de PHP usando Composer:

```
composer install
```

Crear el archivo de configuración .env copiando el ejemplo:

```
cp .env.example .env
```

Generar la clave de aplicación de Laravel:

```
php artisan key:generate
```

Configurar las variables de entorno en el archivo .env. Las más importantes son:

```
APP_NAME=CheapParts
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite

FRONTEND_URL=http://localhost:5173
```

3.2.2. Migraciones y seeders

Una vez configurado el entorno, ejecutar las migraciones para crear las tablas en la base de datos:

```
php artisan migrate
```

Poblar la base de datos con datos de ejemplo usando el seeder:

```
php artisan db:seed
```

Este comando creará 171 productos de ejemplo con información realista de componentes informáticos.

Iniciar el servidor de desarrollo:

```
php artisan serve
```

La API estará disponible en http://localhost:8000

3.2.3. Configuración de Stripe

Para habilitar los pagos con Stripe, necesitas obtener las claves de API desde tu cuenta de Stripe. Puedes usar el modo de prueba para desarrollo sin procesar pagos reales.

Agregar las claves de Stripe al archivo .env:

```
STRIPE_KEY=tu_clave_publica_de_stripe
STRIPE_SECRET=tu_clave_secreta_de_stripe
```

Para el webhook de Stripe (necesario para confirmar pagos), debes configurar el endpoint en el panel de Stripe:

```
http://tu-dominio.com/api/webhook/stripe
```

En desarrollo local puedes usar Stripe CLI para reenviar webhooks:

```
stripe listen --forward-to localhost:8000/api/webhook/stripe
```

3.2.4. Configuración del Chatbot (Google AI)

Para habilitar el chatbot, necesitas obtener una API key de Google AI Studio:

1. Visita https://aistudio.google.com/
2. Crea un proyecto o selecciona uno existente
3. Genera una API key
4. Agrega la clave al archivo .env:

```
GOOGLE_AI_API_KEY=tu_clave_de_google_ai
```

El chatbot utiliza Google Gemini para proporcionar asistencia inteligente a los usuarios sobre productos y componentes informáticos.

3.3. Instalación del frontend (React)

3.3.1. Configuración del entorno

Desde la raíz del proyecto, navegar al directorio frontend:

```
cd frontend
```

Instalar las dependencias de Node.js:

```
npm install
```

3.3.2. Configuración de la API

El frontend está configurado para conectarse automáticamente a la API. En desarrollo, se conecta a http://localhost:8000/api. En producción, detecta automáticamente la URL correcta basándose en el hostname.

Si necesitas cambiar la URL manualmente, puedes modificar la configuración en el archivo src/lib/api.ts o establecer la variable de entorno VITE_API_URL.

Iniciar el servidor de desarrollo:

```
npm run dev
```

La aplicación estará disponible en http://localhost:5173

3.4. Modelos

Los modelos en Laravel representan las tablas de la base de datos y definen las relaciones entre ellas. Todos los modelos de CheapParts se encuentran en el directorio app/Models/.

3.4.1. User

El modelo User representa a los usuarios de la aplicación y viene incluido por defecto con Laravel. He añadido el trait HasApiTokens de Laravel Sanctum para permitir la autenticación basada en tokens.

Campos fillable: name, email, password, is_admin
Campos ocultos: password, remember_token
Traits utilizados: HasApiTokens, HasFactory, Notifiable

El campo password se hashea automáticamente gracias al cast 'hashed' definido en el método casts(). Esto garantiza que las contraseñas nunca se almacenen en texto plano en la base de datos.

El campo is_admin permite identificar usuarios administradores que tienen acceso al panel de administración.

3.4.2. Product

El modelo Product representa los productos disponibles en la tienda.

Campos fillable: name, description, stock, brand, category, image_url, price_cents
Relaciones: hasMany(CartItem::class) - Un producto puede estar en múltiples carritos

El campo price_cents almacena el precio en céntimos para evitar problemas de precisión con decimales. En el frontend se divide entre 100 para mostrar el precio en euros.

3.4.3. CartItem

El modelo CartItem representa los productos que un usuario ha añadido a su carrito de compra.

Campos fillable: user_id, product_id, quantity
Relaciones: 
- belongsTo(User::class) - Cada elemento del carrito pertenece a un usuario
- belongsTo(Product::class) - Cada elemento hace referencia a un producto

La tabla tiene una restricción única en (user_id, product_id) para evitar que un usuario tenga el mismo producto duplicado en el carrito. Si se intenta añadir un producto que ya existe, se actualiza la cantidad en lugar de crear un nuevo registro.

3.4.4. Order

El modelo Order representa los pedidos realizados por los usuarios.

Campos fillable: user_id, total_cents, status, stripe_session_id, stripe_payment_intent_id
Relaciones:
- belongsTo(User::class) - Cada pedido pertenece a un usuario
- hasMany(OrderItem::class) - Un pedido contiene múltiples elementos

El campo status puede tener tres valores: pending (pendiente), completed (completado) o failed (fallido). Los campos stripe_session_id y stripe_payment_intent_id almacenan los identificadores de Stripe para poder rastrear el pago asociado al pedido.

3.4.5. OrderItem

El modelo OrderItem representa los productos individuales dentro de un pedido.

Campos fillable: order_id, product_id, quantity, price_cents
Relaciones:
- belongsTo(Order::class) - Cada elemento pertenece a un pedido
- belongsTo(Product::class) - Cada elemento hace referencia a un producto

El campo price_cents guarda el precio del producto en el momento de la compra. Esto es importante porque los precios pueden cambiar con el tiempo, y necesitamos mantener un histórico preciso de cuánto pagó el usuario por cada producto.

3.5. Controladores

Los controladores manejan la lógica de negocio de la aplicación y procesan las peticiones HTTP. Todos los controladores se encuentran en el directorio app/Http/Controllers/.

3.5.1. AuthController

Este controlador maneja toda la lógica de autenticación de usuarios usando Laravel Sanctum.

Métodos principales:

register(Request) - Registra un nuevo usuario
Valida los datos de entrada (name, email, password)
Crea el usuario con la contraseña hasheada
Genera un token de autenticación usando Sanctum
Retorna el token y los datos del usuario

login(Request) - Inicia sesión de un usuario existente
Valida las credenciales (email, password)
Verifica que la contraseña sea correcta usando Hash::check()
Genera un nuevo token de autenticación
Retorna el token y los datos del usuario

me(Request) - Obtiene los datos del usuario autenticado
Requiere autenticación (middleware auth:sanctum)
Retorna los datos del usuario actual incluyendo is_admin

logout(Request) - Cierra sesión del usuario
Elimina el token actual de autenticación
El usuario debe volver a hacer login para realizar operaciones protegidas

La validación de contraseñas requiere un mínimo de 8 caracteres. El email debe ser único en la base de datos.

3.5.2. ProductController

Este controlador gestiona las operaciones relacionadas con los productos.

Métodos principales:

index(Request) - Lista todos los productos con paginación y filtros avanzados
Soporta búsqueda mediante el parámetro 'q' en la query string
Busca en los campos name, brand, category y description
Filtros disponibles:
  - category: Filtrar por categoría específica
  - brand: Filtrar por marca
  - min_price y max_price: Rango de precio en céntimos
  - in_stock: Solo productos con stock disponible
  - sort_by: Ordenar por price, name o stock
  - sort_order: asc o desc
Retorna 12 productos por página
La respuesta incluye metadatos de paginación (total, links, etc.)

show(Product) - Muestra los detalles de un producto específico
Usa route model binding de Laravel para cargar el producto automáticamente
Retorna todos los campos del producto

filters() - Obtiene los valores únicos para filtros
Retorna todas las categorías disponibles
Retorna todas las marcas disponibles
Retorna el rango de precios (mínimo y máximo)
Usado por el frontend para poblar los selectores de filtros

store(Request) - Crea un nuevo producto (solo administradores)
Requiere autenticación y middleware 'admin'
Valida los datos del producto
Crea el producto en la base de datos

update(Request, Product) - Actualiza un producto existente (solo administradores)
Requiere autenticación y middleware 'admin'
Valida los datos actualizados
Actualiza el producto en la base de datos

destroy(Product) - Elimina un producto (solo administradores)
Requiere autenticación y middleware 'admin'
Elimina el producto de la base de datos

3.5.3. CartController

Este controlador gestiona el carrito de compra de cada usuario autenticado.

Métodos principales:

index(Request) - Lista los items del carrito del usuario actual
Usa eager loading (with('product')) para cargar los datos del producto
Solo retorna los items del usuario autenticado
Cada item incluye el producto completo con su precio e información

store(Request) - Añade un producto al carrito
Valida que el product_id exista en la base de datos
La cantidad por defecto es 1 si no se especifica
Si el producto ya existe en el carrito, incrementa la cantidad
Si no existe, crea un nuevo item en el carrito
Usa firstOrNew() para evitar duplicados gracias a la restricción única

update(Request, CartItem) - Actualiza la cantidad de un item
Verifica que el item pertenezca al usuario autenticado (seguridad)
Valida que la cantidad sea un número entero mayor o igual a 1
Actualiza solo el campo quantity

destroy(Request, CartItem) - Elimina un item del carrito
Verifica que el item pertenezca al usuario autenticado
Elimina el item completamente de la base de datos

Todos los métodos incluyen verificaciones de autorización para asegurar que los usuarios solo puedan gestionar su propio carrito.

3.5.4. PaymentController

Este controlador gestiona todo el proceso de pago usando Stripe.

Métodos principales:

createCheckoutSession(Request) - Crea una sesión de pago en Stripe
Obtiene todos los items del carrito del usuario
Verifica que el carrito no esté vacío
Calcula el total del pedido
Crea una orden en la base de datos con status 'pending'
Crea los order_items asociados guardando el precio actual de cada producto
Construye los line_items para Stripe con nombre, precio e imagen
Crea la sesión de Stripe Checkout con URLs de éxito y cancelación
Incluye metadata con user_id y order_id para identificar la orden
Guarda el stripe_session_id en la orden
Retorna la URL de checkout a la que el frontend redirige al usuario

webhook(Request) - Procesa webhooks de Stripe
Verifica la firma del webhook usando el endpoint secret de Stripe
Escucha el evento 'checkout.session.completed'
Cuando un pago se completa exitosamente:
  - Actualiza el status de la orden a 'completed'
  - Guarda el stripe_payment_intent_id
  - Reduce el stock de los productos comprados
  - Limpia el carrito del usuario
Todo se ejecuta dentro de una transacción DB para garantizar consistencia

checkoutSuccess(Request) - Obtiene los detalles de una orden exitosa
Recibe el session_id como parámetro
Obtiene el user_id de los metadata de la sesión de Stripe (ruta pública)
Busca la orden asociada en la base de datos
Retorna la orden con todos sus items y productos

He implementado manejo de errores completo con try-catch para capturar excepciones de la API de Stripe y registrarlas en los logs. Esto facilita la depuración de problemas relacionados con pagos.

3.5.5. ChatController

Este controlador gestiona el chatbot inteligente que utiliza Google AI (Gemini).

Métodos principales:

chat(Request) - Procesa mensajes del chatbot
Valida el mensaje del usuario
Obtiene productos disponibles para proporcionar contexto
Construye un prompt con información de productos y categorías
Envía el mensaje a la API de Google Gemini
Procesa la respuesta y detecta menciones de productos
Retorna la respuesta del chatbot con productos detectados (si los hay)

El chatbot utiliza el contexto de los productos disponibles en la tienda para proporcionar recomendaciones personalizadas y responder preguntas sobre componentes informáticos.

3.5.6. OrderController

Este controlador gestiona las órdenes de los usuarios.

Métodos principales:

index(Request) - Lista las órdenes del usuario autenticado
Retorna todas las órdenes del usuario con sus items y productos
Ordenadas por fecha de creación (más recientes primero)

show(Order) - Muestra los detalles de una orden específica
Verifica que la orden pertenezca al usuario autenticado
Retorna la orden completa con todos sus items y productos

3.6. Migraciones

Las migraciones definen la estructura de las tablas de la base de datos y se ejecutan con el comando php artisan migrate. Todas las migraciones están en el directorio database/migrations/.

3.6.1. users

Esta migración viene por defecto con Laravel y crea la tabla users con los campos necesarios para la autenticación.

Campos: id, name, email (único), email_verified_at, password, remember_token, created_at, updated_at

También crea las tablas auxiliares password_reset_tokens y sessions para gestionar restablecimiento de contraseñas y sesiones web.

Una migración adicional añade el campo is_admin para identificar usuarios administradores.

3.6.2. products

Crea la tabla products para almacenar los productos de la tienda.

Campos: id, name, description, stock, brand, category, image_url, price_cents, created_at, updated_at

El campo price_cents es de tipo unsigned bigint para almacenar precios en céntimos sin problemas de precisión decimal.

3.6.3. cart_items

Crea la tabla cart_items con claves foráneas a users y products.

Campos: id, user_id, product_id, quantity, created_at, updated_at
Restricción única: (user_id, product_id) - Evita que un usuario tenga el mismo producto duplicado
Claves foráneas con onDelete('cascade') - Si se elimina un usuario o producto, se eliminan los items relacionados

3.6.4. orders

Crea la tabla orders para almacenar los pedidos de los usuarios.

Campos: id, user_id, total_cents, status (default 'pending'), stripe_session_id, stripe_payment_intent_id, created_at, updated_at
Clave foránea a users con onDelete('cascade')

3.6.5. order_items

Crea la tabla order_items con los productos individuales de cada pedido.

Campos: id, order_id, product_id, quantity, price_cents, created_at, updated_at
Claves foráneas a orders y products con onDelete('cascade')

El campo price_cents guarda el precio en el momento de la compra para mantener un histórico preciso.

3.7. Seeders

Los seeders poblan la base de datos con datos de prueba. Se ejecutan con php artisan db:seed.

3.7.1. RealProductSeeder

Este seeder crea 171 productos realistas de componentes informáticos con información detallada.

Incluye productos de diferentes categorías:
- Procesadores (Intel Core i9-14900K, AMD Ryzen 9 7950X3D, etc.)
- Tarjetas gráficas (RTX 4090, RX 7900 XTX, etc.)
- Placas base (ASUS ROG, MSI, Gigabyte, etc.)
- Memoria RAM (DDR5, DDR4 de varias marcas)
- Almacenamiento (SSD NVMe, SATA)
- Fuentes de alimentación (Corsair, Seasonic, etc.)
- Cajas, refrigeración, periféricos y monitores

Cada producto incluye:
- Nombre descriptivo con modelo exacto
- Descripción técnica detallada
- Marca reconocida del sector
- Categoría específica
- Precio realista en céntimos
- Stock aleatorio entre 0 y 50 unidades
- Ruta a imagen local (las imágenes se descargaron manualmente)

He decidido crear este seeder manual en lugar de usar APIs externas porque las APIs de componentes informáticos (como las de Amazon o Newegg) requieren ser vendedor autorizado para acceder a ellas, lo cual no es viable para un proyecto educativo.

3.7.2. AdminUserSeeder

Este seeder crea un usuario administrador por defecto para poder acceder al panel de administración.

3.7.3. DatabaseSeeder

El seeder principal que orquesta la ejecución de otros seeders.

Llama a RealProductSeeder para poblar la tabla de productos.
Llama a AdminUserSeeder para crear el usuario administrador.
Se puede extender fácilmente para añadir más seeders en el futuro (usuarios de prueba, pedidos de ejemplo, etc.)

3.8. Rutas API

Todas las rutas de la API están definidas en routes/api.php y tienen el prefijo /api automáticamente.

3.8.1. Rutas públicas

GET /api/products - Lista todos los productos con paginación, búsqueda y filtros
Parámetros opcionales: 
  - q (búsqueda por texto)
  - page (número de página)
  - category (filtrar por categoría)
  - brand (filtrar por marca)
  - min_price (precio mínimo en céntimos)
  - max_price (precio máximo en céntimos)
  - in_stock (boolean, solo con stock)
  - sort_by (price, name, stock)
  - sort_order (asc, desc)
No requiere autenticación

GET /api/products/{id} - Obtiene los detalles de un producto específico
No requiere autenticación

GET /api/products/filters/available - Obtiene valores únicos para filtros
Retorna: categorías, marcas y rango de precios disponibles
No requiere autenticación

POST /api/chat - Envía un mensaje al chatbot
Body: message, conversation_history (opcional)
Retorna: respuesta del chatbot y productos detectados (si los hay)
No requiere autenticación

GET /api/checkout/success - Obtiene los detalles de un pedido exitoso
Parámetros: session_id
No requiere autenticación (Stripe redirige aquí)

3.8.2. Rutas de autenticación

POST /api/auth/register - Registra un nuevo usuario
Body: name, email, password
Retorna: token, user

POST /api/auth/login - Inicia sesión
Body: email, password
Retorna: token, user

3.8.3. Rutas protegidas

Requieren el token de autenticación en el header Authorization: Bearer {token}
Usan el middleware auth:sanctum

GET /api/auth/me - Obtiene los datos del usuario autenticado
POST /api/auth/logout - Cierra sesión (invalida el token)

GET /api/cart - Lista los items del carrito
POST /api/cart - Añade un producto al carrito (body: product_id, quantity)
PUT /api/cart/{id} - Actualiza la cantidad de un item (body: quantity)
DELETE /api/cart/{id} - Elimina un item del carrito

POST /api/checkout/create-session - Crea una sesión de pago en Stripe
Retorna: sessionId, url (URL de checkout de Stripe)

GET /api/orders - Lista las órdenes del usuario autenticado
GET /api/orders/{id} - Obtiene los detalles de una orden específica

3.8.4. Rutas de administración

Requieren autenticación y el middleware 'admin' (usuario con is_admin = true)

POST /api/admin/products - Crea un nuevo producto
PUT /api/admin/products/{id} - Actualiza un producto existente
DELETE /api/admin/products/{id} - Elimina un producto

3.8.5. Webhooks

POST /api/webhook/stripe - Recibe notificaciones de Stripe
No requiere autenticación pero verifica la firma de Stripe
Se ejecuta automáticamente cuando Stripe confirma un pago
Actualiza el estado de la orden y limpia el carrito

Este endpoint está excluido de la protección CSRF en bootstrap/app.php porque Stripe no puede enviar el token CSRF.

4. Manual de usuario

Este manual describe el funcionamiento de la aplicación desde la perspectiva del usuario final. La aplicación está diseñada para ser intuitiva y fácil de usar.

4.1. Parte común: Página principal, login y registro

La aplicación presenta una interfaz limpia con un menú de navegación en la parte superior que permite acceder a las diferentes secciones.

4.1.1. Registro de usuario

Para registrarse en CheapParts:
1. Hacer clic en el botón "Register" en el menú superior
2. Completar el formulario con nombre, email y contraseña
3. La contraseña debe tener al menos 8 caracteres
4. Al enviar el formulario, se crea la cuenta automáticamente
5. El sistema inicia sesión automáticamente y redirige al catálogo de productos

El email debe ser único, no se pueden registrar dos usuarios con el mismo correo electrónico.

4.1.2. Inicio de sesión

Para iniciar sesión con una cuenta existente:
1. Hacer clic en "Login" en el menú superior
2. Introducir email y contraseña
3. Al iniciar sesión correctamente, se redirige al catálogo de productos
4. El menú superior muestra ahora opciones para usuarios autenticados

Si las credenciales son incorrectas, se muestra un mensaje de error indicando que el email o la contraseña no son válidos.

4.1.3. Página principal

La página principal presenta información básica sobre CheapParts y permite navegar a las secciones principales:
- Ver productos: accede al catálogo completo
- Login/Register: para usuarios no autenticados
- Cart: para usuarios autenticados, muestra el carrito de compra

El diseño es responsive y se adapta a diferentes tamaños de pantalla (móvil, tablet, escritorio).

4.2. Usuario autenticado

Una vez autenticado, el usuario tiene acceso a todas las funcionalidades de la tienda.

4.2.1. Catálogo de productos

El catálogo muestra los productos disponibles en tarjetas con:
- Imagen del producto
- Nombre y descripción
- Categoría (en español)
- Marca
- Precio en euros
- Stock disponible

Funcionalidades:
- Búsqueda: campo de búsqueda en la parte superior para filtrar por nombre, marca, categoría o descripción
- Filtros avanzados: 
  - En móvil: drawer deslizable desde la derecha
  - En desktop: barra lateral fija
  - Filtros por:
    - Categoría (10 categorías disponibles)
    - Marca
    - Rango de precio (con sliders interactivos)
    - Disponibilidad (solo productos con stock)
- Ordenamiento: ordenar por precio, nombre o stock (ascendente/descendente)
- Paginación: 12 productos por página con botones para navegar entre páginas
- Detalle: hacer clic en cualquier producto para ver la información completa

Los filtros se reflejan en la URL, permitiendo compartir búsquedas específicas. Las categorías se muestran en español para mejor usabilidad. El diseño es completamente responsive con un drawer móvil para los filtros.

4.2.2. Detalle de producto

La página de detalle muestra toda la información del producto:
- Imagen grande del producto
- Nombre completo
- Descripción técnica detallada
- Precio
- Marca
- Categoría
- Stock disponible

Acciones disponibles:
- Añadir al carrito: botón que añade el producto al carrito con cantidad 1
- Volver a productos: regresa al catálogo

Si el producto ya está en el carrito, al añadirlo nuevamente se incrementa la cantidad.

4.2.3. Carrito de compra

El carrito muestra todos los productos que el usuario ha añadido:
- Imagen miniatura del producto
- Nombre
- Precio unitario
- Cantidad (se puede modificar)
- Subtotal (precio × cantidad)
- Total general del carrito

Acciones disponibles:
- Modificar cantidad: usar los botones + y - para ajustar la cantidad
- Eliminar producto: botón para quitar el producto del carrito
- Proceder al pago: inicia el proceso de checkout

El carrito se guarda en la base de datos y persiste entre sesiones, por lo que al cerrar sesión y volver a entrar, los productos siguen ahí.

4.2.4. Chatbot

La aplicación incluye un chatbot inteligente accesible desde un botón flotante en la esquina inferior derecha. El chatbot utiliza Google AI (Gemini) para proporcionar asistencia sobre productos y componentes informáticos.

Funcionalidades:
- Responde preguntas sobre productos disponibles
- Recomienda productos basándose en necesidades del usuario
- Detecta menciones de productos y muestra tarjetas con información
- Mantiene contexto de la conversación
- Interfaz de chat moderna y responsive

4.2.5. Proceso de checkout y pago

Al hacer clic en "Proceder al pago":
1. Se crea una orden en la base de datos con estado "pending"
2. Se genera una sesión de pago en Stripe
3. El usuario es redirigido a la página de checkout de Stripe
4. En Stripe se introduce la información de la tarjeta
5. Para pruebas se puede usar la tarjeta: 4242 4242 4242 4242
6. Fecha de expiración: cualquier fecha futura
7. CVC: cualquier número de 3 dígitos

Stripe procesa el pago de forma segura sin que la aplicación maneje directamente la información de la tarjeta.

4.2.6. Confirmación de pedido

Después de completar el pago:
1. Stripe redirige a la página de éxito
2. Se muestra un mensaje de confirmación con el número de pedido
3. El webhook de Stripe actualiza el estado de la orden a "completed"
4. Se reduce el stock de los productos comprados
5. El carrito se vacía automáticamente

Si el usuario cancela el pago, se redirige a una página de cancelación donde puede volver al carrito para intentarlo nuevamente. La orden queda en estado "pending" y no afecta al stock.

4.2.7. Historial de pedidos

Los usuarios autenticados pueden ver su historial de pedidos accediendo a "Tus pedidos" en el menú. Se muestran todas las órdenes con:
- Número de orden
- Fecha
- Estado (completado, pendiente, fallido)
- Total pagado
- Lista de productos comprados

4.3. Usuario administrador

Los usuarios con permisos de administrador tienen acceso a un panel de administración adicional.

4.3.1. Panel de administración

El panel de administración permite:
- Ver todos los productos de la tienda
- Crear nuevos productos con formulario completo
- Editar productos existentes (nombre, descripción, precio, stock, marca, categoría, imagen)
- Eliminar productos
- Subir imágenes de productos mediante drag & drop o selección de archivo

Acceso:
- Solo usuarios con is_admin = true pueden acceder
- Se accede desde el menú superior cuando el usuario es administrador
- Si un usuario no administrador intenta acceder, es redirigido a la página principal

5. Diseño

5.1. Arquitectura de la aplicación

CheapParts sigue una arquitectura cliente-servidor separada, donde el backend y el frontend son aplicaciones independientes que se comunican mediante una API REST.

5.1.1. Backend (Laravel)

El backend es una API REST desarrollada con Laravel que proporciona todos los servicios necesarios para el funcionamiento de la tienda:

Estructura:
- Controladores: Procesan las peticiones HTTP y coordinan la lógica de negocio
- Modelos: Representan las entidades de la base de datos usando Eloquent ORM
- Migraciones: Definen la estructura de la base de datos de forma versionada
- Middlewares: Gestionan la autenticación y autorización con Sanctum
- Rutas: Definen los endpoints disponibles en la API

Características:
- Autenticación stateless basada en tokens (Laravel Sanctum)
- Validación de datos en cada endpoint
- Paginación automática de resultados
- Eager loading para optimizar consultas a la base de datos
- Transacciones DB para operaciones críticas (pagos)
- Logging de errores para facilitar debugging
- CORS configurado para permitir peticiones desde el frontend
- Middleware personalizado para verificar permisos de administrador

El backend no renderiza vistas HTML, solo retorna JSON. Esto permite que cualquier cliente (web, móvil, etc.) pueda consumir la API.

5.1.2. Frontend (React)

El frontend es una Single Page Application desarrollada con React que consume la API del backend:

Estructura:
- Componentes: Piezas reutilizables de la interfaz (Layout, Chat, etc.)
- Páginas: Vistas completas de cada sección (Home, Products, Cart, etc.)
- Hooks: useState, useEffect para gestión de estado y efectos
- Router: React Router para navegación sin recargar la página
- API Client: Axios configurado con interceptores para autenticación

Características:
- Navegación instantánea sin recargas de página
- Gestión de estado local con React hooks
- Almacenamiento del token en localStorage
- Interceptores que añaden automáticamente el token a las peticiones
- Manejo de errores y redirección automática al login si el token expira
- Interfaces TypeScript para tipado seguro de datos
- Diseño completamente responsive con Tailwind CSS
- Prevención de overflow horizontal en móvil
- Drawer móvil para filtros

He elegido React porque permite crear interfaces dinámicas y reactivas que mejoran significativamente la experiencia del usuario. El uso de TypeScript añade seguridad en el desarrollo al detectar errores de tipado en tiempo de compilación.

5.1.3. Comunicación API

La comunicación entre frontend y backend se realiza mediante peticiones HTTP en formato JSON:

Flujo típico:
1. El frontend realiza una petición HTTP a un endpoint de la API
2. Si la ruta requiere autenticación, se envía el token en el header Authorization
3. El backend valida el token y procesa la petición
4. El backend retorna una respuesta JSON con los datos o errores
5. El frontend procesa la respuesta y actualiza la interfaz

Configuración CORS:
He configurado CORS en el backend para permitir peticiones desde el dominio del frontend. En producción, se permite https://cheap-parts-frontend.onrender.com. Esto es necesario porque el frontend y el backend corren en dominios diferentes y los navegadores bloquean peticiones cross-origin por seguridad.

Interceptores de Axios:
El cliente API tiene interceptores configurados que:
- Añaden automáticamente el token Bearer a peticiones autenticadas
- Capturan errores 401 (no autenticado) y redirigen al login
- Transforman respuestas de error en objetos consistentes
- Detectan automáticamente la URL de la API basándose en el entorno

5.2. Maquetación

5.2.1. Estructura de componentes

La aplicación usa una estructura jerárquica de componentes:

Layout: Componente principal que envuelve todas las páginas
- Header: Barra de navegación con logo, links y estado de autenticación
- Main: Contenido principal de cada página
- Footer: Información de la empresa y enlaces
- Chat: Componente de chatbot flotante

Componentes reutilizables:
- Chat: Chatbot inteligente con Google AI
- ProductCard: Tarjeta para mostrar productos en el catálogo (implícito en Products)

Páginas:
- Home: Página principal de bienvenida
- Login: Formulario de inicio de sesión
- Register: Formulario de registro
- Products: Catálogo con búsqueda, filtros y paginación
- ProductDetail: Detalle de un producto específico
- Cart: Carrito de compra con gestión de cantidades
- Orders: Historial de pedidos del usuario
- Admin: Panel de administración de productos
- CheckoutSuccess: Confirmación de pedido exitoso
- CheckoutCancel: Página cuando se cancela el pago

Esta estructura facilita el mantenimiento y permite reutilizar componentes en diferentes partes de la aplicación.

5.2.2. Diseño responsive

El diseño se adapta completamente a diferentes tamaños de pantalla usando Tailwind CSS y sus clases responsive:

Móvil (< 640px):
- Menú de navegación con hamburguesa
- Productos en una columna
- Filtros en drawer deslizable desde la derecha
- Carrito en una columna
- Textos y botones con tamaños ajustados
- Overflow horizontal prevenido

Tablet (640px - 1024px):
- Menú de navegación horizontal
- Productos en 2 columnas
- Filtros en drawer móvil o sidebar según preferencia
- Carrito con layout mejorado

Desktop (> 1024px):
- Menú de navegación completo
- Productos en 3 columnas (grid)
- Filtros en sidebar fijo a la izquierda
- Máximo ancho de contenido para mejorar legibilidad

He utilizado las clases responsive de Tailwind (sm:, md:, lg:, xl:) para aplicar estilos diferentes según el tamaño de pantalla. También he implementado overflow-x-hidden en el body y contenedores principales para prevenir scroll horizontal no deseado en móvil.

5.3. Usabilidad (Reglas de Jacob Nielsen)

He aplicado las 10 heurísticas de usabilidad de Jakob Nielsen en el diseño de CheapParts:

5.3.1. Visibilidad del estado del sistema

La aplicación mantiene al usuario informado sobre lo que está ocurriendo:
- Estados de carga: Se muestran indicadores durante peticiones a la API
- Mensajes de confirmación: Al añadir productos al carrito, actualizar cantidades, etc.
- Estado de autenticación: El menú cambia según el usuario esté autenticado o no
- Feedback visual: Botones cambian de apariencia al hacer hover o estar deshabilitados
- Indicador de carrito: Muestra el número de items en el carrito
- Indicadores de stock: Muestra claramente si un producto está disponible

5.3.2. Relación con el mundo real

La aplicación usa un lenguaje familiar y conceptos del mundo real:
- "Carrito de compra" en lugar de "cesta de datos"
- "Checkout" para el proceso de pago
- Precios en euros (moneda común)
- Términos técnicos correctos para componentes informáticos
- Proceso de compra similar al de tiendas físicas
- Chatbot que habla de forma natural

5.3.3. Control y libertad del usuario

El usuario tiene control sobre sus acciones:
- Puede modificar cantidades en el carrito antes de pagar
- Puede eliminar productos del carrito en cualquier momento
- Puede cancelar el pago en Stripe y volver al carrito
- Puede cerrar sesión cuando quiera
- Navegación libre entre secciones sin restricciones
- Puede cerrar el drawer de filtros en móvil
- Puede minimizar el chatbot

5.3.4. Consistencia y estándares

La aplicación mantiene consistencia en diseño y comportamiento:
- Colores y estilos uniformes en toda la aplicación
- Botones similares tienen la misma apariencia
- Estructura de páginas predecible
- Menú de navegación siempre en el mismo lugar
- Convenciones estándar de e-commerce (precio, stock, carrito)
- Iconos consistentes en toda la aplicación

5.3.5. Prevención de errores

Se implementan mecanismos para prevenir errores:
- Validación de formularios en tiempo real
- Campos obligatorios claramente marcados
- Contraseñas con requisitos mínimos (8 caracteres)
- Verificación de stock antes de añadir al carrito
- Confirmación implícita antes de acciones críticas (pago)
- Prevención de overflow horizontal en móvil

5.3.6. Reconocimiento antes que recuerdo

La interfaz es intuitiva y no requiere memorizar información:
- Navegación visible en todo momento
- El carrito muestra imágenes y nombres de productos
- No es necesario recordar IDs o códigos
- Opciones visibles en lugar de comandos ocultos
- Información contextual disponible donde se necesita
- Filtros visibles y accesibles

5.3.7. Flexibilidad y eficiencia de uso

La aplicación es eficiente para diferentes tipos de usuarios:
- Búsqueda rápida de productos
- Paginación para navegar grandes catálogos
- Añadir productos directamente desde el catálogo o desde el detalle
- Proceso de checkout streamlined
- URLs directas a productos (se pueden compartir)
- Filtros que se pueden combinar
- Chatbot para asistencia rápida

5.3.8. Estética y diseño minimalista

El diseño es limpio y sin elementos innecesarios:
- Solo se muestra información relevante
- Espaciado adecuado entre elementos
- Jerarquía visual clara (títulos, precios destacados)
- Sin distracciones innecesarias
- Uso efectivo del espacio en blanco
- Colores consistentes y profesionales

5.3.9. Ayudar a los usuarios a reconocer, diagnosticar y recuperarse de errores

Los errores se manejan de forma clara:
- Mensajes de error descriptivos (no códigos técnicos)
- Indicación de qué campo tiene problemas en formularios
- Sugerencias sobre cómo corregir errores
- Redirección automática al login si el token expira
- Manejo graceful de errores de red
- Mensajes informativos en cada paso del proceso

5.3.10. Ayuda y documentación

Aunque la aplicación está diseñada para ser intuitiva, proporciona ayuda cuando es necesaria:
- Placeholders en campos de formulario
- Descripciones claras de productos
- Información de stock disponible
- Mensajes informativos en cada paso del proceso
- Chatbot para asistencia en tiempo real
- Esta documentación como referencia completa

6. Integración de Stripe

Stripe es la pasarela de pago que he integrado para procesar pagos de forma segura. La integración involucra varios componentes trabajando juntos.

6.1. Configuración inicial

Para usar Stripe necesitas crear una cuenta en stripe.com y obtener las claves de API. Stripe proporciona dos conjuntos de claves: uno para pruebas y otro para producción.

En el backend, se instala el SDK oficial de Stripe para PHP:
composer require stripe/stripe-php

Las claves se configuran en el archivo .env (o variables de entorno en producción):
STRIPE_KEY=pk_test_... (clave pública, se puede compartir con el frontend)
STRIPE_SECRET=sk_test_... (clave secreta, solo en el backend)

En el constructor del PaymentController se inicializa Stripe con la clave secreta. He añadido validación para detectar cuando falta la configuración y mostrar un error claro en lugar de fallar silenciosamente.

6.2. Creación de sesión de checkout

El proceso de checkout usa Stripe Checkout, una página de pago hospedada por Stripe:

1. El frontend llama a POST /api/checkout/create-session
2. El backend obtiene los items del carrito del usuario
3. Se crea una orden en la base de datos con status "pending"
4. Se crean los order_items guardando el precio actual
5. Se construyen los line_items para Stripe con nombre, precio e imagen de cada producto
6. Se crea una sesión de Stripe Checkout con:
   - line_items: productos a pagar
   - success_url: URL a la que redirigir después del pago exitoso
   - cancel_url: URL si el usuario cancela
   - metadata: order_id y user_id para identificar la orden
7. Se guarda el stripe_session_id en la orden
8. Se retorna la URL de checkout al frontend
9. El frontend redirige al usuario a esa URL
10. El usuario completa el pago en la página de Stripe

Stripe Checkout maneja toda la complejidad del proceso de pago: formularios de tarjeta, validación, 3D Secure, procesamiento, etc. Esto simplifica enormemente el desarrollo y garantiza el cumplimiento de normativas PCI-DSS.

6.3. Webhooks y confirmación de pago

Los webhooks son notificaciones que Stripe envía cuando ocurren eventos importantes. He configurado el webhook checkout.session.completed que se dispara cuando un pago se completa exitosamente.

Flujo del webhook:
1. El usuario completa el pago en Stripe
2. Stripe envía una petición POST a /api/webhook/stripe
3. El backend verifica la firma del webhook para asegurar que viene de Stripe
4. Se busca la orden usando el stripe_session_id
5. Si la orden está en estado "pending", se ejecuta una transacción que:
   - Actualiza el status a "completed"
   - Guarda el stripe_payment_intent_id
   - Reduce el stock de cada producto comprado
   - Limpia el carrito del usuario
6. Se retorna respuesta 200 a Stripe

La verificación de firma es crucial para la seguridad. Sin ella, cualquiera podría enviar peticiones falsas para marcar órdenes como completadas.

El uso de transacciones DB garantiza que o se ejecutan todas las operaciones o ninguna, evitando estados inconsistentes si hay un error a mitad del proceso.

6.4. Gestión de órdenes

Cada orden tiene tres posibles estados:

- pending: Orden creada pero pago aún no confirmado
- completed: Pago confirmado, stock reducido, carrito limpiado
- failed: Pago rechazado o error en el proceso

Las órdenes se crean inmediatamente al iniciar el checkout para poder asociarlas con la sesión de Stripe. Si el usuario nunca completa el pago, la orden queda en "pending" pero no afecta al stock ni se limpia el carrito.

En una versión futura se podría implementar un comando programado que limpie órdenes pendientes antiguas o marque como "failed" las que Stripe reportó como fallidas.

7. Dificultades encontradas y soluciones

Durante el desarrollo me enfrenté a varios desafíos técnicos que requirieron investigación y resolución de problemas.

7.1. Gestión de imágenes de productos

Uno de los primeros problemas fue cómo obtener imágenes de productos reales para el seeder.

Intentos iniciales:
- Usé primero vía.placeholder.com para imágenes genéricas, pero el servicio dejó de responder
- Cambié a picsum.photos que funcionaba pero las imágenes eran genéricas sin relación con los productos

Solución:
- Decidí descargar manualmente imágenes específicas de cada producto desde páginas de fabricantes
- Las guardé en backend/public/images/products/
- Actualicé el seeder para usar rutas locales: /images/products/nombre-producto.jpg
- Esto garantiza que cada producto muestre exactamente la imagen correcta

Aunque el proceso manual tomó más tiempo, el resultado es mucho más profesional y realista. Las imágenes se sirven directamente desde el backend sin depender de servicios externos.

7.2. Configuración de Tailwind CSS

Al inicializar el frontend con Vite, tuve problemas con la configuración de Tailwind CSS.

Problema:
Tailwind v4 cambió la forma de integrarse con PostCSS y el método anterior ya no funcionaba. Aparecían errores sobre el plugin de PostCSS no encontrado.

Solución:
Decidí usar Tailwind CSS v3 que tiene una integración más estable y probada. Instalé la versión 3.4 junto con autoprefixer y configuré correctamente postcss.config.js. Fue necesario reiniciar el servidor de desarrollo para que los cambios surtieran efecto debido al caché de Vite.

Tailwind v3 es perfectamente adecuado para este proyecto y proporciona todas las utilidades que necesito.

7.3. Acceso a APIs externas de componentes

Inicialmente quería usar una API externa para obtener datos reales de productos de componentes informáticos.

Problema:
Las APIs de tiendas como Amazon, Newegg o PCPartPicker requieren que seas un vendedor autorizado o partner para acceder a sus datos de productos. No hay APIs públicas disponibles para obtener información de componentes informáticos.

Solución:
Creé manualmente un seeder con 171 productos realistas, investigando especificaciones técnicas y precios actuales de componentes reales. Aunque es más trabajo inicial, tengo control completo sobre los datos y no dependo de servicios externos que puedan cambiar o dejar de funcionar.

Esta aproximación también facilita las pruebas porque los datos son consistentes y predecibles.

7.4. Integración de Stripe

La integración de Stripe presentó varios desafíos relacionados con la configuración y el flujo de pago.

Problemas encontrados:
- Errores cuando las claves de Stripe no estaban configuradas
- Confusión sobre el flujo de checkout vs payment intents
- Manejo correcto de webhooks y verificación de firma
- Sincronización del estado de la orden con el pago
- Ruta de checkout/success que requería ser pública para redirecciones de Stripe

Soluciones implementadas:
- Añadí validación explícita de las claves de Stripe con mensajes de error claros
- Documenté el proceso completo de configuración
- Implementé logging de errores para facilitar debugging
- Usé Stripe Checkout en lugar de Payment Intents por ser más simple
- Implementé manejo de webhooks con verificación de firma
- Usé transacciones DB para garantizar consistencia
- Moví la ruta checkout/success fuera del middleware de autenticación
- Implementé obtención de user_id desde metadata de Stripe para rutas públicas

He aprendido mucho sobre procesamiento de pagos y la importancia de manejar correctamente los estados y errores en este tipo de integraciones críticas.

7.5. Manejo de paginación en frontend

Laravel retorna los datos paginados en un formato específico que al principio no manejé correctamente.

Problema:
Laravel paginate() retorna un objeto con metadata (total, links, etc.) y los datos en response.data.data. En el frontend estaba esperando que response.data fuera directamente un array, lo que causaba errores "products.map is not a function".

Solución:
Actualicé el código del frontend para acceder correctamente a response.data.data y añadí una verificación con Array.isArray() para asegurar que siempre trabajo con un array. También implementé manejo de la metadata de paginación para mostrar correctamente el número de página y links de navegación.

Este problema me enseñó la importancia de entender bien el formato de las respuestas de la API antes de consumirlas en el frontend.

7.6. Configuración de CORS en producción

Al desplegar en Render.com, tuve problemas con las peticiones CORS entre el frontend y el backend.

Problema:
Las peticiones desde el frontend (https://cheap-parts-frontend.onrender.com) al backend (https://cheap-parts-backend.onrender.com) eran bloqueadas por CORS.

Soluciones implementadas:
- Configuré correctamente backend/config/cors.php con el dominio del frontend
- Creé un middleware personalizado HandleCors para mayor control
- Añadí el middleware explícitamente en bootstrap/app.php
- Configuré FRONTEND_URL en las variables de entorno de producción

7.7. Despliegue en Render.com

El despliegue en Render.com presentó varios desafíos relacionados con la configuración de Docker y la base de datos.

Problemas encontrados:
- Render detectaba Dockerfiles antiguos que ya no se usaban
- Configuración de base de datos PostgreSQL
- Variables de entorno no se leían correctamente con config cache
- El backend necesitaba ejecutar migraciones y seeders al iniciar

Soluciones implementadas:
- Renombré archivos antiguos (.local) para que Render no los detecte
- Creé un Dockerfile optimizado para producción
- Configuré parseo de DATABASE_URL en el entrypoint del Docker
- Implementé config:clear y config:cache en el entrypoint
- Añadí ejecución automática de migraciones y seeders al iniciar
- Creé render.yaml para despliegue con Blueprint

7.8. Chatbot con Google AI

La integración del chatbot con Google AI presentó desafíos de configuración.

Problema:
La API key de Google AI no se leía correctamente en producción debido al cache de configuración de Laravel.

Solución:
- Añadí GOOGLE_AI_API_KEY a config/services.php
- Modifiqué ChatController para usar config() en lugar de env()
- Aseguré que config:clear y config:cache se ejecuten en el entrypoint

7.9. Diseño responsive en móvil

El diseño inicial no era completamente responsive y tenía problemas de overflow horizontal.

Problema:
En móvil, la página se podía deslizar horizontalmente, causando una mala experiencia de usuario.

Solución:
- Añadí overflow-x-hidden al body y html en index.css
- Implementé un drawer móvil para los filtros en lugar de sidebar fijo
- Ajusté tamaños de texto y padding para móvil
- Reduje el ancho del drawer móvil
- Añadí max-w-full a contenedores principales

8. Despliegue

Esta sección describe los pasos necesarios para desplegar CheapParts en un entorno de producción. La aplicación está actualmente desplegada en Render.com.

8.1. Arquitectura de producción

La aplicación está desplegada en Render.com con la siguiente arquitectura:

Backend:
- Servicio Web con Docker (cheap-parts-backend.onrender.com)
- Base de datos PostgreSQL (cheap-parts-db)
- Región: Frankfurt
- Plan: Free

Frontend:
- Static Site (cheap-parts-frontend.onrender.com)
- Build automático desde GitHub
- Región: Frankfurt
- Plan: Free

8.2. Configuración en Render.com

8.2.1. Backend (Docker)

El backend se despliega usando Docker. El Dockerfile está configurado para:
- Usar PHP 8.2-cli como imagen base
- Instalar extensiones necesarias (pdo_pgsql, mbstring, etc.)
- Instalar Composer
- Copiar archivos de la aplicación
- Instalar dependencias de Composer
- Configurar permisos
- Crear un entrypoint que:
  - Parsea DATABASE_URL
  - Limpia y cachea configuración
  - Ejecuta migraciones y seeders
  - Crea el storage link
  - Inicia php artisan serve

Variables de entorno requeridas en Render:
- APP_ENV=production
- APP_DEBUG=false
- LOG_LEVEL=error
- DB_CONNECTION=pgsql
- DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD (desde base de datos)
- DATABASE_URL (desde base de datos)
- FRONTEND_URL=https://cheap-parts-frontend.onrender.com
- STRIPE_KEY (clave pública de Stripe)
- STRIPE_SECRET (clave secreta de Stripe)
- GOOGLE_AI_API_KEY (clave de Google AI Studio)
- APP_KEY (generada automáticamente o manualmente)

8.2.2. Base de datos PostgreSQL

La base de datos PostgreSQL se crea automáticamente mediante render.yaml o manualmente en Render:
- Nombre: cheap-parts-db
- Plan: Free
- Región: Frankfurt
- Usuario: cheapparts

Las credenciales se inyectan automáticamente como variables de entorno en el servicio del backend.

8.2.3. Frontend (Static Site)

El frontend se despliega como Static Site en Render:
- Root Directory: frontend
- Build Command: npm install && npm run build
- Publish Directory: dist

Variables de entorno (opcionales):
- VITE_API_URL=https://cheap-parts-backend.onrender.com/api

El frontend detecta automáticamente la URL de la API basándose en el hostname, pero se puede configurar manualmente con VITE_API_URL.

Configuración de redirects:
Se debe configurar en Render un redirect/rewrite para que todas las rutas apunten a index.html (necesario para React Router):
- Pattern: /*
- Action: Rewrite
- Destination: /index.html
- Status Code: 200

8.2.4. Blueprint (render.yaml)

El proyecto incluye un archivo render.yaml que permite desplegar todos los servicios automáticamente:

```yaml
services:
  - type: web
    name: cheap-parts-backend
    runtime: docker
    region: frankfurt
    plan: free
    rootDir: backend
    dockerfilePath: Dockerfile
    envVars:
      - key: APP_ENV
        value: production
      - key: APP_DEBUG
        value: false
      - key: FRONTEND_URL
        value: https://cheap-parts-frontend.onrender.com
      # ... más variables

databases:
  - name: cheap-parts-db
    plan: free
    region: frankfurt
    databaseName: cheapparts
    user: cheapparts
```

Para usar el Blueprint:
1. Conectar el repositorio de GitHub a Render
2. Seleccionar "Apply Render Blueprint"
3. Render creará automáticamente todos los servicios

8.3. URLs de producción

Backend API:
https://cheap-parts-backend.onrender.com

Frontend:
https://cheap-parts-frontend.onrender.com

Base de datos:
PostgreSQL en Render (accesible solo desde el backend)

8.4. Configuración de Stripe en producción

Para habilitar pagos reales en producción:

1. Obtener claves de producción de Stripe:
   - Ir a Stripe Dashboard → Developers → API Keys
   - Cambiar a "Live mode"
   - Copiar las claves de producción

2. Configurar webhook en producción:
   - Ir a Stripe Dashboard → Developers → Webhooks
   - Añadir endpoint: https://cheap-parts-backend.onrender.com/api/webhook/stripe
   - Seleccionar evento: checkout.session.completed
   - Copiar el "Signing secret"

3. Añadir variables de entorno en Render:
   - STRIPE_KEY=pk_live_...
   - STRIPE_SECRET=sk_live_...
   - STRIPE_WEBHOOK_SECRET=whsec_...

8.5. Configuración de Google AI en producción

Para habilitar el chatbot en producción:

1. Obtener API key de Google AI Studio:
   - Visitar https://aistudio.google.com/
   - Crear o seleccionar proyecto
   - Generar API key

2. Añadir variable de entorno en Render:
   - GOOGLE_AI_API_KEY=tu_clave_aqui

8.6. Consideraciones de producción

Seguridad:
- APP_DEBUG debe estar en false
- Las claves secretas nunca deben estar en el código
- Usar HTTPS (Render lo proporciona automáticamente)
- Verificar firmas de webhooks de Stripe

Rendimiento:
- Configuración cacheada (config:cache, route:cache)
- Optimización de autoloader de Composer
- Imágenes servidas desde storage público
- Frontend optimizado con Vite

Monitoreo:
- Logs disponibles en Render Dashboard
- Errores registrados en Laravel logs
- Stripe Dashboard para monitorear pagos

8.7. Actualización de la aplicación

Para actualizar la aplicación en producción:

1. Hacer push a la rama main en GitHub
2. Render detecta automáticamente el cambio
3. Inicia un nuevo build
4. Si el build es exitoso, despliega la nueva versión

Para el backend:
- El build incluye la instalación de dependencias y la construcción de la imagen Docker
- Al iniciar, se ejecutan migraciones automáticamente

Para el frontend:
- El build ejecuta npm install && npm run build
- Los archivos estáticos se actualizan automáticamente

9. Conclusiones y futuras mejoras

9.1. Estado actual del proyecto

CheapParts es una aplicación e-commerce funcional y desplegada en producción que cumple con los objetivos iniciales del proyecto:

Funcionalidades implementadas:
- Sistema de autenticación completo con registro y login
- Catálogo de 171 productos en 10 categorías con búsqueda y paginación
- Filtros avanzados por categoría, marca, precio y stock
- Ordenamiento por precio, nombre y disponibilidad
- Carrito de compra persistente con gestión de cantidades
- Integración completa con Stripe para pagos seguros
- Gestión de órdenes y stock de productos
- Interfaz responsive y moderna con React y Tailwind CSS
- API REST robusta con Laravel y Sanctum
- Interfaz multiidioma (categorías en español)
- Chatbot inteligente con Google AI
- Panel de administración para gestión de productos
- Despliegue completo en producción (Render.com)

Arquitectura:
- Separación clara entre backend y frontend
- Comunicación mediante API REST
- Autenticación basada en tokens
- Base de datos relacional normalizada (PostgreSQL en producción)
- Código organizado y mantenible
- Containerización con Docker
- Despliegue automatizado con Render Blueprint

El proyecto demuestra conocimientos en desarrollo full-stack moderno, integrando tecnologías actuales de la industria como React, Laravel, Stripe, Google AI, Docker y servicios cloud como Render.com.

9.2. Mejoras futuras

Hay varias funcionalidades que se podrían implementar para mejorar la aplicación:

Filtros y búsqueda mejorados:
- Búsqueda más avanzada con sugerencias y autocompletado
- Filtros por múltiples categorías simultáneas
- Historial de búsquedas
- Guardado de filtros favoritos

Panel de administración mejorado:
- Estadísticas de ventas y productos más vendidos
- Gestión de órdenes y estados desde el panel
- Gestión de usuarios
- Dashboard con métricas

Funcionalidades de usuario:
- Perfil de usuario editable
- Lista de deseos / favoritos
- Reseñas y valoraciones de productos
- Comparador de productos
- Notificaciones por email

Mejoras técnicas:
- Implementar caché para mejorar rendimiento (Redis)
- Testing automatizado (PHPUnit, Jest)
- Notificaciones por email (confirmación de pedido, envío)
- Sistema de envío con tracking
- Descuentos y cupones promocionales
- Pago con múltiples métodos (PayPal, transferencia)
- Internacionalización completa (i18n)

Optimizaciones:
- Lazy loading de imágenes
- Optimización de queries con índices
- CDN para servir assets estáticos
- Service Workers para PWA
- Optimización de bundle size del frontend

9.3. Conclusiones

El desarrollo de CheapParts ha sido una experiencia de aprendizaje muy completa que me ha permitido aplicar conocimientos de múltiples áreas del desarrollo web:

Aprendizajes técnicos:
- Arquitectura de aplicaciones full-stack separadas
- Desarrollo de APIs REST con Laravel
- Implementación de filtros avanzados y búsqueda compleja
- Autenticación basada en tokens con Sanctum
- Desarrollo de SPAs con React y TypeScript
- Gestión de estado y URL params en React
- Integración de pasarelas de pago (Stripe)
- Integración de APIs de IA (Google Gemini)
- Internacionalización y traducción de contenido
- Diseño de bases de datos relacionales
- Manejo de CORS y comunicación cross-origin
- Diseño responsive con Tailwind CSS
- Containerización con Docker
- Despliegue en servicios cloud (Render.com)
- Configuración de bases de datos PostgreSQL
- Manejo de variables de entorno en producción

Aprendizajes sobre desarrollo:
- Importancia de la planificación y diseño previo
- Manejo de errores y debugging sistemático
- Documentación clara del código y procesos
- Versionado con Git y trabajo con repositorios
- Resolución de problemas técnicos complejos
- Despliegue y configuración de aplicaciones en producción

Desafíos superados:
- Integración de sistemas externos (Stripe, Google AI, APIs)
- Manejo de estados asíncronos en el frontend
- Sincronización de datos entre cliente y servidor
- Gestión de transacciones y consistencia de datos
- Configuración de herramientas modernas de desarrollo
- Despliegue y configuración en producción
- Resolución de problemas de CORS
- Configuración de Docker para producción
- Optimización de diseño responsive

CheapParts demuestra que soy capaz de desarrollar una aplicación web completa desde cero, tomando decisiones técnicas fundamentadas y resolviendo problemas de forma autónoma. El proyecto está desplegado en producción y funcional, y la base está sólida para escalar a nuevas funcionalidades.

Este proyecto me ha preparado para enfrentar desarrollos profesionales en el mundo real, donde es necesario manejar múltiples tecnologías, integrar servicios externos y crear aplicaciones robustas y seguras.

10. Anexo

10.1. Repositorio GitHub

El código fuente completo del proyecto está disponible en GitHub:
https://github.com/AndriySym/CheapParts

El repositorio incluye:
- Código fuente del backend (carpeta backend/)
- Código fuente del frontend (carpeta frontend/)
- Documentación del proyecto (carpeta docs/)
- README con instrucciones de instalación
- Archivo .gitignore configurado correctamente
- render.yaml para despliegue automático
- Dockerfile para containerización

10.2. URLs de producción

Backend API:
https://cheap-parts-backend.onrender.com

Frontend:
https://cheap-parts-frontend.onrender.com

10.3. Documentación adicional

Documentación técnica incluida en el repositorio:
- docs/GUIA_INSTALACION.md: Guía completa paso a paso para instalación
- docs/TS3_Seguimiento.md: Tercera tarea de seguimiento
- backend/STRIPE_SETUP.md: Guía detallada para configurar Stripe
- CHAT_SETUP.md: Guía para configurar el chatbot
- DEPLOYMENT.md: Información sobre despliegue
- README.md: Instrucciones de instalación y uso

10.4. Referencias

Documentación oficial consultada durante el desarrollo:

Laravel:
- Laravel Documentation: https://laravel.com/docs
- Laravel Sanctum: https://laravel.com/docs/sanctum
- Eloquent ORM: https://laravel.com/docs/eloquent

React y ecosistema:
- React Documentation: https://react.dev
- React Router: https://reactrouter.com
- TypeScript: https://www.typescriptlang.org/docs
- Vite: https://vitejs.dev

Herramientas y servicios:
- Tailwind CSS: https://tailwindcss.com/docs
- Stripe Documentation: https://stripe.com/docs
- Google AI Studio: https://aistudio.google.com
- Axios: https://axios-http.com/docs
- Render.com: https://render.com/docs

Recursos de aprendizaje:
- MDN Web Docs: https://developer.mozilla.org
- Stack Overflow para resolución de problemas específicos
- GitHub para buscar ejemplos de código

---

FIN DE LA DOCUMENTACIÓN

Andriy Symonenko Oliynyk
Proyecto Integrado - CheapParts
2025
