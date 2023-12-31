# Eloquent ORM: Migraciones y Modelos

- [Eloquent ORM: Migraciones y Modelos](#eloquent-orm-migraciones-y-modelos)
  - [Eloquent ORM](#eloquent-orm)
  - [Modelos y Migraciones](#modelos-y-migraciones)
    - [Relaciones](#relaciones)
  - [Seeders](#seeders)
  - [Scopes](#scopes)


![logo](./images/01-laravel.png)

## Eloquent ORM
Eloquent ORM (Object-Relational Mapping) es el sistema de mapeo objeto-relacional incluido en el framework Laravel. Proporciona una forma elegante y sencilla de interactuar con la base de datos utilizando objetos y métodos en lugar de escribir consultas SQL directamente.

Eloquent permite definir modelos que representan tablas en la base de datos. Cada modelo está asociado con una tabla y permite realizar operaciones de lectura, escritura, actualización y eliminación de registros de manera intuitiva y expresiva.

Algunas características y beneficios de Eloquent ORM son:

1. Abstracción de la base de datos: Eloquent abstrae los detalles de la base de datos subyacente, lo que significa que puedes cambiar fácilmente entre diferentes sistemas de gestión de bases de datos (como MySQL, PostgreSQL, SQLite, etc.) sin tener que modificar tu código.

2. Relaciones entre tablas: Eloquent facilita la definición y el manejo de relaciones entre tablas en la base de datos, como relaciones uno a uno, uno a muchos y muchos a muchos. Puedes definir estas relaciones en tus modelos y acceder a los registros relacionados de manera sencilla.

3. Consultas fluidas: Eloquent utiliza una sintaxis de consulta fluida que te permite construir consultas complejas utilizando métodos encadenados. Esto hace que las consultas a la base de datos sean más legibles y fáciles de mantener.

4. Acceso a los datos: Eloquent proporciona métodos y propiedades para acceder a los datos de los registros de la base de datos de forma sencilla. Puedes acceder a los campos de la tabla como propiedades en el objeto del modelo y utilizar métodos para realizar operaciones como guardar, actualizar y eliminar registros.

5. Eventos del ciclo de vida del modelo: Eloquent ofrece eventos que se disparan en diferentes etapas del ciclo de vida del modelo, como antes de guardar, después de guardar, antes de eliminar, etc. Esto te permite ejecutar lógica personalizada en respuesta a estos eventos.

## Modelos y Migraciones 
Los modelos en Laravel son clases que representan tablas específicas de la base de datos. Cada modelo se asocia con una tabla y proporciona una interfaz para interactuar con los registros de esa tabla. Los modelos se utilizan para realizar operaciones de consulta, inserción, actualización y eliminación en la base de datos de manera sencilla y orientada a objetos.

Los modelos en Laravel se encuentran en el directorio `app` por defecto y generalmente se crean en el espacio de nombres `App\Models`. Cada modelo extiende la clase base `Illuminate\Database\Eloquent\Model`, que proporciona una variedad de métodos y funcionalidades.

Al crear un modelo en Laravel, puedes definir relaciones con otros modelos, como relaciones uno a uno, uno a muchos y muchos a muchos. Esto permite establecer conexiones entre tablas y acceder a los registros relacionados de manera sencilla.

Además de las operaciones básicas de CRUD (crear, leer, actualizar y eliminar), los modelos también pueden contener métodos personalizados para realizar consultas más complejas, aplicar filtros, ordenar resultados y realizar otras lógicas relacionadas con los datos.

Las [migraciones](https://laravel.com/docs/10.x/migrations) en Laravel son archivos que se utilizan para definir y modificar la estructura de la base de datos de manera programática. En lugar de escribir consultas SQL directamente, las migraciones te permiten utilizar una sintaxis de alto nivel para crear, modificar o eliminar tablas, columnas e índices en la base de datos.

Las migraciones se encuentran en el directorio `database/migrations` y se crean utilizando el generador de migraciones de Laravel. Cada migración es una clase que extiende la clase base `Illuminate\Database\Migrations\Migration` y contiene dos métodos principales: `up` y `down`.

El método `up` define las acciones que se deben realizar al ejecutar la migración, como crear tablas o agregar columnas. El método `down` define las acciones que se deben realizar al revertir la migración, como eliminar tablas o deshacer cambios en la estructura de la base de datos.

```bash
artisan make:model Producto -m # Crea el modelo y la migración
```

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}

```

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price'];
}
```
  
En este ejemplo, el modelo Product está asociado con la tabla "products" en la base de datos. La propiedad $fillable especifica los campos que se pueden asignar masivamente (es decir, se pueden establecer en masa utilizando el método create() o update()).

Ejecutar migraciones: Para aplicar la migración y crear la tabla "products" en la base de datos, ejecuta el siguiente comando en la terminal:

```bash
artisan migrate  # o migrate:fresh si quieres que se ejecute todo de manera limpia perdiendo la info que ya haya y partiendo desde cero
```

### Relaciones
En Laravel, puedes definir relaciones entre modelos utilizando Eloquent ORM. Hay varias tipos de relaciones disponibles, como las relaciones uno a uno, uno a muchos y muchos a muchos. En tu ejemplo de Productos y Categorías, se puede establecer una relación de uno a muchos, donde una categoría tiene muchos productos y un producto pertenece a una categoría.

Aquí tienes un ejemplo de cómo definir y utilizar esta relación en Laravel:

1. En el modelo `Producto`:
```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'precio'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
```

En este ejemplo, se define el método `categoria()` en el modelo `Producto`. Este método utiliza el método `belongsTo()` de Eloquent para establecer la relación de pertenencia a una categoría. La función `belongsTo()` especifica que un producto pertenece a una categoría. 

2. En el modelo `Categoria`:
```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nombre'];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
```

En el modelo `Categoria`, se define el método `productos()` que utiliza el método `hasMany()` para establecer la relación de uno a muchos con el modelo `Producto`. Esto indica que una categoría puede tener muchos productos.


***Obviamente se debe crear las migraciones para tener este tipo de relaciones en cuenta:***
```bash
artisan make:model Producto -m # Crea el modelo y la migración
artisan make:model Categoria -m # Crea el modelo y la migración
```

```php
Schema::create('categorias', function (Blueprint $table) {
    $table->id();
    $table->string('nombre');
    // Otros campos de la categoría
    $table->timestamps();
});


Schema::create('productos', function (Blueprint $table) {
    $table->id();
    $table->string('nombre');
    // Otros campos del producto
    $table->unsignedBigInteger('categoria_id');
    $table->foreign('categoria_id')->references('id')->on('categorias');
    $table->timestamps();
});
```


3. Utilizando las relaciones:
Una vez definidas las relaciones, puedes utilizarlas para acceder a los productos de una categoría o la categoría de un producto. Por ejemplo:

```php
// Obtener todos los productos de una categoría
$categoria = Categoria::find(1);
$productos = $categoria->productos;

// Obtener la categoría de un producto
$producto = Producto::find(1);
$categoria = $producto->categoria;
```

1. Relación uno a uno:
Supongamos que tienes un modelo `Usuario` y un modelo `Perfil`, donde un usuario tiene un único perfil asociado. Puedes definir la relación uno a uno de la siguiente manera:

En el modelo `Usuario`:
```php
public function perfil()
{
    return $this->hasOne(Perfil::class);
}
```

En el modelo `Perfil`:
```php
public function usuario()
{
    return $this->belongsTo(Usuario::class);
}
```

2. Relación muchos a muchos:
Supongamos que tienes un modelo `Etiqueta` y un modelo `Articulo`, donde un artículo puede tener múltiples etiquetas y una etiqueta puede estar asociada a varios artículos. Puedes definir la relación muchos a muchos de la siguiente manera:

En el modelo `Articulo`:
```php
public function etiquetas()
{
    return $this->belongsToMany(Etiqueta::class);
}
```

En el modelo `Etiqueta`:
```php
public function articulos()
{
    return $this->belongsToMany(Articulo::class);
}
```

3. Relación polimórfica:
Supongamos que tienes un modelo `Comentario` que puede estar asociado tanto a un modelo `Articulo` como a un modelo `Foto`. Puedes definir una relación polimórfica de la siguiente manera:

En el modelo `Comentario`:
```php
public function comentable()
{
    return $this->morphTo();
}
```

En el modelo `Articulo`:
```php
public function comentarios()
{
    return $this->morphMany(Comentario::class, 'comentable');
}
```

En el modelo `Foto`:
```php
public function comentarios()
{
    return $this->morphMany(Comentario::class, 'comentable');
}
```

## Seeders
Los [Seeders](https://laravel.com/docs/10.x/seeding) son clases que se utilizan para poblar la base de datos con datos de prueba o datos iniciales. Los seeders son útiles cuando necesitas tener datos predefinidos en tu base de datos, como registros de usuarios, categorías, productos, etc. Puedes usar seeders para crear estos registros automáticamente en lugar de tener que ingresarlos manualmente.

Los seeders se encuentran en el directorio `database/seeders` y se crean utilizando el generador de seeders de Laravel. Cada seeder es una clase que extiende la clase base `Illuminate\Database\Seeder` y contiene un método `run()` que se ejecuta cuando se ejecuta el seeder.

```bash
artisan make:seeder ProductosTableSeeder
```

```php
use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductosTableSeeder extends Seeder
{
    public function run()
    {
        Producto::create([
            'nombre' => 'Producto 1',
            'precio' => 10.99,
        ]);

        Producto::create([
            'nombre' => 'Producto 2',
            'precio' => 19.99,
        ]);

        // Agrega más registros de productos si es necesario
    }
}
```	

Para ejecutar los seeders, hacemos
```bash
artisan db:seed --class=ProductosTableSeeder
```

Podemos agrupar todos los seeders en un solo seeder, por ejemplo, `DatabaseSeeder`. El seeder `DatabaseSeeder` es un seeder especial en Laravel que se utiliza para agrupar todos los otros seeders. Sirve como punto de entrada para ejecutar múltiples seeders a la vez. En lugar de ejecutar cada seeder individualmente, puedes ejecutar el `DatabaseSeeder` y Laravel se encargará de ejecutar todos los seeders que hayas definido dentro de él.

Dentro del `DatabaseSeeder`, puedes definir los seeders que deseas ejecutar utilizando el método `call()`. Por ejemplo, si tienes un seeder llamado `UsersTableSeeder`, puedes llamarlo dentro de `DatabaseSeeder` de la siguiente manera:

```php
public function run()
{
    $this->call(UsersTableSeeder::class);
}
```

De esta manera, cuando ejecutes el comando `php artisan db:seed`, Laravel ejecutará el `DatabaseSeeder` y, a su vez, ejecutará el `UsersTableSeeder` y cualquier otro seeder que hayas definido dentro de él.

Esto proporciona una forma conveniente de organizar y ejecutar múltiples seeders al mismo tiempo, lo que facilita la inicialización de la base de datos con datos de prueba o predefinidos.

## Scopes
Los [scopes](https://laravel.com/docs/10.x/eloquent#query-scopes) son métodos que se utilizan para reutilizar consultas comunes en tus modelos. Los scopes te permiten definir consultas comunes que se pueden reutilizar en diferentes partes de tu aplicación. Esto te permite mantener tu código DRY (Don't Repeat Yourself) y evitar la repetición de código.

En Laravel, un "scope" se refiere a una restricción que se define dentro de un modelo de Eloquent que permite especificar, reutilizar y encadenar condiciones de consulta comunes a la base de datos. Los scopes permiten definir consultas complejas de forma legible y reutilizable, y pueden ser "locales" o "globales".

**Scopes Locales**: Son métodos que definen una restricción de consulta particular que puedes encadenar a otras consultas de Eloquent dentro de tus modelos. Para definir un scope local, simplemente crea un método en tu modelo Eloquent que sea precedido por la palabra `scope`.

Aquí tienes un ejemplo de cómo definir y usar un scope local:

```php
class Post extends Model
{
    /**
     * Scope a query to only include popular posts.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePopular($query)
    {
        return $query->where('views', '>', 100);
    }

    /**
     * Scope a query to only include active posts.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', '=', 1);
    }
}

// Uso de los scopes definidos en el modelo Post
$popularPosts = Post::popular()->get();
$activePopularPosts = Post::popular()->active()->get();
```

En el ejemplo, `Post::popular()` utiliza el scope `popular` para obtener solo los posts que tienen más de 100 vistas. También puedes encadenar scopes, como en `Post::popular()->active()`, que obtendrá posts que son populares y activos al mismo tiempo.

**Scopes Globales**: Permiten definir restricciones de consulta que se aplican automáticamente a todas las operaciones de Eloquent relacionadas con ese modelo. Los scopes globales son útiles cuando tienes ciertas condiciones que siempre quieres aplicar a un modelo cuando realizas consultas.

Para definir un scope global, puedes usar el método `addGlobalScope` en el modelo. Aquí tienes un ejemplo de cómo implementar un scope global:

```php
class Post extends Model
{
    protected static function booted()
    {
        static::addGlobalScope('age', function (Builder $builder) {
            $builder->where('created_at', '>', now()->subYears(1));
        });
    }
}

// Cuando consultes el modelo Post, el scope global se aplicará automáticamente
$recentPosts = Post::all(); // Solo devolverá posts creados en el último año
```

En este ejemplo, todos los posts que se consulten a través del modelo `Post` deberán haber sido creados en el último año. No necesitas llamar explícitamente al scope global; se aplica automáticamente a todas las consultas del modelo.

Los scopes son una herramienta muy poderosa en Laravel que te permite encapsular la lógica de las consultas de forma que tu código sea más limpio, más expresivo y más fácil de mantener.





