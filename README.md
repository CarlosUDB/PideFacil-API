# RESTAURANTE-APP

_API para la aplicación PideFácil hecho con Laravel, autenticado con sanctum_

## Autores ✒️
_DPS104 G04T_
* **Carlos Daniel Cárcamo Pérez**

## Instalación 💻
* Instalar XAMPP (se utiliza principalmente para MySql pero puede usarse para usar PhpMyAdmin también)
* Instalar Composer (descargar instalador de internet)
* Correr en terminal 
    ```
    composer --version
    composer global require laravel/installer
    ```
* Crear base de datos con phpmyadmin en caso de usar xampp, nombre sugerido : pidefacil
* Estando dentro del proyecto:

    *   Copiar archivo .env.example, quitar el .example del nombre, dentro de él en la variable DB_DATABASE colocar pidefacil</br>
    * Correr en una terminal dentro del proyecto
        ```
        composer i
        php artisan --version
        php artisan migrate:refresh --seed
        ```

* Para correr la api (dentro del proyecto en una terminal):
    ```
    php artisan serve --host {poner ipv4 acá} --port="8000"
    ```
* [Documento con end-points a utilizar por pantallas](https://drive.google.com/file/d/1Qd1OB0-nQGkv0Vhc_ZgQ4Wg_9QK6mw8p/view?usp=sharing)

## Documentación de API 📄
Realizada con Postman acceder [ACÁ](https://documenter.getpostman.com/view/12456308/2s9YCBupn8)
## Licencia 📄
<a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="Licencia Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png" /></a><br />Esta obra está bajo una <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">Licencia Creative Commons Atribución 4.0 Internacional</a>   
