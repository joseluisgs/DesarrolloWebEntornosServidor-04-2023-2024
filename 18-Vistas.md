# Vistas y Blade
- [Vistas y Blade](#vistas-y-blade)
  - [Vistas](#vistas)
  - [Blade](#blade)
    - [Directivas](#directivas)
    - [Otros elementos](#otros-elementos)
    - [Formularios](#formularios)
  - [Utilidades](#utilidades)
    - [Laravel UI](#laravel-ui)
    - [Paginaciones](#paginaciones)
    - [Flash](#flash)
 
![logo](./images/01-laravel.png)

## Vistas
Laravel te permite crear las [vistas](https://laravel.com/docs/10.x/views) como quieras, de hecho ya tiene distintos [starter kits](https://laravel.com/docs/10.x/starter-kits) para ello, siendo el por defecto Breeze con Blade. 

## Blade
Las vistas de [Blade](https://laravel.com/docs/10.x/blade) están típicamente ubicadas en el directorio `resources/views` del proyecto de Laravel. Blade es el motor de plantillas de Laravel que proporciona una sintaxis más limpia y heredable para escribir las vistas. Blade permite a los desarrolladores heredar y extender vistas utilizando directivas como `@extends` y `@section`, lo que promueve la reutilización del código y la separación de la lógica de presentación.

Con Blade, se pueden incrustar datos PHP directamente en la vista con una sintaxis más simple que la de PHP puro. Por ejemplo, para mostrar una variable pasada a la vista, se puede usar `{{ $variable }}` en lugar de `<?php echo $variable; ?>`. Blade también escapa automáticamente los datos para la protección contra ataques XSS, lo cual es una buena práctica de seguridad.

### Directivas

Blade también proporciona un conjunto de directivas de control de flujo como `@if`, `@foreach`, y `@while`, que hacen que sea más fácil de manejar estructuras de control directamente dentro de las plantillas de las vistas.

1. `@include`:
La directiva `@include` se utiliza para incluir una vista dentro de otra. Esto es útil para reutilizar elementos de la interfaz de usuario, como cabeceras, pies de página, o cualquier otro fragmento de HTML que quieras reutilizar en diferentes partes de tu aplicación.

```blade
// Ejemplo de uso de @include
@include('nombre_de_la_vista')
```

2. `@yield`:
La directiva `@yield` se utiliza para mostrar el contenido de una sección. Las secciones son bloques de contenido que se definen en las vistas para ser mostrados en una plantilla base (layout). `@yield` se usa en la plantilla base para reservar un espacio donde el contenido de la sección será inyectado.

```blade
// En la plantilla base (layout.blade.php)
<html>
<head>
    <title>App Name - @yield('title')</title>
</head>
<body>
    @yield('content')
</body>
</html>
```

3. `@extends`:
La directiva `@extends` se utiliza para indicar que una vista hereda de una plantilla base. Esto permite definir un layout general que puede ser compartido por varias vistas, manteniendo la consistencia y reduciendo la duplicación de código.

```blade
// En una vista que extiende de una plantilla base
@extends('layout')

@section('title', 'Page Title')

@section('content')
    <p>This is my body content.</p>
@endsection
```

4. `@section`:
La directiva `@section` se utiliza para definir una sección de contenido que será inyectada en la plantilla base. Se define en la vista que extiende de una plantilla base y puede ser mostrada en la plantilla usando `@yield`.

```blade
// En la vista que extiende de una plantilla base
@section('title', 'Page Title')

@section('content')
    <p>This is my body content.</p>
@endsection
```

Cada `@section` se define con un nombre único, y puedes tener múltiples secciones en una vista. La plantilla base luego utiliza `@yield('nombre_de_la_sección')` para mostrar el contenido de esa sección específica.

Aquí algunos ejemplos de cómo se utilizan las directivas `@if`, `@foreach`, `@while` y otras directivas de Blade:

5. La directiva `@if` se utiliza para ejecutar un bloque de código si una determinada condición es verdadera.

```blade
@if (count($records) === 1)
    Tengo un registro!
@elseif (count($records) > 1)
    Tengo múltiples registros!
@else
    No tengo ningún registro!
@endif
```

6. La directiva `@foreach` se utiliza para iterar sobre arrays de datos.

```blade
@foreach ($users as $user)
    <p>Este es el usuario {{ $user->id }}</p>
@endforeach
```
7. La directiva `@while` se utiliza para ejecutar un bloque de código repetidamente mientras una determinada condición sea verdadera.

```blade
@while (true)
    <p>Estoy atrapado en un ciclo infinito!</p>
@endwhile
```
8. `@for`, ejecuta un bucle `for`.

```blade
@for ($i = 0; $i < 10; $i++)
    El valor actual es {{ $i }}
@endfor
```

9. `@switch` permite realizar una estructura de control tipo switch-case.

```blade
@switch($name)
    @case('John')
        Hola, John!
        @break

    @case('Mary')
        Hola, Mary!
        @break

    @default
        Hola, desconocido!
@endswitch
```

10. `@isset`, comprueba si una variable está definida y no es `null`.

```blade
@isset($record)
    // $record está definido y no es null...
@endisset
```

11. `@empty`, comprueba si una variable está vacía.

```blade
@empty($records)
    // La variable $records está "vacía"...
@endempty
```
### Otros elementos
Dentro de las plantillas Blade, puedes encontrar varias directivas y funciones para facilitar la generación de URLs y la carga de activos (assets), como hojas de estilo (CSS) y archivos JavaScript (JS). Aquí te explico las dos funciones que mencionas:

1. `url()`: Esta es una función de ayuda (helper function) en Laravel que genera una URL completa para un path dado en tu aplicación. No es específica de Blade y puede ser usada tanto en plantillas Blade como en código PHP puro.

Por ejemplo, si deseas generar una URL a la raíz de tu sitio, puedes hacer algo como esto en una plantilla Blade:

```blade
<a href="{{ url('/') }}">Inicio</a>
```

2. `asset()`: Similar a `url()`, `asset()` es otra función de ayuda en Laravel que genera una URL para un archivo de activos, considerando la configuración de URL base de tus activos. Esto es útil para referenciar archivos CSS, JS o imágenes que están almacenados en la carpeta pública de tu aplicación Laravel.

Por ejemplo, para incluir una hoja de estilo CSS en tu plantilla Blade, podrías escribir:

```blade
<link href="{{ asset('css/estilo.css') }}" rel="stylesheet" type="text/css" />
```

Las llaves dobles `{{ }}` son la sintaxis de Blade para imprimir datos en la plantilla, y automáticamente escapan el contenido para prevenir ataques XSS (Cross-Site Scripting). Cuando usas `{{ }}` con `url()` o `asset()`, estás imprimiendo la URL generada de forma segura en el HTML.

### Formularios
El manejo de formularios con Blade en Laravel es bastante directo. Puedes crear un formulario en una vista Blade de la siguiente manera:

```blade
<form action="/ruta-del-formulario" method="POST">
    @csrf
    <!-- Campos del formulario -->
    <input type="text" name="nombre" id="nombre">
    <button type="submit">Enviar</button>
</form>
```

En este ejemplo, la directiva `@csrf` es crucial. `@csrf` es una abreviatura de "Cross-Site Request Forgery" (falsificación de solicitud entre sitios), y es un tipo de ataque web malicioso que lleva a realizar acciones no autorizadas en nombre de un usuario autenticado. Laravel proporciona una manera fácil de proteger tu aplicación de estos ataques mediante el uso de tokens CSRF.

Cuando usas la directiva `@csrf` en un formulario Blade, Laravel genera automáticamente un campo de formulario oculto (`<input type="hidden" name="_token">`) con un token de sesión que valida la solicitud del formulario cuando se envía. Si la solicitud no contiene el token o si el token no coincide con el que está en la sesión del usuario, Laravel rechazará la solicitud.

En cuanto a la directiva `@method`, se utiliza para "falsificar" métodos de solicitud HTTP en formularios. HTML por sí mismo solo soporta los métodos `GET` y `POST` en los formularios. Sin embargo, para fines de diseño RESTful, a menudo necesitamos realizar solicitudes `PUT`, `PATCH` o `DELETE`. Laravel permite esto mediante el uso de la directiva `@method`:

```blade
<form action="/ruta-del-formulario" method="POST">
    @csrf
    @method('PUT')
    <!-- Campos del formulario -->
    <input type="text" name="nombre" id="nombre">
    <button type="submit">Enviar</button>
</form>
```

Al usar `@method('PUT')`, Laravel entiende que aunque el formulario se envía con el método POST, la intención es realizar una solicitud PUT. Laravel manejará esto internamente, y el controlador que procesa la solicitud puede tratarla como una solicitud PUT.

Es importante destacar que el uso de `@method` es una convención que ayuda a Laravel a entender la verdadera intención de la solicitud, y no cambia el método HTTP real que el navegador utiliza para enviar el formulario; sigue siendo un POST desde la perspectiva del navegador y del servidor web. Laravel detecta la presencia del campo `_method` generado por `@method` y lo utiliza para simular una solicitud PUT, PATCH o DELETE en el lado del servidor.

## Utilidades
Como ya hemos dicho, Laravel usa Breeze pero se puede personalizar bastante.

### Laravel UI
por ejemplo en vez de usar Bootstrapt en vez de Tailwind. Para ello podemos hacer uso de [Laravel UI](https://github.com/laravel/ui) que nos permite instalar y configurar los scaffolding de Bootstrap, Vue, React, Tailwind, etc.

### Paginaciones
Podemos realizar paginaciones automáticas gracias a, `links` y `paginate`.

### Flash
podemos usar la librería de [laracast/flash](https://github.com/laracasts/flash) para mostrar mensajes flash en la aplicación.