Proyecto de Gestión con Laravel
Este proyecto es una aplicación web desarrollada con el framework Laravel. Su objetivo es gestionar diferentes elementos de una empresa, como clientes, productos y facturas. Cada módulo permite realizar operaciones básicas como crear, editar, listar y eliminar registros.
La mayoría de los apartados funcionan correctamente, aunque el módulo de proveedores no he conseguido completarlo del todo debido a problemas con la base de datos.

Requisitos para ejecutarlo
PHP 8.1 o superior

Composer

Laravel 10

Servidor local (Laravel Sail, XAMPP, WAMP, etc.)

SQLite o MySQL (según configuración del .env)

Navegador web actualizado

Pasos básicos de instalación
Clonar el repositorio:

bash
git clone https://github.com/luKii39/Trabajo_Laravel_Clase.git
Entrar en la carpeta del proyecto:

bash
cd Trabajo_Laravel_Clase
Instalar dependencias:

bash
composer install
Crear el archivo .env:

bash
cp .env.example .env
Generar la clave de la aplicación:

bash
php artisan key:generate
Configurar la base de datos en el archivo .env.

Ejecutar las migraciones:

bash
php artisan migrate
Iniciar el servidor:

bash
php artisan serve
Acceder desde el navegador:

Código
http://localhost:8000

La contraseña y el usuario crealos de nuevo
