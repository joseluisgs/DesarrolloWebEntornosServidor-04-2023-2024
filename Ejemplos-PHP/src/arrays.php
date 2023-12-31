<?php

// Ejemplos de array
$colores = ["rojo", "verde", "azul"];
$persona = ["nombre" => "Juan", "edad" => 18];

// Ejemplos de bucles
foreach ($colores as $color) {
    echo $color;
    echo "<br />";
}

foreach ($persona as $clave => $valor) {
    echo $clave . ": " . $valor;
    echo "<br />";
}

// Contar elementos de un array
echo count($colores);
echo "<br />";

// filtrar elementos de un array
$coloresFiltrados = array_filter($colores, function ($color) {
    return $color != "rojo";
});

foreach ($coloresFiltrados as $color) {
    echo $color;
    echo "<br />";
}

// Ordenar elementos de un array
sort($colores);

foreach ($colores as $color) {
    echo $color;
    echo "<br />";
}

// Ordenar elementos de un array asociativo
ksort($persona);

foreach ($persona as $clave => $valor) {
    echo $clave . ": " . $valor;
    echo "<br />";
}

// Mapear elementos de un array
$coloresMapeados = array_map(function ($color) {
    return strtoupper($color);
}, $colores);

foreach ($coloresMapeados as $color) {
    echo $color;
    echo "<br />";
}

// Reducir elementos de un array
$suma = array_reduce($colores, function ($acumulador, $color) {
    return $acumulador + strlen($color);
}, 0);

echo $suma;

// Strings y operaciones con strings
$nombre = "Juan";
$apellido = "García";

// Concatenar strings
$nombreCompleto = $nombre . " " . $apellido;

echo $nombreCompleto;
echo "<br />";

// Interpolación de variables
echo "Hola $nombreCompleto";
echo "<br />";

// Interpolación de expresiones
echo "Hola {$nombre} {$apellido}";
echo "<br />";

// Obtener longitud de un string
echo strlen($nombreCompleto);
echo "<br />";

// Obtener posición de un string
echo strpos($nombreCompleto, "García");
echo "<br />";

// Obtener parte de un string
echo substr($nombreCompleto, 5, 6);
echo "<br />";

// Reemplazar parte de un string
echo str_replace("García", "Gómez", $nombreCompleto);
echo "<br />";

// Convertir a mayúsculas
echo strtoupper($nombreCompleto);
echo "<br />";

// Convertir a minúsculas
echo strtolower($nombreCompleto);
echo "<br />";

// Eliminar espacios en blanco
echo trim("   Hola   ");
echo "<br />";

// Eliminar caracteres
echo trim("Hola", "a");
echo "<br />";

// Comprobar si un string está vacío
echo empty("");
echo "<br />";

// Comprobar si un string está vacío
echo empty("Hola");

// Ejemplo de expresiones regulares
$nombre = "Juan";
$apellido = "García";

// Comprobar si un string coincide con una expresión regular
echo preg_match("/^J/", $nombre);
echo "<br />";

// Dividir un string en un array por un delimitador (split)
$nombreCompleto = "Juan García";
$nombreCompletoArray = explode(" ", $nombreCompleto);

foreach ($nombreCompletoArray as $nombre) {
    echo $nombre;
    echo "<br />";
}

// Unir un array en un string por una expresión regular
$patron = "/[\s,]+/"; // Espacios o comas
$texto = "Hola, me llamo Juan";
$palabras = preg_split($patron, $texto);
print_r($palabras); // Imprime un array con las palabras del texto
echo "<br />";

$patron = "/[aeiou]/i"; // Buscar todas las vocales, mayúsculas o minúsculas
preg_match_all($patron, $texto, $coincidencias);
print_r($coincidencias); // Imprime todas las vocales encontradas
echo "<br />";