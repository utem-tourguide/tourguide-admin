## Web API de TourGuide

Esta aplicación es el administrador de contenido (CMS) de TourGuide. Su
propósito es actuar como el punto central donde se almacena, manipula y se
accede a la información de TourGuide desde una interfaz web, así como
proporcionar una API para que cualquier aplicación autorizada manipule dicha
información desde cualquier dispositivo o plataforma.

TourGuide es un sistema para brindar información a los visitantes sobre los
distintos lugares que componen una zona turística, como una ciudad, un recinto
arqueológico o un museo.

## Requerimientos

Esta aplicación requiere PHP 5.4 o superior. También requiere los módulos
`mcrypt` y `readline` de PHP. También es necesario el módulo `pdo_sqlite`, pero
si va a usar la configuración de base de datos predeterminada.

Además, se necesita [Composer](https://getcomposer.org/) para instalar
dependencias.

## Como usar la aplicación

1. Clona el repositorio en tu equipo.
2. Entra al directorio donde clonaste y ejecuta `composer install`.
3. Rellena el archivo `.env.example` con la información de tu entorno y
   renómbralo a `.env`.
4. Crea un archivo vacío llamado `db.sqlite` en la raíz del repositorio.
5. Ejecuta `php artisan migrate` para instalar la base de datos.
6. Ejecuta `php artisan serve` y déjalo correr.
7. Visita `http://localhost:8000` en tu navegador y voilâ! ;)

## Autores

El equipo de TourGuide:

[Kevin Perez](https://github.com/kevindperezm)
[Daniel Dolores](https://github.com/Dannypein)

## Relacionados

Proximamente...

## Acerca de TourGuide

TourGuide es desarrollado como un proyecto universitario en la
[Universidad Tecnológica de Manzanillo](http://utem.edu.mx) para la carrera de
Ingeniería en Tecnologías de Información.
