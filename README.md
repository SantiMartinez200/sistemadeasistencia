Pasos para correr la aplicación desde cero.

---PASO 1---
Instalar Laragon completo, la versión de PHP debe ser 8.1.10.
Laragon dispone de un host local y de un un gestor de bases de datos, llamado HeidiSQL.
Además, instalar Composer en el usuario que va a correrse la aplicación, composer debe ser instalado en la carpeta de bin->Php de Laragon.
---PASO 2---
Instalar NODEjs, seguir la instalación oficial, se requiere NODE debido a que un paquete de la aplicación; Laravel Breeze, utiliza VITE.
---PASO 3---
Bajar el archivo .zip y descomprimirlo o clonar el repositorio desde Github, según se prefiera.
Cambiar el nombre de la carpeta a "LaravelProject"
---PASO 4---
Abrir Laragon, Menu -> Preferencias -> Marcar la casilla de crear hosts virtuales personalizados
---PASO 5---
Abrir en visual studio la carpeta de la aplicación, dirigirse al archivo ENV.example, copiarlo, pegarlo, y renombrar la copia como ".env", dentro; cambiar la variable de entorno "APP_URL", colocar la siguiente linea:
	APP_URL=http://sistemadeasistencia.test/
---PASO 6---
Abrir la carpeta de la aplicación con la terminal de Laragon, correr los siguientes comandos:
	-composer Install
	-php artisan key:generate
	-npm install
	-npm run dev
	-php artisan migrate --seed (Esto creará registros básicos para la previsualización de la 		aplicación, sumado a que correrá las migraciones de tablas y base de datos.)

La terminal arrojará este mensaje "The database 'DB_DATABASE' does not exist on the 'mysql' connection."
Por lo que, nuevamente, en el archivo .env, en la variable de entorno DB_DATABASE colocarás el nombre que quieras para tu base de datos.
Ejemplo:	DB_DATABASE=sistemadeasistencia

La base de datos no posee un usuario y/o contraseña específicos para su acceso.

La semilla "--seed" arrojará 10 alumnos para realizar pruebas, la aplicación inicia en la pantalla de registro de usuario pero podrás iniciar sesión en "Already registered?" con las siguientes credenciales:
	-Usuario: admin@admin.com
	-Contraseña: root
	

