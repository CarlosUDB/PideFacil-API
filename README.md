# RESTAURANTE-APP

_API para la aplicación PideFácil hecho con Laravel, autenticado con sanctum_

## Autores ✒️
_DPS104 G04T_
* **Carlos Daniel Cárcamo Pérez**

## Instalación ✒️
Instalar Composer (descargar instalador de internet)</br>
composer --version </br>
composer global require laravel/installer</br>


En proyecto:</br>
composer i </br>
php artisan --version</br>
Copiar archivo .env.example, quitar el .example, en la variable DB_DATABASE colocar pidefacil</br>
(Crear base de datos con phpmyadmin en caso de usar xampp, nombre sugerido : pidefacil)</br>
php artisan migrate:refresh --seed</br>


Para correr la api:</br>
    php artisan serve --host {poner ipv4 acá} --port="8000"</br>


## Licencia 📄
<a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="Licencia Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png" /></a><br />Esta obra está bajo una <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">Licencia Creative Commons Atribución 4.0 Internacional</a>   
