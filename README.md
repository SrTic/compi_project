Compi-Project
Este es el repositorio del proyecto "Compi-Project", una aplicación web desarrollada con Laravel que incluye un robusto sistema de gestión de usuarios con autenticación basada en roles, una interfaz de usuario mejorada y funcionalidades esenciales para su despliegue y mantenimiento.

Índice
Visión General del Proyecto

Funcionalidades Implementadas

Requisitos del Sistema

Configuración e Instalación

Uso de la Aplicación

Estructura de Roles y Acceso

Pruebas Automatizadas

Optimización de Rendimiento

Consideraciones para el Despliegue

Contacto

1. Visión General del Proyecto
"Compi-Project" es una aplicación web construida con el framework PHP Laravel. Su objetivo principal es proporcionar una plataforma con un sistema de autenticación seguro y una administración de usuarios eficiente. Es la base para futuras funcionalidades, como la gestión de recursos compartidos.

2. Funcionalidades Implementadas
Hasta la fecha, se han implementado las siguientes características clave:

Autenticación de Usuarios: Registro, inicio de sesión, recuperación de contraseña (gestionado por Laravel Breeze).

Gestión de Roles: Los usuarios pueden tener roles de administrador o usuario.

Control de Acceso Basado en Roles (RBAC):

Un AdminMiddleware asegura que solo los usuarios con el rol administrador puedan acceder a ciertas rutas (ej. la gestión de usuarios).

Las rutas sensibles están protegidas por el middleware auth para requerir autenticación.

CRUD Completo de Usuarios:

Crear: Los administradores pueden añadir nuevos usuarios a través de un formulario dedicado.

Leer (Listar): Un listado paginado y con funcionalidad de búsqueda permite a los administradores ver y filtrar usuarios.

Actualizar: Los administradores pueden editar los detalles de los usuarios existentes.

Eliminar: Los administradores pueden eliminar usuarios.

Interfaz de Usuario (UI/UX) Mejorada:

Vistas de gestión de usuarios (index.blade.php, create.blade.php, edit.blade.php) estilizadas con Tailwind CSS para una apariencia moderna y limpia.

Uso de un layout principal coherente (layouts/app.blade.php).

Mensajes Flash: Notificaciones de éxito y error claras para el usuario tras operaciones CRUD.

Notificaciones por Correo Electrónico: Envío de un correo de bienvenida a los nuevos usuarios creados por el administrador (configurado para usar el log driver en desarrollo).

Seguridad: Implementación de protección CSRF (Cross-Site Request Forgery) y prevención de XSS (Cross-Site Scripting) gracias a las características por defecto de Laravel.

Pruebas Automatizadas: Se han añadido pruebas de características (Feature Tests) para verificar el control de acceso basado en roles y el flujo de autenticación.

Optimización de Rendimiento: La aplicación está configurada para caching de configuración, rutas y vistas, y optimización del autocargador de Composer para un mejor rendimiento en producción.

3. Requisitos del Sistema
Para ejecutar este proyecto localmente, necesitarás:

PHP: ^8.1

Composer: ^2.0

Node.js y npm: Para compilar los assets (Tailwind CSS, JavaScript).

Base de Datos: MySQL (o PostgreSQL, SQLite, etc.).

Servidor Web: Apache o Nginx (o el servidor de desarrollo de PHP/Laravel).

Git: Para el control de versiones.

4. Configuración e Instalación
Sigue estos pasos para poner el proyecto en funcionamiento en tu máquina local:

Clonar el Repositorio:

git clone https://github.com/SrTic/compi_project.git
cd compi_project

Instalar Dependencias de Composer:

composer install

Configurar el Archivo de Entorno (.env):

Copia el archivo de ejemplo:

cp .env.example .env

Abre el archivo .env y configura tus credenciales de base de datos (DB_DATABASE, DB_USERNAME, DB_PASSWORD), la URL de tu aplicación (APP_URL), y asegúrate de que APP_NAME esté configurado.

Configura el correo para pruebas (se escribirán en storage/logs/laravel.log):

MAIL_MAILER=log
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

Generar la Clave de la Aplicación:

php artisan key:generate

Ejecutar Migraciones de Base de Datos:

php artisan migrate

Instalar y Compilar Dependencias de NPM:

npm install
npm run dev  # Para desarrollo y observación de cambios
# Para producción: npm run build

Crear Usuario Administrador (opcional, pero recomendado para pruebas):

Abre Tinker: php artisan tinker

Crea el usuario:

App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => Hash::make('password'),
    'rol' => 'administrador',
]);

Sale de Tinker: exit

Iniciar el Servidor de Desarrollo:

php artisan serve

La aplicación estará disponible en http://127.0.0.1:8000.

5. Uso de la Aplicación
Página de Inicio: http://127.0.0.1:8000/

Login: http://127.0.0.1:8000/login

Registro: http://127.0.0.1:8000/register

Dashboard (requiere autenticación): http://127.0.0.1:8000/dashboard

Gestión de Usuarios (requiere rol de administrador): http://127.0.0.1:8000/usuarios

Desde aquí, puedes navegar a usuarios/create y usuarios/{id}/edit.

6. Estructura de Roles y Acceso
El proyecto implementa un sistema de roles básico:

usuario: Rol por defecto para usuarios registrados. Pueden acceder al dashboard y rutas de perfil.

administrador: Rol especial con acceso a áreas restringidas, como la gestión de usuarios.

El AdminMiddleware (ubicado en app/Http/Middleware/AdminMiddleware.php) se encarga de proteger las rutas que requieren el rol de administrador.

7. Pruebas Automatizadas
Se han añadido pruebas de características para el control de acceso.
Para ejecutar las pruebas:

php artisan test

Para ejecutar solo las pruebas de gestión de usuarios:

php artisan test --filter UserManagementTest

8. Optimización de Rendimiento
Para optimizar el rendimiento en producción, se utilizan los siguientes comandos de Artisan:

php artisan config:cache
php artisan route:cache
php artisan view:cache
composer dump-autoload --optimize

9. Consideraciones para el Despliegue
Para desplegar la aplicación en un servidor de producción real:

Entorno: Configurar un servidor web (Nginx/Apache), PHP y la base de datos.

Clonar: Clonar el repositorio desde GitHub.

Dependencias: composer install --no-dev --optimize-autoloader.

.env: Configurar el archivo .env para producción (APP_ENV=production, credenciales DB reales, MAIL_MAILER real si se usa).

key:generate: php artisan key:generate.

Caché: Ejecutar php artisan config:cache, php artisan route:cache, php artisan view:cache.

Migraciones: php artisan migrate --force.

Assets: npm install y npm run build en el servidor.

Permisos: Configurar permisos de escritura para las carpetas storage y bootstrap/cache.

Servidor Web: Apuntar el DocumentRoot del servidor web a la carpeta public de tu proyecto.

10. Contacto
Para preguntas o colaboraciones, contactar a [Héctor/80hector@gmail.com/https://github.com/SrTic/compi_project.git].