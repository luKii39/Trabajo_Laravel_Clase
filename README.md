# CRM Empresa - Segunda Entrega

## Descripción
CRM desarrollado con Laravel y AdminLTE para gestión de 
clientes, productos, proveedores, ventas y compras.

## Tecnologías utilizadas
- Laravel 11
- AdminLTE 3
- DataTables 1.10
- MySQL

## Funcionalidades de la Segunda Entrega

### DataTables
Todos los módulos (Clientes, Productos, Proveedores, Ventas 
y Compras) usan DataTables con buscador y paginación.

### Subida de archivos
- Imagen del producto (jpg, png...)
- PDF del producto
- Almacenados en storage/app/public

### Roles y permisos
- **Admin**: puede crear, editar y eliminar
- **Usuario**: solo puede crear y editar
- El botón Eliminar solo aparece si el usuario es admin

## Instalación
1. Clonar el repositorio
2. `composer install`
3. Copiar `.env.example` a `.env` y configurar base de datos
4. `php artisan key:generate`
5. `php artisan migrate`
6. `php artisan storage:link`
7. `php artisan serve`

## Usuarios de prueba
- **Admin**: hugoeldecadiz@gmail.com / 2822003Hugo
- **Usuario**: usuario@crm.com / password