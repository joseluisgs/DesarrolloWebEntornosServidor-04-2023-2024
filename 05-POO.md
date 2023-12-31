# Programación Orientada a Objetos

- [Programación Orientada a Objetos](#programación-orientada-a-objetos)
  - [Clases y Objetos](#clases-y-objetos)
    - [Definir una Clase](#definir-una-clase)
    - [Crear un Objeto](#crear-un-objeto)
  - [Propiedades y Métodos](#propiedades-y-métodos)
    - [Visibilidad](#visibilidad)
  - [Herencia](#herencia)
  - [Polimorfismo](#polimorfismo)
  - [Interfaces](#interfaces)
    - [Clases y Métodos Abstractos](#clases-y-métodos-abstractos)
  - [Métodos Mágicos](#métodos-mágicos)
  - [Espacios de Nombres (Namespaces)](#espacios-de-nombres-namespaces)
    - [Traits](#traits)
    - [Definición y Uso de Traits](#definición-y-uso-de-traits)
  - [Definir un Trait](#definir-un-trait)
    - [Usar un Trait en una Clase](#usar-un-trait-en-una-clase)
    - [Uso de Múltiples Traits](#uso-de-múltiples-traits)
    - [Resolución de Conflictos en Traits](#resolución-de-conflictos-en-traits)
  - [Excepciones](#excepciones)
    - [Definición y Uso de Excepciones](#definición-y-uso-de-excepciones)
      - [Definir una Excepción Personalizada](#definir-una-excepción-personalizada)
      - [Lanzar una Excepción](#lanzar-una-excepción)
      - [Capturar una Excepción](#capturar-una-excepción)
      - [Bloque `finally`](#bloque-finally)
  - [JSON](#json)


![logo](./images/01-logo.png)


## Clases y Objetos

La POO en PHP se centra en la definición de clases y la creación de objetos a partir de estas clases.

### Definir una Clase

Una clase es una plantilla para la creación de objetos y define propiedades (atributos) y métodos (funciones).

```php
class Coche {
    public $color;
    public $marca;

    public function __construct($color, $marca) {
        $this->color = $color;
        $this->marca = $marca;
    }

    public function describir() {
        return "Este coche es un " . $this->marca . " de color " . $this->color;
    }
}
```

### Crear un Objeto

Un objeto es una instancia de una clase.

```php
$miCoche = new Coche("rojo", "Toyota");
echo $miCoche->describir(); // Imprime: Este coche es un Toyota de color rojo
```

## Propiedades y Métodos

Las propiedades son variables dentro de una clase, y los métodos son funciones dentro de una clase.

### Visibilidad

- `public`: Accesible desde cualquier parte del código.
- `protected`: Accesible dentro de la clase y por clases que heredan de ella.
- `private`: Solo accesible dentro de la clase donde se define.

```php
class Ejemplo {
    public $publico = 'Público';
    protected $protegido = 'Protegido';
    private $privado = 'Privado';

    function imprimir() {
        echo $this->publico;
        echo $this->protegido;
        echo $this->privado;
    }
}
```

## Herencia

La herencia permite que una clase herede propiedades y métodos de otra clase.

```php
class Vehiculo {
    public $ruedas = 4;

    public function arrancar() {
        echo "Arrancando el vehículo";
    }
}

class Moto extends Vehiculo {
    public $ruedas = 2;
}

$moto = new Moto();
echo $moto->ruedas; // Imprime: 2
$moto->arrancar(); // Imprime: Arrancando el vehículo
```

## Polimorfismo

El polimorfismo es la capacidad de procesar objetos de manera diferente dependiendo de su clase o estructura de datos.

```php
class Animal {
    public function hacerSonido() {
        echo "Algún sonido";
    }
}

class Perro extends Animal {
    public function hacerSonido() {
        echo "Guau";
    }
}

function sonidoAnimal(Animal $animal) {
    $animal->hacerSonido();
}

$animal = new Animal();
$perro = new Perro();

sonidoAnimal($animal); // Imprime: Algún sonido
sonidoAnimal($perro); // Imprime: Guau
```

## Interfaces

Una interfaz define un contrato que las clases pueden implementar.

```php
interface Encendible {
    public function encender();
}

class Bombilla implements Encendible {
    public function encender() {
        echo "Bombilla encendida";
    }
}

$bombilla = new Bombilla();
$bombilla->encender(); // Imprime: Bombilla encendida
```

### Clases y Métodos Abstractos

Una clase abstracta no puede ser instanciada y se utiliza como base para otras clases.

```php
abstract class Instrumento {
    abstract public function tocar();
}

class Piano extends Instrumento {
    public function tocar() {
        echo "Tocando el piano";
    }
}

$piano = new Piano();
$piano->tocar(); // Imprime: Tocando el piano
```

## Métodos Mágicos

PHP proporciona una serie de "métodos mágicos" que tienen un comportamiento especial. Los más comunes son `__construct()`, `__destruct()`, `__get()`, `__set()`, `__call()`, y `__toString()`.

```php
class Persona {
    private $nombre;

    public function __construct($nombre) {
        $this->nombre = $nombre;
    }

    public function __toString() {
        return $this->nombre;
    }
}

$persona = new Persona("Alice");
echo $persona; // Imprime: Alice
```

## Espacios de Nombres (Namespaces)

Los namespaces se utilizan para evitar conflictos de nombres en el código.

```php
namespace MiProyecto\Herramientas;

class Llave {
    // ...
}
```

Para usar una clase de un namespace, puedes hacerlo así:

```php
use MiProyecto\Herramientas\Llave;

$llave = new Llave();
```
### Traits
En PHP, los traits son un mecanismo para la reutilización de código en lenguajes de programación de herencia simple, como PHP, que no soportan la herencia múltiple. Un trait intenta reducir algunas limitaciones de la herencia simple, permitiendo que los desarrolladores reutilicen conjuntos de métodos libremente en varias clases independientes.

### Definición y Uso de Traits

Veamos cómo definir y usar un trait en PHP:

## Definir un Trait

```php
trait Loggable {
    public function log($message) {
        echo "Log: $message";
    }
}
```

Este trait `Loggable` puede ser utilizado por cualquier clase que necesite una funcionalidad de registro (logging).

### Usar un Trait en una Clase

```php
class File {
    // Imagina que esta clase tiene funcionalidades relacionadas con archivos.
}

class UserFile extends File {
    use Loggable; // Incorporamos el trait Loggable en la clase UserFile

    public function delete() {
        // ... código para eliminar un archivo ...
        $this->log("Archivo eliminado."); // Usamos el método log del trait
    }
}
```

En el ejemplo anterior, la clase `UserFile` extiende de la clase `File`, pero también utiliza el trait `Loggable`. Esto significa que `UserFile` tiene todas las propiedades y métodos de `File`, pero también incluye el método `log` definido en el trait `Loggable`.

### Uso de Múltiples Traits

PHP también permite el uso de múltiples traits dentro de una clase:

```php
trait Sharable {
    public function share($item) {
        echo "Compartiendo {$item}";
    }
}

class Photo {
    use Loggable, Sharable; // Usamos dos traits en la clase Photo

    public function delete() {
        // ... código para eliminar una foto ...
        $this->log("Foto eliminada."); // Usamos el método log de Loggable
    }
}

$photo = new Photo();
$photo->share("una imagen"); // Usamos el método share de Sharable
```

En el código anterior, la clase `Photo` utiliza dos traits, `Loggable` y `Sharable`, lo que le permite tener tanto la funcionalidad de registro como la de compartir.

### Resolución de Conflictos en Traits

Cuando dos traits tienen métodos con el mismo nombre, se produce un conflicto. PHP proporciona una forma de resolver conflictos de nombres de métodos al usar traits:

```php
trait A {
    public function sayHello() {
        echo "Hello from A";
    }
}

trait B {
    public function sayHello() {
        echo "Hello from B";
    }
}

class Talker {
    use A, B {
        B::sayHello insteadOf A; // Usará sayHello de B, no de A
        A::sayHello as sayHelloFromA; // Alias para el método sayHello de A
    }
}

$talker = new Talker();
$talker->sayHello(); // Imprime: Hello from B
$talker->sayHelloFromA(); // Imprime: Hello from A
```

En este ejemplo, `Talker` usa dos traits, `A` y `B`, que tienen un método con el mismo nombre. Se resuelve el conflicto especificando que el método `sayHello` de `B` se utilizará en lugar del de `A`, y se crea un alias para el método `sayHello` de `A` para que todavía sea accesible.

Los traits son una herramienta poderosa en PHP para la reutilización de código y pueden ayudar a reducir la complejidad y mejorar la mantenibilidad de las aplicaciones.

## Excepciones
Las excepciones en PHP son una forma de manejar errores de una manera más controlada. Permiten que el flujo del programa se desvíe a través de un mecanismo de captura de errores, lo que facilita la creación de aplicaciones robustas y fáciles de mantener.

### Definición y Uso de Excepciones

#### Definir una Excepción Personalizada

Puedes definir una excepción personalizada extendiendo la clase `Exception` incorporada en PHP.

```php
class MiExcepcion extends Exception {
    // Puedes personalizar la clase de excepción como desees
    public function mensajePersonalizado() {
        return 'Error en la línea ' . $this->getLine() . ' en el archivo ' . $this->getFile()
            . ': <strong>' . $this->getMessage() . '</strong> es un error personalizado.';
    }
}
```

#### Lanzar una Excepción

Para lanzar una excepción, utilizas la palabra clave `throw` seguida de una instancia de la excepción.

```php
function dividir($dividendo, $divisor) {
    if ($divisor == 0) {
        throw new MiExcepcion('División por cero.');
    }
    return $dividendo / $divisor;
}
```

#### Capturar una Excepción

Para capturar una excepción, debes envolver el código que puede lanzar la excepción en un bloque `try` y luego capturar la excepción en un bloque `catch`.

```php
try {
    echo dividir(10, 0);
} catch (MiExcepcion $ex) {
    echo $ex->mensajePersonalizado();
} catch (Exception $e) {
    // Captura cualquier otra excepción que no sea MiExcepcion
    echo "Error: " . $e->getMessage();
}
```

En el bloque `catch`, puedes manejar la excepción de la manera que consideres más adecuada. También puedes tener múltiples bloques `catch` para manejar diferentes tipos de excepciones de manera específica.

#### Bloque `finally`

El bloque `finally` es opcional y se ejecuta después de los bloques `try` y `catch`, independientemente de si se lanzó una excepción o no. Es útil para limpiar recursos, cerrar conexiones, etc.

```php
try {
    echo dividir(10, 2);
} catch (MiExcepcion $ex) {
    echo $ex->mensajePersonalizado();
} finally {
    echo "Operación terminada.";
}
```

Este es un ejemplo básico de cómo funcionan las excepciones en PHP. Las excepciones son una herramienta poderosa y te permiten escribir código más limpio y con un mejor manejo de errores.

## JSON
En PHP, puedes convertir un objeto a una cadena JSON usando la función `json_encode()`. Para convertir una cadena JSON de vuelta a un objeto PHP, puedes usar la función `json_decode()`.

Aquí tienes un ejemplo de cómo convertir un objeto PHP a JSON:

```php
<?php
// Crear un nuevo objeto de ejemplo
$miObjeto = new stdClass();
$miObjeto->nombre = "Juan";
$miObjeto->edad = 30;
$miObjeto->ciudad = "Madrid";

// Convertir el objeto a JSON
$jsonString = json_encode($miObjeto);

// Mostrar la cadena JSON
echo $jsonString;
?>
```

Esto producirá una salida similar a:

```json
{"nombre":"Juan","edad":30,"ciudad":"Madrid"}
```

Para convertir una cadena JSON de vuelta a un objeto en PHP, puedes hacer lo siguiente:

```php
<?php
// Cadena JSON
$jsonString = '{"nombre":"Juan","edad":30,"ciudad":"Madrid"}';

// Convertir la cadena JSON de vuelta a un objeto PHP
$objetoPHP = json_decode($jsonString);

// Acceder a las propiedades del objeto
echo $objetoPHP->nombre; // Salida: Juan
echo $objetoPHP->edad;   // Salida: 30
echo $objetoPHP->ciudad; // Salida: Madrid
?>
```

Si prefieres trabajar con arrays asociativos en lugar de objetos, puedes pasar `true` como segundo argumento a la función `json_decode()`:

```php
<?php
// Cadena JSON
$jsonString = '{"nombre":"Juan","edad":30,"ciudad":"Madrid"}';

// Convertir la cadena JSON de vuelta a un array asociativo PHP
$arrayPHP = json_decode($jsonString, true);

// Acceder a los elementos del array
echo $arrayPHP['nombre']; // Salida: Juan
echo $arrayPHP['edad'];   // Salida: 30
echo $arrayPHP['ciudad']; // Salida: Madrid
?>
```

Es importante tener en cuenta que `json_encode()` solo puede codificar valores públicos de un objeto. Si necesitas codificar propiedades protegidas o privadas, tendrás que hacerlo manualmente o implementar la interfaz `JsonSerializable` en tus clases para especificar cómo se deben serializar.

Además, siempre es una buena práctica manejar errores al trabajar con JSON, ya que tanto `json_encode()` como `json_decode()` pueden fallar si se encuentran con datos que no pueden ser codificados o decodificados correctamente. Puedes utilizar `json_last_error()` para verificar si ocurrió un error durante la última operación de codificación o decodificación.