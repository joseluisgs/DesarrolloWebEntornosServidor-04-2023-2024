# Sesiones y Cookies
- [Sesiones y Cookies](#sesiones-y-cookies)
  - [Sesiones](#sesiones)
  - [Cookies](#cookies)

![logo](./images/01-laravel.png)

## Sesiones

Las sesiones en Laravel se utilizan para almacenar información sobre el usuario a través de múltiples solicitudes. Laravel soporta varias maneras de manejar sesiones, como archivos, cookies, base de datos, memcached, Redis, y más. La configuración de las sesiones se encuentra en el archivo de configuración `config/session.php`.

Para utilizar sesiones en Laravel, puedes hacerlo de la siguiente manera:

- **Almacenar datos en la sesión:**
  ```php
  // Usando la fachada global Session
  Session::put('key', 'value');
  
  // Usando la función helper session()
  session(['key' => 'value']);
  ```

- **Acceder a los datos de la sesión:**
  ```php
  $value = Session::get('key');
  
  // Con la función helper, y opcionalmente proporcionar un valor por defecto
  $value = session('key', 'default');
  ```

- **Eliminar datos de la sesión:**
  ```php
  Session::forget('key'); // Elimina un elemento específico
  Session::flush(); // Elimina todos los datos de la sesión
  ```

- **Flash data (datos temporales):**
  ```php
  // Almacena datos en la sesión que estarán disponibles solo en la siguiente solicitud
  Session::flash('status', 'Task was successful!');
  ```

- **Desde Blade:**
  Puedes acceder a los datos de la sesión utilizando la fachada `Session` o la función helper `session()` directamente en la plantilla Blade:

```blade
{{-- Usando la fachada Session --}}
{{ Session::get('clave') }}

{{-- Usando la función helper session --}}
{{ session('clave') }}
```

Donde `'clave'` es la llave asociada con el valor que deseas recuperar de la sesión.

## Cookies

Las cookies son pequeños archivos de texto que se almacenan en el navegador del cliente. Laravel permite crear y recuperar cookies de manera segura a través de su clase Cookie y la fachada global Cookie.

- **Crear una cookie:**
  ```php
  // Crear una cookie
  $cookie = cookie('name', 'value', $minutes);
  
  // Crear una cookie que dura para siempre (5 años)
  $foreverCookie = cookie()->forever('name', 'value');
  ```

- **Enviar una cookie con una respuesta:**
  ```php
  return response('Hello World')->cookie($cookie);
  ```

- **Recuperar una cookie:**
  ```php
  $value = Cookie::get('name');
  
  // Con la función helper request()
  $value = $request->cookie('name');
  ```

- **Olvidar una cookie:**
  ```php
  // Para que una cookie sea "olvidada", se debe enviar una cookie con una fecha de expiración en el pasado
  Cookie::queue(Cookie::forget('name'));
  ```
- **Desde Blade:**
Para acceder a una cookie, puedes usar la fachada `Cookie` o la función helper `cookie()` en el controlador y pasar los datos a la vista. Sin embargo, no es común acceder a las cookies directamente desde la vista por razones de seguridad y separación de responsabilidades. De todos modos, si necesitas hacerlo, deberías primero asegurarte de que la cookie esté disponible para la vista, posiblemente pasándola desde el controlador:

```php
// En el controlador
$value = Cookie::get('nombre_cookie');
return view('tu_vista', ['cookieValue' => $value]);
```

```blade
{{-- En la vista Blade --}}
{{ $cookieValue }}
```