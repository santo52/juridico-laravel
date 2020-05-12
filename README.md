
# 1. Requisitos del servidor
Para que el proyecto se pueda instalar correctamente, los requisitos mínimos del servidor son:

1. PHP 7.2 o superior
4. mySQL
5.  [Composer](https://getcomposer.org/)
6. nodejs 10 o superior
7. npm 6 o superior

# 2. Descargar repositorio

Ir al repositorio que se encuentra en https://github.com/santo52/juridico-laravel y descargarlo o clonarlo

![](https://raw.githubusercontent.com/santo52/juridico-laravel/master/public/images/clone_repository.jpg)
 
# 3. Instalación

## 3.1 Dependencias

El proyecto utiliza dependencias de [packagist](https://packagist.org/), y estas dependencias son instaladas con el siguiente comando

    composer install

El proyecto utiliza dependencias de npm como [grunt](https://gruntjs.com/) para compilar los archivos SASS y dependencias de [bower](https://bower.io/) como bootstrap, para hacer estos procesos se debe ejecutar el siguiente comando:

    npm install && npm run postinstall

En la raíz del proyecto hay un archivo llamado *.env.example*, este debe ser copiado y renombrado como *.env*

Este archivo contiene todas las variables globales del proyecto, y serán explicadas a continuación.

## 3.2 Preconfiguración

1. Ubicar el archivo *.env.example* a *.env*

2. Ejecutar el siguiente comando
```
php artisan key:generate
```
3. Crear un virtualhost que apunte a la carpeta *public* del proyecto

4. Dar todos los permisos a las carpetas *storage* *bootstrap/cache*


## 3.3 Base de datos

Teniendo las credenciales de la base de datos , ir al archivo *.env* y cambiar las siguientes variables:

> DB_HOST: Es el host de la base de datos, generalmente es *localhost*
>
> DB_PORT: Es el puerto de la base de datos, generalmente es *3306*
>
> DB_DATABASE: Es el nombre de la base de datos
>
> DB_USERNAME: Es el nombre de usuario con permisos para acceder a la base de datos
>
> DB_PASSWORD: Es la contraseña del usuario con permisos para acceder a la base de datos

Una vez hecho esto, ubicarse en la raiz del proyecto y ejecutar todas las *queries* del archivo *nuevadata.sql*
