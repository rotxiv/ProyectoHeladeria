# Proyecto Laravel - [proy-heladeria-app]

Este es un proyecto desarrollado con Laravel que utiliza **XAMPP** como entorno de desarrollo local y **MySQL** como sistema de base de datos.

## Requisitos

Antes de comenzar, asegúrate de tener instalados:

- [XAMPP](https://www.apachefriends.org/es/index.html) (incluye Apache y MySQL)
- [Composer](https://getcomposer.org/)
- [Git](https://git-scm.com/)
- PHP 8.1 o superior

## Instalación

Sigue estos pasos para clonar y configurar el proyecto en tu máquina local:
En la carpeta donde se guardara el proyecto, abrir la terminal CMD:

### 1. Clonar el repositorio y ejecutar los siguientes comandos:

```bash
git clone https://github.com/rotxiv/ProyectoHeladeria.git   --- Clona el repositorio

cd proy-heladeria-app   --- Mover a la carpeta del proyecto

composer install    --- Instala dependencias de PHP

cp .env.example .env    --- Copia el archivo de entorno. Configurarlo deacuerdo a sus preferencias

php artisan key:generate    --- Generar la clave de la aplicación

--- Abre phpMyAdmin desde el panel de XAMPP y crea una nueva base de datos con el mismo nombre especificado en el archivo .env.

php artisan migrate --- Ejecuta las migraciones.

php artisan db:seed --- Ejecuta los seeder. Usa los siguientes comandos en ese orden.

--- php artisan db:seed --class=PersonaSeeder
--- php artisan db:seed --class=EmpleadoSeeder
--- php artisan db:seed --class=RolSeeder
--- php artisan db:seed --class=UserSeeder

php artisan serve   --- Ejecutar el servidor.







