# Sintaxis básica

- [Sintaxis básica](#sintaxis-básica)
  - [Etiqueta PHP](#etiqueta-php)
  - [Comentarios en PHP](#comentarios-en-php)
  - [Escribir en PHP](#escribir-en-php)
    - [Uso de `echo`:](#uso-de-echo)
    - [Uso de `print`:](#uso-de-print)
  - [Variables y Operadores en PHP](#variables-y-operadores-en-php)
  - [Paso por valor y por referencia](#paso-por-valor-y-por-referencia)
    - [Paso por Valor](#paso-por-valor)
    - [Paso por Referencia](#paso-por-referencia)

![logo](./images/01-logo.png)

## Etiqueta PHP
Las etiquetas PHP son marcas especiales que delimitan el código PHP del resto del contenido en un archivo. Estas etiquetas indican al intérprete de PHP dónde comienza y termina el código PHP, permitiendo la inserción de código PHP en medio de HTML, texto plano, y otros tipos de contenido en un archivo .php o en archivos HTML que han sido configurados para ser procesados por PHP.

Existen varias formas de etiquetas PHP, y aquí están las más comunes:

1. **Etiquetas estándar:**
   ```php
   <?php
   // Código PHP aquí
   ?>
   ```
   Estas son las etiquetas más comunes y recomendadas para delimitar código PHP. Son las más portables y menos propensas a errores en diferentes configuraciones de servidores.

2. **Etiquetas cortas:**
   ```php
   <?
   // Código PHP aquí
   ?>
   ```
   Las etiquetas cortas son lo mismo que las etiquetas estándar pero más breves. No siempre están habilitadas en todas las configuraciones de PHP, por lo que su uso no es recomendable si se busca portabilidad del código. Para habilitarlas, se debe configurar el `php.ini` con `short_open_tag=On`.

3. **Etiquetas de eco cortas:**
   ```php
   <?= $variable; ?>
   ```
   Esta es una forma abreviada de `<?php echo $variable; ?>` y es útil para imprimir rápidamente el valor de una variable. Estas etiquetas están siempre disponibles desde PHP 5.4.0, independientemente de la configuración de `short_open_tag`.

## Comentarios en PHP
En PHP, al igual que en muchos otros lenguajes de programación, los comentarios se utilizan para explicar el código y hacerlo más legible tanto para el propio desarrollador como para cualquier otra persona que pueda leerlo en el futuro. PHP soporta varios estilos de comentarios:

1. **Comentarios de una sola línea:**

   Puedes usar `//` para comentar una sola línea de código. Todo lo que sigue a `//` en esa línea será tratado como un comentario.

   ```php
   <?php
   // Esto es un comentario de una sola línea
   echo "Hola mundo"; // Esto también es un comentario
   ?>
   ```

   También puedes usar `#` para el mismo propósito:

   ```php
   <?php
   # Esto es otro comentario de una sola línea
   echo "Hola mundo"; # Esto también es un comentario
   ?>
   ```

2. **Comentarios de múltiples líneas:**

   Si necesitas comentar varias líneas de código, puedes usar la sintaxis `/* ... */`. Todo lo que esté dentro de `/*` y `*/` será tratado como un comentario, independientemente de cuántas líneas ocupe.

   ```php
   <?php
   /*
   Esto es un comentario de múltiples líneas.
   Puede extenderse por varios renglones.
   */
   echo "Hola mundo";
   ?>
   ```

3. **Comentarios de estilo de documentación:**

   PHP también soporta un estilo de comentarios que se utiliza para la documentación automática de código, conocido como PHPDoc. Estos comentarios comienzan con `/**` seguidos de un asterisco en cada línea del comentario.

   ```php
   <?php
   /**
    * Esto es un comentario PHPDoc.
    * Puede ser utilizado por herramientas como phpDocumentor
    * para generar documentación de código automática.
    *
    * @param string $param Descripción del parámetro.
    * @return void
    */
   function miFuncion($param) {
       // Código aquí
   }
   ?>
   ```

Los comentarios son una parte esencial de la programación y deben usarse para explicar el propósito del código, las decisiones de diseño, los posibles problemas y cualquier otra información que pueda ser útil para alguien que esté leyendo el código.

## Escribir en PHP
En PHP, `echo` y `print` son dos construcciones que se utilizan para imprimir datos en la salida. Ambas pueden ser usadas para mostrar strings, números, HTML y el resultado de expresiones en el navegador web o en la consola si se ejecuta PHP desde la línea de comandos. A continuación, te muestro cómo se usan:

### Uso de `echo`:

`echo` es una construcción del lenguaje que puede ser utilizada para mostrar uno o más strings. No es una función, por lo que no es necesario usar paréntesis (aunque se pueden usar). Puede tomar una lista separada por comas de argumentos para imprimir de forma secuencial.

```php
<?php
echo "Hola, mundo!";
echo "Este es un texto", " seguido de otro texto.";
?>
```

### Uso de `print`:

`print` es similar a `echo`, pero tiene algunas diferencias sutiles. Es una construcción del lenguaje con un comportamiento similar al de una función, y siempre devuelve 1. A diferencia de `echo`, `print` solo puede tomar un argumento y es ligeramente más lenta que `echo`. Por lo general, la diferencia de rendimiento es tan pequeña que es insignificante.

```php
<?php
print "Hola, mundo!";
print "Este es un texto" . " concatenado con otro texto.";
?>
```

## Variables y Operadores en PHP
En PHP, las variables se utilizan para almacenar datos, como texto, números, arrays y objetos. Las variables en PHP se representan con un signo de dólar seguido por el nombre de la variable y no necesitan ser declaradas antes de ser utilizadas. PHP es un lenguaje de tipado débil, lo que significa que no es necesario especificar el tipo de dato de una variable; el tipo se determina automáticamente en tiempo de ejecución según el contexto en el que se utiliza la variable.

**Variables en PHP:**
- Para declarar una variable, simplemente se asigna un valor a un nombre de variable precedido por el signo `$`.
- Los nombres de variables son sensibles a mayúsculas y minúsculas.
- Un nombre de variable válido comienza con una letra o un guion bajo, seguido de cualquier número de letras, números o guiones bajos.

```php
<?php
$numero = 5; // variable de tipo entero
$texto = "Hola mundo"; // variable de tipo cadena
$array = array(1, 2, 3); // variable de tipo array
?>
```

**Operadores en PHP:**
PHP proporciona una amplia gama de operadores que se utilizan para realizar operaciones aritméticas, de asignación, de comparación, lógicas, entre otras.

- Operadores aritméticos: `+` (suma), `-` (resta), `*` (multiplicación), `/` (división), `%` (módulo), `**` (exponenciación).
- Operadores de asignación: `=` (asignación básica), `+=`, `-=`, `*=`, `/=`, `.=` (asignación de concatenación).
- Operadores de comparación: `==` (igualdad), `===` (igualdad de tipo y valor), `!=` (diferente), `<>` (diferente), `!==` (diferente de tipo y valor), `>` (mayor que), `<` (menor que), `>=` (mayor o igual que), `<=` (menor o igual que).
- Operadores lógicos: `&&` o `and` (y lógico), `||` o `or` (o lógico), `!` (no lógico), `xor` (o exclusivo lógico).

**Asignación en PHP:**
La asignación se utiliza para dar un valor a una variable. El operador de asignación más común es `=`.

```php
<?php
$numero = 10; // asigna el valor 10 a la variable $numero
$numero += 5; // suma 5 al valor de $numero
$texto = "Hola "; // asigna la cadena "Hola " a la variable $texto
$texto .= "Mundo"; // concatena "Mundo" al final de la variable $texto
?>
```

**Tipos de datos en PHP:**
PHP soporta diez tipos de datos primitivos que se agrupan en tres categorías: cuatro tipos escalares, cuatro tipos compuestos y dos tipos especiales.

- Tipos escalares: `bool` (booleano), `int` (entero), `float` (número de punto flotante, también conocido como `double`), `string` (cadena de caracteres).
- Tipos compuestos: `array` (arreglo), `object` (objeto), `callable` (tipo de datos que puede ser llamado como una función), `iterable` (tipo de datos que puede ser iterado).
- Tipos especiales: `resource` (un recurso especial que mantiene una referencia a recursos externos), `NULL` (variable sin valor).

**Constantes en PHP:**
Las constantes son como las variables, excepto que una vez definidas no pueden ser cambiadas ni redefinidas. Las constantes se definen utilizando la función `define()` y no necesitan un signo de dólar antes de su nombre. Por convención, los nombres de las constantes se escriben en mayúsculas. Tambien se puede usar const

```php
<?php
define("PI", 3.14159265359); // define la constante PI
const PI2 = 3.14159
define("NOMBRE", "Juan"); // define la constante NOMBRE
const NOMBRE2 = "Juan"

echo PI; // imprime el valor de PI
echo PI2; // imprime el valor de PI2
echo NOMBRE; // imprime el valor de NOMBRE
echo NOMBRE2; // imprime el valor de NOMBRE2
?>
```
**Arrays:**
Un array es una estructura de datos que puede almacenar múltiples valores. Los arrays pueden ser de tipo numérico o asociativo. Los arrays numéricos utilizan números como índices y los arrays asociativos utilizan cadenas como índices. Los arrays pueden ser creados utilizando la función `array()` o utilizando la sintaxis abreviada `[]` (disponible desde PHP 5.4.0).

```php
<?php
// array numérico
$miArray = array(1, 2, 3, 4, 5);
$miArray = [1, 2, 3, 4, 5]; // sintaxis abreviada

// array asociativo
$miArray = array("nombre" => "Juan", "apellido" => "Pérez");
$miArray = ["nombre" => "Juan", "apellido" => "Pérez"]; // sintaxis abreviada
?>
```

**Funciones:**
Una función es un bloque de código que se puede reutilizar para realizar una tarea específica. Las funciones pueden tomar argumentos y devolver un valor. Las funciones se definen utilizando la palabra clave `function` seguida del nombre de la función y los paréntesis `()`. Los argumentos se definen entre paréntesis y separados por comas. El cuerpo de la función se define entre llaves `{}`.

```php
<?php
// función sin argumentos
function miFuncion() {
    // código aquí
}

// función con argumentos
function miFuncion($arg1, $arg2) {
    // código aquí
}

// función con argumentos y valor de retorno
function miFuncion($arg1, $arg2) {
    // código aquí
    return $valor;
}

// función con argumentos y valor de retorno opcional
function miFuncion($arg1, $arg2) {
    // código aquí
    if ($condicion) {
        return $valor;
    }
}
?>
```

## Paso por valor y por referencia
En PHP, cuando pasas una variable a una función, puedes hacerlo de dos maneras: por valor o por referencia. La diferencia entre estos dos métodos radica en cómo se maneja la variable dentro de la función y si los cambios realizados dentro de la función afectan a la variable original.

### Paso por Valor

El paso por valor es el comportamiento predeterminado en PHP. Cuando pasas una variable a una función por valor, PHP crea una copia de la variable dentro de la función. Cualquier cambio realizado en esa variable dentro de la función no afecta a la variable original fuera de la función.

```php
function agregarCinco($numero) {
    $numero += 5;
    // $numero es una copia local y los cambios no afectan a la variable fuera de la función.
}

$original = 10;
agregarCinco($original);
echo $original; // Imprime: 10, ya que la función no modifica la variable original
```

### Paso por Referencia

El paso por referencia te permite pasar una variable a una función de tal manera que cualquier cambio en la variable dentro de la función se refleje en la variable original. Para pasar una variable por referencia, debes anteponer un ampersand `&` al nombre del parámetro en la definición de la función.

```php
function agregarDiez(&$numero) {
    $numero += 10;
    // $numero es una referencia a la variable original y los cambios afectan a la variable fuera de la función.
}

$original = 10;
agregarDiez($original);
echo $original; // Imprime: 20, ya que la función modifica la variable original
```

El paso por referencia es útil cuando quieres que la función modifique directamente la variable original o cuando estás trabajando con grandes estructuras de datos y quieres evitar la sobrecarga de memoria que implica hacer una copia de la variable.

Es importante tener en cuenta que solo las variables pueden pasarse por referencia; no puedes pasar un valor literal o una expresión por referencia.

```php
function incrementar(&$valor) {
    $valor++;
}

// Esto es correcto:
$conteo = 1;
incrementar($conteo);
echo $conteo; // Imprime: 2

// Esto generará un error:
incrementar(1); // Error: no se puede pasar un valor literal por referencia
```

En resumen, el paso por valor crea una copia de la variable, por lo que los cambios dentro de la función no afectan a la variable externa, mientras que el paso por referencia opera directamente sobre la variable original, permitiendo que los cambios dentro de la función la modifiquen.