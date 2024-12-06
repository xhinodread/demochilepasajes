
# Test Técnico: API de la NASA con Laravel y Clean Architecture

Este repositorio contiene una API REST desarrollada con Laravel (v11.34.2) y PHP (v8.2.25) que consume la API pública de la NASA para obtener datos.  La arquitectura del proyecto sigue el patrón Clean Architecture.

## Requisitos

* **Laravel:** v11.34.2 o superior.  Puedes instalarlo siguiendo las instrucciones oficiales de Laravel: [https://laravel.com/docs/11.x/installation](https://laravel.com/docs/11.x/installation)
* **PHP:** v8.2.25 o superior.
* **Composer:** Necesario para gestionar las dependencias de PHP.

## Instalación

1. **Clona el repositorio:** Clona este repositorio en tu máquina local usando Git:

 URL_DEL_REPOSITORIO = https://github.com/xhinodread/demochilepasajes.git

   ```
   git clone <URL_DEL_REPOSITORIO>

Instalar las dependencias: Navega al directorio del proyecto y ejecuta Composer:

cd <DIRECTORIO_DEL_PROYECTO>
composer install


Configura la API Key: Crea un archivo .env en la raíz del proyecto (si no existe) y agrega tu API Key de la NASA:

NASA_API_KEY=XXXXXXXXXXXxxxxxxxxxXXXX  // Reemplaza con tu API Key

Configura las rutas: Abre el archivo routes/web.php y agrega la siguiente ruta:

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NasaDataController;

Route::get('/nasaapitest', [NasaDataController::class, 'index']);

Ejecución (Varia gegún sea el servidor donde se instale)
Genera la clave de aplicación: Ejecuta el siguiente comando en tu terminal:

php artisan key:generate

Ejecuta el servidor de desarrollo: Inicia el servidor de desarrollo de Laravel:

php artisan serve


Accede a la API: Puedes acceder a la API usando un cliente HTTP como Postman o directamente desde tu navegador web. Usa la siguiente URL, reemplazando las fechas según sea necesario:

http://127.0.0.1:8000/nasaapitest?startDate=2016-03-01&endDate=2016-04-01

demo
( https://chileregion.xyz/laravel/public/nasaapitest?startDate=2016-03-01&endDate=2016-04-01 )

Esta URL devolverá datos de la API de la NASA en formato JSON para el periodo especificado.

Estructura del Proyecto
El proyecto utiliza la arquitectura Clean Architecture. La estructura de carpetas es la siguiente:

laravel/
├── app/
│   ├── Domain/
│   │   ├── Entities/
│   │   ├── Repositories/
│   │   └── UseCases/
│   │       └── GetNasaData.php
│   ├── Http/
│   │   └── Controllers/
│   │       └── NasaDataController.php
│   ├── Services/
│   │   └── NasaApiService.php
│   └── ...
└── routes/
    └── web.php

Parámetros
Puedes usar los parámetros startDate y endDate (formato YYYY-MM-DD) en la URL para especificar el rango de fechas de los datos que deseas obtener.

Consideraciones
Asegúrate de tener instaladas las dependencias de Composer.

Revisa la configuración de tu archivo .env.

La API Key de la NASA es necesaria para el correcto funcionamiento de la aplicación.

Este README proporciona una guía completa para descargar, instalar y ejecutar el proyecto. Si encuentras algún problema, por favor, abre un issue en este repositorio.

Recuerda reemplazar `<URL_DEL_REPOSITORIO>` y `<DIRECTORIO_DEL_PROYECTO>` con las URLs y rutas correctas.  Este README es más claro, conciso y fácil de seguir.  Incluye enlaces a la documentación de Laravel y una mejor descripción de la estructura del proyecto.








[....]
borrador doc

Laravel v11.34.2 
PHP v8.2.25

Para la implementacion es tener instalada la versiones antes mencionadas.

Una vez que el framework de Laravel esté instalado y en ejecucion, tan solo es
necesario copiar el directorio /Domain dentro de el directorio /app del framework.

Además necesita copiar el archivo NasaDataController.php dentro del directorio
/app/Http/Controllers

También copie el archivo NasaApiService.php dentro de el directorio /app/Services

Ingrese y modifique el archivo web.php para agregar la ruta con la cual puede acceder al programa, esta ruta se traduce en una direccion html (endpoint) para el consumo de sus recursos

Los datos que debe ingresar en el archivo web.php son

    Route::get('/nasaapitest', [NasaDataController::class, 'index']);

El archivo final puede quedar como el siguiente ejemplo:
    
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\NasaDataController;


    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/nasaapitest', [NasaDataController::class, 'index']);
   

Puede usar Postman o un navegador web para visualizar la inforacion requerida, 
una direccion de ejemplo para ver esto puede ser: 
    https://chileregion.xyz/laravel/public/nasaapitest?startDate=2016-03-01&endDate=2016-04-01

Por ultimo necesita crear un archivo .env en la raiz del framework, este archivo 
contiene la NASA_API_KEY="XXXXXXXXXXXxxxxxxxxxXXXX", necesaria para que el programa pueda acceder al api de nasa.


la estructura de archivos del demo es:

- laravel
    |
    -- app
    |   |----- Domain
    |   |       |----- Entities
    |   |       |----- Repositories
    |   |       |----- UseCases
    |   |                   |----- ProcesaData
    |   |----- Http
    |   |        |-------- Controllers
    |   |----- Models
    |   |----- Providers
    |   |----- Services
    |-- routes
    |-- .env


Al hacer get a la url

    https://chileregion.xyz/laravel/public/nasaapitest?startDate=2016-03-01&endDate=2016-04-01

el demo debe entregar informacion de vuelta.

Puede usar las fechas en los paramentros de startDate y endDate para cambiar el periodo de tiempo
del informe.

Considerando esta informacion el demo no deberia tener problemas para hacer funcionar el demo.


.....