## Sobre esta prueba

Instale el siguiente proyecto siguiendo las instrucciones paso a paso que se enumeran a continuación:

- Descomprima el archivo recibido o descarguelo desde el repositorio en GIT.
- Ejecute el comando `composer install`
- Ejecute el comando `npm run dev`
- Haga una copia del archivo .env.example con el nombre .env y complete la siguiente información:
  - `APP_URL` debe ser `http://127.0.0.1:8000` o un virtual host configurado en su servidor que apunte al public de el projecto
  - `DB_DATABASE`, `DB_USERNAME` y `DB_PASSWORD` son las credenciales para acceder a una base de datos
- En la linea de comando ejecute el comando `php artisan key:generate`
- En la linea de comando ejecute el comando `php artisan migrate:fresh --seed`, esto creará las tablas de la base de datos y agregará la información inicial necesaria

## Uso del proyecto

Cuando complete los pasos anteriores, el proyecto estará listo para funcionar. Abra un navegador y escriba la dirección del virtual host que tiene apuntando al proyecto o en su defecto si utilizó el comando serve de artisan, abra la URL que se le indicó en la linea de comando.

En la página inicial encontrará información de lo que contiene el programa.

Si lo desea, seleccione de la barra de navegación Productos para ver el listado de productos del programa, solo hay uno y se llama Producto 1, puede hacer click en el botón Detalle para dirigirse a una página de detalle del producto. En esta encontrará un botón **Comprar**, este botón abrirá el formulario de registro de datos del cliente.
Siga el proceso de compra y llegará a la página de información del estado del producto. Si la compra no aparece exitosa, puede refrescar la página y el programa intentará actualizar la información.

Finalmente, en la parte superior existe un enlace a **Todas las órdenes** que lo llevará a un resumen de las órdenes que ha registrado el sistema, mostrando la información del cliente y los detalles de la transacción.

Cualquier duda adicional, me pueden contactar:

- *Email: andres@bedoya.co*
- *Tel: +57-300-6700340*

Quedo atento
