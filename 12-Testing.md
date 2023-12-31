# Testing

- [Testing](#testing)
  - [PHPUnit](#phpunit)
    - [Instalación de PHPUnit](#instalación-de-phpunit)
    - [Configuración de PHPUnit](#configuración-de-phpunit)
    - [Escribir pruebas con PHPUnit](#escribir-pruebas-con-phpunit)
    - [Uso de Mocks en PHPUnit](#uso-de-mocks-en-phpunit)
    - [Ejecutar pruebas con PHPUnit](#ejecutar-pruebas-con-phpunit)
    - [Otras consideraciones](#otras-consideraciones)
  - [Ejemplo de Calculadora: Test Unitarios y Mocks](#ejemplo-de-calculadora-test-unitarios-y-mocks)
    - [Fichero phpunit.xml](#fichero-phpunitxml)
    - [Fichero composer.json](#fichero-composerjson)
    - [Calculator](#calculator)
    - [TaxCalculator](#taxcalculator)
    - [CalculatorTest](#calculatortest)
    - [TaxCalculatorTest](#taxcalculatortest)
  - [Conclusión](#conclusión)


![](images/12-logo.png)

## PHPUnit

PHPUnit es un framework de pruebas unitarias para el lenguaje de programación PHP. Te permite escribir y ejecutar pruebas automatizadas para asegurar que tu código funciona como se espera. A continuación, te proporciono una guía paso a paso sobre cómo instalar, configurar y usar PHPUnit, incluyendo ejemplos de pruebas y aserciones, así como el uso de mocks.

### Instalación de PHPUnit

1. **Requisitos previos**: Asegúrate de tener PHP instalado en tu sistema. PHPUnit requiere PHP 7.3 o superior.

2. **Instalar PHPUnit a través de Composer**: Composer es un gestor de dependencias para PHP. Si aún no lo tienes instalado, puedes encontrar las instrucciones en [getcomposer.org](https://getcomposer.org/). Una vez que tengas Composer, puedes instalar PHPUnit ejecutando el siguiente comando en tu terminal:

   ```bash
   composer require --dev phpunit/phpunit ^9
   ```

   Esto instalará PHPUnit y lo agregará como una dependencia de desarrollo en tu archivo `composer.json`.

### Configuración de PHPUnit

1. **Crear un archivo de configuración de PHPUnit**: Puedes configurar PHPUnit creando un archivo `phpunit.xml` en la raíz de tu proyecto. Aquí puedes definir la configuración de tus pruebas, como qué directorios buscar para los archivos de prueba.

   ```xml
   <?xml version="1.0" encoding="UTF-8"?>
   <phpunit bootstrap="vendor/autoload.php"
            colors="true"
            verbose="true">
       <testsuites>
           <testsuite name="Test Suite">
               <directory>tests</directory>
           </testsuite>
       </testsuites>
   </phpunit>
   ```

   En este archivo, `bootstrap` especifica el script que se ejecuta antes de las pruebas, que generalmente es el autoloader generado por Composer. `testsuites` define una suite de pruebas y dónde encontrar los archivos de prueba.

2. **Estructura de directorios**: Organiza tus archivos de prueba en el directorio `tests` o en cualquier otro que hayas especificado en tu archivo `phpunit.xml`.

### Escribir pruebas con PHPUnit

1. **Clases y métodos de prueba**: Los archivos de prueba deben nombrarse con el sufijo `Test` y deben extender la clase `PHPUnit\Framework\TestCase`. Cada método de prueba dentro de la clase debe comenzar con la palabra `test`.

   ```php
   // tests/CalculatorTest.php
   use PHPUnit\Framework\TestCase;

   class CalculatorTest extends TestCase
   {
       public function testAdd()
       {
           $calculator = new Calculator();
           $result = $calculator->add(2, 3);
           $this->assertEquals(5, $result);
       }
   }
   ```

2. **Aserciones**: PHPUnit proporciona una serie de aserciones que puedes utilizar para verificar que tu código funciona como se espera. Algunas de las aserciones más comunes incluyen:

   - `$this->assertEquals($expected, $actual)`: Verifica que dos valores sean iguales.
   - `$this->assertTrue($condition)`: Verifica que una condición sea verdadera.
   - `$this->assertFalse($condition)`: Verifica que una condición sea falsa.
   - `$this->assertNull($value)`: Verifica que un valor sea nulo.
   - `$this->assertInstanceOf($expected, $actual)`: Verifica que un objeto sea una instancia de una clase específica.

3. **Before y After**: PHPUnit proporciona métodos para ejecutar antes/después de todas las pruebas o de cada una de las pruebas
   - `setUp()`: Para ejecutar código antes de cada método de prueba, utilizas el método setUp(). Este método se llama automáticamente antes de cada prueba.
   - `tearDown()`: Para ejecutar código después de cada método de prueba, utilizas el método tearDown(). Este método se llama automáticamente después de cada prueba.
   - `setUpBeforeClass()`: Para ejecutar código antes de todas las pruebas, utilizas el método setUpBeforeClass(). Este método se llama automáticamente antes de todas las pruebas. Es un método de clase, por lo que está etiquetado como `static`.
   - `tearDownBeforeClass()`: Para ejecutar código después de todas las pruebas, utilizas el método tearDownBeforeClass(). Este método se llama automáticamente después de todas las pruebas. Es un método de clase, por lo que está etiquetado como `static`.

```php
// tests/CalculatorTest.php
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function setUp(): void
    {
        // Este código se ejecuta antes de cada prueba.
    }

    public function tearDown(): void
    {
        // Este código se ejecuta después de cada prueba.
    }

    public static function setUpBeforeClass(): void
    {
        // Este código se ejecuta antes de todas las pruebas.
    }

    public static function tearDownAfterClass(): void
    {
        // Este código se ejecuta después de todas las pruebas.
    }

    public function testAdd()
    {
        $calculator = new Calculator();
        $result = $calculator->add(2, 3);
        $this->assertEquals(5, $result);
    }
}
```



### Uso de Mocks en PHPUnit

Mocks son objetos que simulan y registran interacciones entre objetos en tus pruebas. Son útiles cuando quieres probar una clase pero no quieres involucrar sus dependencias.

1. **Crear un mock**: Puedes crear un mock para una clase usando el método `createMock()`:

   ```php
   public function testFunctionWithDependency()
   {
       // Crear un mock para la clase Dependency.
       $mock = $this->createMock(Dependency::class);
       
       // Configurar el comportamiento esperado del mock.
       $mock->method('functionToMock')
            ->willReturn('value');

       // Usar el mock como si fuera una instancia real de la clase Dependency.
       $classToTest = new ClassToTest($mock);
       $result = $classToTest->functionThatUsesDependency();

       // Asegurarse de que el resultado es el esperado.
       $this->assertEquals('expected result', $result);
   }
   ```

### Ejecutar pruebas con PHPUnit

Para ejecutar tus pruebas, simplemente navega a la raíz de tu proyecto en la terminal y ejecuta el siguiente comando:

```bash
vendor/bin/phpunit
```

PHPUnit buscará y ejecutará automáticamente todas las pruebas definidas en los archivos de prueba dentro de tu directorio `tests` (o el que hayas especificado en tu archivo `phpunit.xml`).




### Otras consideraciones
A veces para que el código funcione con el test de PHPUnit necesitarás asegurarte de que la clase `Calculator` esté cargada correctamente. Si estás utilizando Composer, puedes hacerlo agregando un autoloader. Aquí tienes un ejemplo de cómo configurar el autoloader en tu archivo `composer.json`:

```json
{
    "autoload": {
        "psr-4": {
            "": "src/"
        }
    },
    "require-dev": {
        "phpunit/phpunit": "^9"
    }
}
```

## Ejemplo de Calculadora: Test Unitarios y Mocks

### Fichero phpunit.xml
```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit bootstrap="vendor/autoload.php"
         colors="true"
         verbose="true">
    <testsuites>
        <testsuite name="Test Suite">
            <directory>tests</directory>
        </testsuite>
    </testsuites>
</phpunit>
```

### Fichero composer.json
```json
{
  "autoload": {
    "psr-4": {
      "": "src/"
    }
  },
  "require-dev": {
    "phpunit/phpunit": "^9"
  }
}
```	

Ejecutamos:
```bash
composer install
```

### Calculator
```php
<?php

namespace Calculator;

class Calculator
{
    /**
     * Suma dos números.
     *
     * @param int|float $a Primer número a sumar.
     * @param int|float $b Segundo número a sumar.
     * @return int|float La suma de $a y $b.
     */
    public function add($a, $b)
    {
        return $a + $b;
    }
}
```

### TaxCalculator
```php
<?php

namespace Calculator;

class TaxCalculator
{
    private $calculator;
    private $taxRate;

    public function __construct(Calculator $calculator, $taxRate)
    {
        $this->calculator = $calculator;
        $this->taxRate = $taxRate;
    }

    public function calculateTax($amount)
    {
        $tax = $amount * ($this->taxRate / 100);
        return $this->calculator->add($amount, $tax);
    }
}
```

### CalculatorTest
```php	
<?php

use Calculator\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testAdd()
    {
        $calculator = new Calculator();
        $result = $calculator->add(2, 3);
        $this->assertEquals(5, $result);
    }
}

```

### TaxCalculatorTest
```php
<?php

use Calculator\Calculator;
use Calculator\TaxCalculator;
use PHPUnit\Framework\TestCase;

class TaxCalculatorTest extends TestCase
{
    public function testCalculateTax()
    {
        // Crear un mock para la clase Calculator.
        $calculatorMock = $this->createMock(Calculator::class);

        // Configurar el mock para que, cuando se llame al método add con ciertos valores,
        // se devuelva un valor específico.
        $calculatorMock->expects($this->once())
            ->method('add')
            ->with(100, 10) // Supongamos que $amount es 100 y el impuesto calculado es 10.
            ->willReturn(110);

        // Crear una instancia de TaxCalculator con el mock de Calculator y un porcentaje de impuesto.
        $taxRate = 10; // 10% de impuesto
        $taxCalculator = new TaxCalculator($calculatorMock, $taxRate);

        // Llamar al método calculateTax y verificar que el resultado es el esperado.
        $amount = 100; // Cantidad base
        $result = $taxCalculator->calculateTax($amount);
        $expectedResult = 110; // Cantidad base + impuesto

        $this->assertEquals($expectedResult, $result);
    }
}
```


Después de agregar esta configuración, ejecuta `composer dump-autoload` en la terminal para generar el autoloader. Esto hará que la clase `Calculator` esté disponible para ser utilizada en tus pruebas y en tu aplicación.

Ahora, cuando ejecutes tus pruebas con `vendor/bin/phpunit`, PHPUnit cargará automáticamente la clase `Calculator` gracias al autoloader, y podrás ver si tu método `add` pasa la prueba definida en `CalculatorTest`.

Un "autoloader" en PHP es un mecanismo que permite cargar automáticamente las clases PHP cuando se necesitan, sin tener que incluir manualmente los archivos que contienen las definiciones de las clases con `require` o `include`.

Antes de que el autoloading se convirtiera en una práctica común, los desarrolladores de PHP tenían que incluir manualmente los archivos de clase utilizando `require`, `require_once`, `include` o `include_once` antes de poder instanciar objetos de esas clases. Esto podía llevar a un código repetitivo y a veces a errores si se olvidaba incluir un archivo necesario.

El autoloading simplifica este proceso al registrar una o más funciones de "autoloading" que PHP ejecutará automáticamente cada vez que se haga referencia a una clase que aún no ha sido definida. Si se define correctamente, el autoloader puede buscar y cargar el archivo correcto que contiene la definición de la clase sin intervención manual.

El estándar de autoloading más aceptado en PHP es el PSR-4, que proporciona una convención para mapear espacios de nombres de clases a estructuras de directorios de archivos.

Con Composer, el autoloading se maneja automáticamente. Simplemente defines las reglas de mapeo de tu espacio de nombres en `composer.json` y ejecutas `composer dump-autoload`, y Composer generará un autoloader eficiente para tu proyecto.

## Conclusión

Este es un tutorial básico para comenzar con PHPUnit. Hay muchas características y técnicas avanzadas que puedes explorar, como pruebas de datos, grupos de pruebas, pruebas de excepciones, y más. La documentación oficial de PHPUnit es un recurso excelente para aprender más sobre estas características: [PHPUnit Manual](https://phpunit.de/manual/9.5/en/index.html).