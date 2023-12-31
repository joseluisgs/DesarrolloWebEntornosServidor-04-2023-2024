# Entorno de Desarrollo

- [Entorno de Desarrollo](#entorno-de-desarrollo)
  - [Con Composer](#con-composer)
  - [Usando Sail](#usando-sail)
    - [Creando el proyecto con Sail](#creando-el-proyecto-con-sail)
    - [Levantando o parando servicios](#levantando-o-parando-servicios)
    - [Ejecutar en el CLI de Sail](#ejecutar-en-el-cli-de-sail)
  - [Artisan](#artisan)


![logo](./images/01-laravel.png)

## Con Composer

Para instalar Laravel, necesitamos tener instalado PHP y Composer. Para ello, podemos usar el instalador de Laravel, que nos instalará todo lo necesario para trabajar con Laravel.

```bash
composer create-project laravel/laravel example-app

cd example-app
 
php artisan serve
```

## Usando Sail
Sail es un entorno de desarrollo local para Laravel que simplifica la configuración y administración de un entorno de desarrollo completo para proyectos Laravel. Fue creado por el equipo de Laravel y se incluye como parte del framework a partir de la versión 8.

Sail utiliza Docker para crear y administrar contenedores ligeros que contienen todos los componentes necesarios para ejecutar una aplicación Laravel, como el servidor web, el servidor de bases de datos y otras dependencias. Proporciona una configuración predefinida y optimizada para el desarrollo local, lo que facilita la puesta en marcha de un entorno de desarrollo consistente y compatible en diferentes sistemas operativos.

Algunas características y beneficios de Sail son:

1. Configuración sencilla: Sail simplifica la configuración del entorno de desarrollo local. Solo necesitas instalar Docker y Laravel para comenzar a usar Sail.

2. Contenedores preconfigurados: Sail crea y administra contenedores Docker preconfigurados que contienen todo lo necesario para ejecutar una aplicación Laravel, incluyendo el servidor web Nginx, el servidor de bases de datos MySQL o PostgreSQL, y otras dependencias según tus necesidades.

3. Compatibilidad multiplataforma: Sail es compatible con diferentes sistemas operativos, incluyendo Windows, macOS y Linux. Esto permite que los equipos de desarrollo trabajen de manera consistente en diferentes entornos.

4. Facilidad de uso: Sail proporciona una interfaz de línea de comandos (CLI) intuitiva para administrar los contenedores y realizar tareas comunes, como iniciar y detener el entorno, ejecutar comandos de Artisan, ejecutar pruebas y más.

5. Flexibilidad: Aunque Sail proporciona una configuración predeterminada, es altamente personalizable. Puedes modificar la configuración de los contenedores según tus necesidades o agregar nuevos servicios si es necesario.

### Creando el proyecto con Sail
Para crear un proyecto con Sail, solo debes usar:
  
```bash
curl -s "https://laravel.build/example-app" | bash
```

Esto crea un proyecto con todos los servicios, pero podemos instalar solo los que necesitemos. Por ejemplo, para crear un proyecto con solo Postgres, podemos usar:

```bash
curl -s "https://laravel.build/example-app?with=pgsql" | bash
```

### Levantando o parando servicios
Podemos hacerlo con
```bash
cd example-app
 
./vendor/bin/sail up
./vendor/bin/sail down
./vendor/bin/sail up -d # Para levantar en segundo plano
```

### Ejecutar en el CLI de Sail
Desde este momento si queremos ejecutar cualquier comando de Artisan, node, o similar, podemos hacerlo con:
```bash
./vendor/bin/sail artisan migrate
```

## Artisan
Artisan es la interfaz de línea de comandos (CLI) incluida con Laravel. Proporciona una serie de comandos útiles que pueden ayudarte a desarrollar y mantener tu aplicación Laravel. Puedes usar Artisan para realizar tareas comunes, como crear controladores, modelos y migraciones, ejecutar pruebas, limpiar la caché, optimizar la configuración de la aplicación y más.

OJO, recuerda que quizás lo ejecutes con Sail, por lo que siempre debe empezar con `./vendor/bin/sail artisan`

Para ver todos los comandos disponibles, puedes usar:
```bash
artisan list
```

Para ver la ayuda de un comando, puedes usar:
```bash
artisan help <command>
```
