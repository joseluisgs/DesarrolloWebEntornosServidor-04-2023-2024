# Arrays, Colecciones y Strings

- [Arrays, Colecciones y Strings](#arrays-colecciones-y-strings)
    - [Tipos de Arrays](#tipos-de-arrays)
      - [Arrays Indexados](#arrays-indexados)
      - [Arrays Asociativos](#arrays-asociativos)
      - [Arrays Multidimensionales](#arrays-multidimensionales)
    - [Operaciones Comunes con Arrays](#operaciones-comunes-con-arrays)
      - [Recorrer Arrays](#recorrer-arrays)
      - [Contar Elementos](#contar-elementos)
      - [Filtrar Arrays](#filtrar-arrays)
      - [Mapear Arrays](#mapear-arrays)
      - [Reducir Arrays](#reducir-arrays)
      - [Ordenar Arrays](#ordenar-arrays)
      - [Combinar y Dividir Arrays](#combinar-y-dividir-arrays)
      - [Comprobar si un Elemento o Clave Existe](#comprobar-si-un-elemento-o-clave-existe)
  - [Strings](#strings)
    - [Ejemplo de uso de strings en PHP](#ejemplo-de-uso-de-strings-en-php)
    - [Operaciones comunes con strings](#operaciones-comunes-con-strings)
      - [Concatenación de strings](#concatenación-de-strings)
      - [Longitud de una string](#longitud-de-una-string)
      - [Contar el número de palabras](#contar-el-número-de-palabras)
      - [Reemplazar texto en una string](#reemplazar-texto-en-una-string)
      - [Convertir a mayúsculas o minúsculas](#convertir-a-mayúsculas-o-minúsculas)
      - [Substrings](#substrings)
      - [Encontrar la posición de una subcadena](#encontrar-la-posición-de-una-subcadena)
    - [Expresiones regulares en PHP](#expresiones-regulares-en-php)
      - [`preg_match()`: Comprobar si una string coincide con una expresión regular](#preg_match-comprobar-si-una-string-coincide-con-una-expresión-regular)
      - [`preg_replace()`: Reemplazar texto usando una expresión regular](#preg_replace-reemplazar-texto-usando-una-expresión-regular)
      - [`preg_split()`: Dividir una string en un array usando una expresión regular como delimitador](#preg_split-dividir-una-string-en-un-array-usando-una-expresión-regular-como-delimitador)
      - [`preg_match_all()`: Obtener todas las coincidencias de una expresión regular](#preg_match_all-obtener-todas-las-coincidencias-de-una-expresión-regular)

![logo](./images/01-logo.png)


### Tipos de Arrays


En PHP, los arrays son estructuras de datos que pueden contener múltiples valores bajo un único nombre de variable. PHP soporta arrays indexados numéricamente, arrays asociativos y arrays multidimensionales.

#### Arrays Indexados

Son arrays con índices numéricos. Los índices comienzan en 0 por defecto.

```php
$frutas = array("manzana", "naranja", "plátano");
echo $frutas[1]; // Imprime: naranja
```

#### Arrays Asociativos

Son similares a los diccionarios en otros lenguajes de programación. Tienen claves y valores, donde las claves son strings.

```php
$edades = array("Pedro" => 35, "Ana" => 23, "Carlos" => 47);
echo $edades["Ana"]; // Imprime: 23
```

#### Arrays Multidimensionales

Son arrays que contienen otros arrays como sus elementos.

```php
$autos = array(
    array("Volvo", 22, 18),
    array("BMW", 15, 13),
    array("Saab", 5, 2),
    array("Land Rover", 17, 15)
);

echo $autos[0][0]; // Imprime: Volvo
```

### Operaciones Comunes con Arrays

#### Recorrer Arrays

- `foreach`: La forma más común de recorrer arrays en PHP.

```php
foreach ($edades as $clave => $valor) {
    echo "La edad de $clave es $valor años.<br>";
}
```

- `for`: Se utiliza principalmente con arrays indexados.

```php
for ($i = 0; $i < count($frutas); $i++) {
    echo $frutas[$i] . "<br>";
}
```

#### Contar Elementos

- `count()`: Retorna el número de elementos en un array.

```php
echo count($frutas); // Imprime el número de frutas
```

#### Filtrar Arrays

- `array_filter()`: Filtra elementos de un array utilizando una función de callback.

```php
function esMayorDeEdad($edad) {
    return $edad >= 18;
}

$edadesFiltradas = array_filter($edades, "esMayorDeEdad");
print_r($edadesFiltradas);
```

#### Mapear Arrays

- `array_map()`: Aplica una función de callback a los elementos de un array.

```php
function cuadrado($num) {
    return $num * $num;
}

$numeros = array(1, 2, 3, 4, 5);
$numerosCuadrados = array_map("cuadrado", $numeros);
print_r($numerosCuadrados);
```

#### Reducir Arrays

- `array_reduce()`: Iterativamente reduce el array a un único valor utilizando una función de callback.

```php
function sumar($carry, $item) {
    $carry += $item;
    return $carry;
}

$numeros = array(1, 2, 3, 4, 5);
$suma = array_reduce($numeros, "sumar", 0);
echo $suma; // Imprime la suma de los números
```

#### Ordenar Arrays

- `sort()`: Ordena un array indexado en orden ascendente.
- `rsort()`: Ordena un array indexado en orden descendente.
- `asort()`: Ordena un array asociativo en orden ascendente, según el valor.
- `ksort()`: Ordena un array asociativo en orden ascendente, según la clave.
- `arsort()`: Ordena un array asociativo en orden descendente, según el valor.
- `krsort()`: Ordena un array asociativo en orden descendente, según la clave.

```php
sort($frutas);
asort($edades);
```

#### Combinar y Dividir Arrays

- `array_merge()`: Combina uno o más arrays.

```php
$array1 = array("color" => "rojo", 2, 4);
$array2 = array("a", "b", "color" => "verde", "forma" => "trapezoide", 4);
$resultado = array_merge($array1, $array2);
print_r($resultado);
```

- `array_slice()`: Extrae una porción de un array.

```php
$parte = array_slice($frutas, 1, 2); // Obtiene "naranja" y "plátano"
```

#### Comprobar si un Elemento o Clave Existe

- `in_array()`: Chequea si un valor existe en un array.
- `array_key_exists()`: Chequea si una clave existe en un array.

```php
if (in_array("manzana", $frutas)) {
    echo "Hay manzanas";
}

if (array_key_exists("Ana", $edades)) {
    echo "La edad de Ana es " . $edades["Ana"];
}
```

## Strings
En PHP, las strings son secuencias de caracteres que se pueden almacenar en variables. PHP ofrece una amplia gama de funciones para manipular strings, y aquí te mostraré algunas de las operaciones más importantes y cómo utilizarlas.

### Ejemplo de uso de strings en PHP

```php
<?php
$texto = "Hola, mundo!";
echo $texto; // Imprime: Hola, mundo!
?>
```

### Operaciones comunes con strings

#### Concatenación de strings

```php
$saludo = "Hola";
$nombre = "Juan";
$mensaje = $saludo . ", " . $nombre . "!";
echo $mensaje; // Imprime: Hola, Juan!
```

#### Longitud de una string

```php
$longitud = strlen($texto);
echo $longitud; // Imprime la longitud de $texto
```

#### Contar el número de palabras

```php
$num_palabras = str_word_count($texto);
echo $num_palabras; // Imprime el número de palabras en $texto
```

#### Reemplazar texto en una string

```php
$texto_nuevo = str_replace("mundo", "PHP", $texto);
echo $texto_nuevo; // Imprime: Hola, PHP!
```

#### Convertir a mayúsculas o minúsculas

```php
$mayusculas = strtoupper($texto);
echo $mayusculas; // Imprime el texto en mayúsculas

$minusculas = strtolower($texto);
echo $minusculas; // Imprime el texto en minúsculas
```

#### Substrings

```php
$extracto = substr($texto, 7, 5); // Empieza en el índice 7 y extrae 5 caracteres
echo $extracto; // Imprime: mundo
```

#### Encontrar la posición de una subcadena

```php
$posicion = strpos($texto, "mundo");
if ($posicion !== false) {
    echo "La palabra 'mundo' se encuentra en la posición: " . $posicion;
} else {
    echo "'mundo' no se encuentra en el texto.";
}
```

### Expresiones regulares en PHP

PHP utiliza las funciones `preg_*` para trabajar con expresiones regulares, que siguen la sintaxis de las expresiones regulares de Perl.

#### `preg_match()`: Comprobar si una string coincide con una expresión regular

```php
$patron = "/mundo/";
if (preg_match($patron, $texto)) {
    echo "'mundo' se encuentra en el texto.";
} else {
    echo "'mundo' no se encuentra en el texto.";
}
```

#### `preg_replace()`: Reemplazar texto usando una expresión regular

```php
$patron = "/mundo/";
$reemplazo = "PHP";
$texto_reemplazado = preg_replace($patron, $reemplazo, $texto);
echo $texto_reemplazado; // Imprime: Hola, PHP!
```

#### `preg_split()`: Dividir una string en un array usando una expresión regular como delimitador

```php
$patron = "/[\s,]+/"; // Espacios o comas
$palabras = preg_split($patron, $texto);
print_r($palabras); // Imprime un array con las palabras del texto
```

#### `preg_match_all()`: Obtener todas las coincidencias de una expresión regular

```php
$patron = "/[aeiou]/i"; // Buscar todas las vocales, mayúsculas o minúsculas
preg_match_all($patron, $texto, $coincidencias);
print_r($coincidencias); // Imprime todas las vocales encontradas
```

Estas son algunas de las operaciones más comunes y útiles que puedes realizar con strings y expresiones regulares en PHP. Para realizar tareas más complejas o específicas, puedes consultar la documentación oficial de PHP, que contiene una lista completa de funciones de strings y expresiones regulares disponibles.