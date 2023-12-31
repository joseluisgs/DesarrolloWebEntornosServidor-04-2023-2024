# Autenticacion y Autorización

- [Autenticacion y Autorización](#autenticacion-y-autorización)
  - [Autenticación](#autenticación)
    - [Manejando la sesión](#manejando-la-sesión)
    - [Middleware de autenticación](#middleware-de-autenticación)
  - [Autorización](#autorización)

![logo](./images/01-laravel.png)

## Autenticación
Para iniciar el proceso de [Autenticación](https://laravel.com/docs/10.x/authentication) es importante partir de algunos de ls [Starter kit](https://laravel.com/docs/10.x/authentication#starter-kits) de Laravel, o de Laravel UI.

El propio sistema de Laravel ya crea el Modelo y Migración para User. Si queremos añadir más campos, podemos hacerlo en la migración de User, y luego en el modelo de User, añadirlos a la propiedad `$fillable` para que se puedan rellenar.

Además nos permite crear las rutas y vistas para la Autenticación (/login, /logout, /home, /register, etc...)

```bash
artisan breeze:install
 
artisan migrate
npm install
npm run dev
```
Si usamos Laravel UI, debemos usar:
  
  ```bash
  // Generate basic scaffolding...
artisan ui bootstrap
# php artisan ui vue # si queremos 
# php artisan ui react

// Generate login / registration scaffolding...
artisan ui bootstrap --auth
# artisan ui vue --auth
# artisan ui react --auth

npm install
npm run dev
```

Obviamente podemos personalizar las vistas generadas y adaptarlas a nuestras circunstancias.

### Manejando la sesión
Podemos recibir el usuario autenticado gracias a `Auth` (Controlador) o con `auth()` en las vistas de Blade.

```php
$user = Auth::user();
$id = Auth::id();
if (Auth::check()) {
   // estas loguado
}
```

```php
<li class="nav-item">
  <span class="navbar-text">
      {{ auth()->user()->name ?? 'invitado/a' }}
  </span>
</li>
```

### Middleware de autenticación
Podemos aplicar el middleware para proteger las rutas a solos usuarios autenticados

```php
Route::get('/home', [HomeController::class, 'index'])
    ->middleware('auth');
```

## Autorización
Para realizar la autorización podemos implementar nuestro propio middleware, en base a alguna propiedad o rol del usuario.

Para ello usamos Artisan para crear un middleware:

```bash
artisan make:middleware CheckRole
```

Y en el middleware podemos comprobar si el usuario tiene un rol determinado:

```php
public function handle(Request $request, Closure $next, ...$roles)
{
    if (! $request->user()->hasAnyRole($roles)) {
        abort(403, 'No autorizado');
    }

    return $next($request);
}
```

Posteriormente añadimos este middleware en el fichero Kernel.php:

```php
protected $routeMiddleware = [
    // ...
    'role' => \App\Http\Middleware\CheckRole::class,
];
```

Ahora podemos aplicarlo a la ruta que queramos:

```php
Route::get('/admin', function () {
    //
})->middleware('role:admin');
```

O combinar ambos
  
```php
  Route::get('/admin', function () {
    //
})->middleware('auth', 'role:admin');
```