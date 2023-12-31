# Controladores y Rutas

- [Controladores y Rutas](#controladores-y-rutas)
  - [Controladores](#controladores)
    - [Request](#request)
    - [Validaciones](#validaciones)
    - [Ejemplo de CRUD](#ejemplo-de-crud)
  - [Rutas](#rutas)
    - [Consulta de rutas](#consulta-de-rutas)
    - [Creación de rutas](#creación-de-rutas)


![logo](./images/01-laravel.png)

## Controladores
En Laravel, un [controlador](https://laravel.com/docs/10.x/controllers) es una clase que se utiliza para manejar las solicitudes HTTP y realizar las acciones correspondientes. Los controladores son responsables de procesar los datos recibidos desde las rutas y realizar las operaciones necesarias, como recuperar datos de la base de datos, realizar cálculos, interactuar con otros componentes del sistema, y finalmente devolver una respuesta al cliente.

Para crear un controlador de productos en Laravel, puedes seguir estos pasos:

1. Abre una terminal y navega hasta el directorio raíz de tu proyecto Laravel.
2. Ejecuta el siguiente comando para crear un nuevo controlador llamado "ProductosController":

```bash
php artisan make:controller ProductosController
```

Esto generará un archivo llamado "ProductosController.php" en el directorio "app/Http/Controllers" de tu proyecto.

3. Abre el archivo "app/Http/Controllers/ProductosController.php" y dentro de la clase "ProductosController", puedes definir métodos para manejar diferentes acciones relacionadas con los productos. Por ejemplo, puedes tener un método llamado "index" para mostrar una lista de productos:

```php
public function index()
{
    $productos = Producto::all();
    return view('productos.index')->with('productos', $productos);
}
```

En este ejemplo, se utiliza el modelo "Producto" para obtener todos los productos de la base de datos y se pasa la lista de productos a una vista llamada "index".

4. Puedes agregar más métodos al controlador según tus necesidades, como "create" para mostrar un formulario de creación de productos, "store" para guardar un nuevo producto en la base de datos, "edit" para mostrar el formulario de edición de un producto existente, "update" para actualizar un producto, y así sucesivamente.

**Recuerda que en Laravel, los controladores deben estar registrados en las rutas para que puedan ser accedidos. Puedes definir las rutas en el archivo "routes/web.php" o en archivos de rutas separados según tu preferencia.**

### Request
Los controladores de Laravel pueden recibir datos de entrada de varias maneras, como por ejemplo a través de la URL, de un formulario HTML, de una petición AJAX, etc. Para manejar estos datos de entrada, Laravel proporciona la clase [Request](https://laravel.com/docs/10.x/requests), que se puede utilizar en los controladores para acceder a los datos de entrada y realizar las validaciones necesarias.

Por ejemplo podemos obtener la ruta o id de un producto para acceder a el de la siguiente manera:

```php
public function show($id)
{
    $producto = Producto::find($id);
    return view('productos.show')->with('producto', $producto);
}
```

### Validaciones
En Laravel, la [validación](https://laravel.com/docs/10.x/validation) de los request es una parte fundamental para garantizar la integridad y la seguridad de los datos que se envían a través de formularios o solicitudes HTTP. Laravel proporciona una forma sencilla y poderosa de validar los datos ingresados por el usuario antes de ser procesados.

Para validar los request en Laravel, puedes seguir los siguientes pasos:

1. Definir las reglas de validación: En tu controlador, define las reglas de validación para cada campo del request. Puedes hacerlo utilizando el método `validate` o creando un array de reglas en el método `rules` del controlador. Por ejemplo:

```php
public function store(Request $request)
{
    $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
    ];

    $validatedData = $request->validate($rules);

    // Procesar los datos validados...
}
```

En este ejemplo, se definen tres reglas de validación: el campo "name" es requerido y debe ser una cadena de texto de máximo 255 caracteres, el campo "email" es requerido, debe ser un formato de correo electrónico válido y debe ser único en la tabla "users", y el campo "password" es requerido y debe tener al menos 8 caracteres.

2. Mostrar mensajes de error: Si la validación falla, Laravel automáticamente redireccionará al usuario de vuelta a la página anterior y mostrará los mensajes de error correspondientes. Puedes mostrar estos mensajes en tu vista utilizando la variable de sesión `errors`. Por ejemplo:

```html
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
```

Este código verifica si hay errores en la validación y, en caso afirmativo, muestra una lista con los mensajes de error.

3. Personalizar mensajes de validación: Si deseas personalizar los mensajes de error para cada campo, puedes definirlos en el método `messages` del controlador. Por ejemplo:

```php
public function messages()
{
    return [
        'name.required' => 'El campo nombre es requerido.',
        'email.required' => 'El campo correo electrónico es requerido.',
        // ...
    ];
}
```
 También podemos validar respecto a una tabla existente y una columna, por ejemplo que el id de categoria que nos entre, exista en Categorias. Para ello podemos hacer lo siguiente:

```php
public function rules()
{
    return [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
        'categoria_id' => 'required|exists:categorias,id',
    ];
}
```

### Ejemplo de CRUD
```php	
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Validator;

class ProductoController extends Controller
{
    // Método para mostrar todos los productos
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index')->with($productos);
    }

    // Método para mostrar el formulario de creación de un nuevo producto
    public function create()
    {
        return view('productos.create');
    }

    // Método para guardar un nuevo producto en la base de datos
    public function store(Request $request)
    {
        // Validación de campos
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'descripcion' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Crear el producto
        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->descripcion = $request->input('descripcion');
        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    // Método para mostrar un producto específico
    public function show($id)
    {
        $producto = Producto::find($id);
        return view('productos.show')->with('producto', $producto);
    }

    // Método para mostrar el formulario de edición de un producto
    public function edit($id)
    {
        $producto = Producto::find($id);
        return view('productos.edit')->with('producto', $producto);
    }

    // Método para actualizar un producto en la base de datos
    public function update(Request $request, $id)
    {
        // Validación de campos
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'descripcion' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Actualizar el producto
        $producto = Producto::find($id);
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->descripcion = $request->input('descripcion');
        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    // Método para eliminar un producto de la base de datos
    public function destroy($id)
    {
        $producto = Producto::find($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
```

## Rutas
En Laravel, las [rutas](https://laravel.com/docs/10.x/routing) son utilizadas para definir cómo responderá la aplicación a una solicitud HTTP específica. Las rutas actúan como una capa de abstracción entre las URL y la lógica de la aplicación, permitiéndote definir fácilmente qué controlador y método deben ejecutarse cuando se accede a una URL determinada. Se definen en el fichero `routes/web.php`.


### Consulta de rutas

Puedes usar el siguiente comando:
```bash
php artisan route:list
```

### Creación de rutas

1. Ruta básica:
```php
Route::get('/ruta', function () {
    return '¡Hola, mundo!';
});
```
En este ejemplo, cuando se accede a la URL "/ruta" a través de una solicitud HTTP GET, Laravel ejecutará la función anónima y devolverá "¡Hola, mundo!" como respuesta.

2. Ruta con parámetros:
```php
Route::get('/usuario/{id}', function ($id) {
    return 'ID de usuario: ' . $id;
});
```
En este caso, la ruta "/usuario/{id}" captura un parámetro llamado "id" de la URL. Puedes acceder a este parámetro dentro de la función anónima y utilizarlo en la lógica de tu aplicación.

3. Ruta que llama a un controlador:
```php
Route::get('/usuarios', 'UserController@index');
```
Aquí, la ruta "/usuarios" está asociada al método "index" del controlador "UserController". Cuando se accede a esta ruta, Laravel llamará automáticamente al método "index" del controlador y devolverá su respuesta.

4. Ruta con parámetros que llama a un controlador:
```php
Route::get('/usuario/{id}', 'UserController@show');
```

5. Ruta con nombre, de esta manera podemos usar el nombre en vez de la ruta completa
```php
Route::get('/usuario/{id}', 'UserController@show')->name('usuario.show');
```

6. Ruta con parámetros opcionales:
```php
Route::get('/usuario/{id?}', 'UserController@show');
```

7. Ruta con parámetros opcionales y valor por defecto:
```php
Route::get('/usuario/{id?}', 'UserController@show')->defaults('id', 1)-name('usuario.show');
```

8. Ruta con parámetros opcionales y restricciones:
```php
Route::get('/usuario/{id?}', 'UserController@show')->where('id', '[0-9]+');
```

9. Podemos agrupar un conjunto de rutas que tengan algo en común, por ejemplo, todas las que tengan que ver como usuarios, y así poder reutilizarlas y tenerlas más organizadas. Para ello podemos hacer lo siguiente:

```php
Route::prefix('usuarios')->group(function () {
    Route::get('/', 'UserController@index')->name('usuarios.index');
    Route::get('/{id}', 'UserController@show')->name('usuarios.show');
    Route::get('/{id}/edit', 'UserController@edit')->name('usuarios.edit');
    Route::put('/{id}', 'UserController@update')->name('usuarios.update');
    Route::delete('/{id}', 'UserController@destroy')->name('usuarios.destroy');
});
```

10. Rutas de recursos, las cuales nos crea todas las operaciones CRUD, por ejemplo para Productos
```php
Route::resource('productos', 'ProductoController');
```

11. Uso de middlewares. Podemos aplicar middleware para por ejemplo aplicar opciones de autenticación/autorización. Se puede aplicar a un grupo completo o a una sola ruta.
```php
 Route::post('/', [ProductoController::class, 'store'])->name('productos.store')->middleware(['auth', 'admin']);
```

12. Redireccionar
```php
Route::redirect('/here', '/there', 301);
```


