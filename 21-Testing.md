# Testing
- [Testing](#testing)
  - [Testing](#testing-1)

![logo](./images/01-laravel.png)

## Testing

En Laravel, puedes realizar [pruebas](https://laravel.com/docs/10.x/testing) utilizando el framework de pruebas integrado llamado PHPUnit. Las pruebas en Laravel se crean en el directorio `tests` de tu proyecto y se ejecutan utilizando el comando `php artisan test`. A continuación, te explicaré cómo realizar una prueba básica en Laravel.

Supongamos que tienes una clase `Calculator` con un método `add` que suma dos números. Aquí tienes un ejemplo de cómo escribir una prueba para ese método:

1. Crea un archivo en el directorio `tests` con el nombre `CalculatorTest.php`.

2. Dentro del archivo `CalculatorTest.php`, importa las clases necesarias y crea una clase de prueba que extienda la clase `TestCase` de PHPUnit:

```php
<?php

namespace Tests\Unit;

use App\Calculator;
use Tests\TestCase;

class CalculatorTest extends TestCase
{
    // ...
}
```

3. Dentro de la clase de prueba, agrega un método de prueba para el método `add`:

```php
public function testAdd()
{
    $calculator = new Calculator();
    $result = $calculator->add(2, 3);
    $this->assertEquals(5, $result);
}
```

En este ejemplo, creamos una instancia de la clase `Calculator`, llamamos al método `add` con los números 2 y 3, y luego usamos el método `assertEquals` para verificar que el resultado sea igual a 5.

4. Ejecuta las pruebas utilizando el comando `php artisan test` en la línea de comandos. Laravel ejecutará todas las pruebas en el directorio `tests` y mostrará los resultados.

Este es un ejemplo básico de cómo realizar una prueba en Laravel utilizando PHPUnit. Puedes escribir pruebas más complejas para probar diferentes aspectos de tu aplicación, como las rutas, controladores, modelos, etc. Además, Laravel proporciona funciones adicionales y aserciones específicas para realizar pruebas más avanzadas. Puedes consultar la documentación oficial de Laravel y PHPUnit para obtener más información sobre cómo realizar pruebas en Laravel.