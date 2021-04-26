# APIAuthenticated
![image](https://user-images.githubusercontent.com/71784239/116158947-00f0bb00-a6b5-11eb-8ca6-af6325169cfd.png)

### Desarrollo de API Crud-PHP, Bdd-MSQL, Framework-LARAVEL-BOOTSTRAP, Pruebas-POSTMAN-MAILTRAP
#### Importante tener en cuenta que no esta completo, falta la implemenrtación del passport para permisos de usuario access Token
### [Docuementación técnica](Doc_Tecnica_API.pdf)

## Pre-requisitos
PHP 7: Necesitamos la última versión del lenguaje PHP.\
Composer: El gestor de dependencias de PHP.\
MYSQL.\
Editor de codigo fuente puede ser Visual Studio Code.


## Despliegue

### 1.Clonar el repositorio en git https://github.com/JohanFarfan25/APIAuthentication.git

### 2.Instalar dependencias
Instalar con Composer, el manejador de dependencias para PHP, las dependencias definidos en el archivo composer.json. 
Para ello abriremos una terminal en la carpeta del proyecto y ejecutaremos: composer install.
También debemos instalar las dependencias de NPM definidas en el archivo package.json con: npm install.
    
### 3.Crear la base de datos
Si es posible con el mismo nombre del proyecto

### 4.Crear el archivo .env
Este archivo es necesario para, entre otras cosas, configurar la conexión de la bbdd, el entorno del proyecto, motores para envio y recepción de correos etc …
Como por cuestiones de seguridad tampoco se subió, necesitamos crearlo.
Podemos duplicar el archivo .env.example, renombrarlo a .env e incluir los datos de conexión de la base de datos que indicamos en el paso anterior.

¡Es importante actualizar las credenciales para la conexión a la base de datos y a mailtrap!

### 5.Generar una clave
La clave de aplicación es una cadena aleatoria almacenada en la clave APP_KEY dentro del archivo .env. Notarás que también falta.
Para crear la nueva clave e insertarla automáticamente en el .env, ejecutaremos: php artisan key:generate

### 6.Ejecutar migraciones
Por último, ejecutamos las migraciones para que se generen las tablas con: php artisan migrate
### Iniciar el servidor
Ejecutar el comando php artisan serve
Al ejecutar ese comando nos aparecerá un mensaje con la ruta del servidor recién instanciado  http://127.0.0.1:8000
Con esta ingresaremos al navegador y veras la aplicación desplegada
![image](https://user-images.githubusercontent.com/71784239/116158947-00f0bb00-a6b5-11eb-8ca6-af6325169cfd.png)

## Mailtrap
Crear una cuenta en gmail y autenticarla en mailtrap.\
Actualizar las credenciales de acceso en el archivo .dev
![image](https://user-images.githubusercontent.com/71784239/116161073-bf620f00-a6b8-11eb-92af-f10121b89644.png)
![image](https://user-images.githubusercontent.com/71784239/116161179-f0424400-a6b8-11eb-8a3b-eb21416f6b03.png)

# Pruebas

## Postman
Ingresar en este enlace para el paso paso para las pruebas con POSTMAN : [Pruebas_Postman](Pruebas_Postman.pdf).\
Tener en cuenta que se debe utilizar en los metodos POST,EDIT Y DELETE la opción Authorization, e ingresar 
las credenciales de acceso de un usuario ya registrado.
![image](https://user-images.githubusercontent.com/71784239/116159826-8de84400-a6b6-11eb-9723-f7eb21280b9a.png)
