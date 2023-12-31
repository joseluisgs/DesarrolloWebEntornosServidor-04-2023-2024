<?php
echo "Hola 2ºDAW! <br>";
print "Hola 2ºDAW! <br>";

// Comentarios
// Comentario de una línea

# Comentario de una línea

/*
 * Comentario de varias líneas
 */

// Variables
$nombre = "Juan";
$edad = 18; // int

// Constantes
const PI = 3.1416;
const NOMBRE = "Juan";

// Tipos de datos
// Enteros
$edad2 = 18; // int

// Decimales
$precio = 18.95; // float

// Cadenas de texto
$nombre2 = "Juan"; // string

// Booleanos
$esMayorEdad = true; // bool

// Arrays
$colores = array("rojo", "verde", "azul");
$colores[0] = "rojo";
// Sintaxis alternativa
$colores = ["rojo", "verde", "azul"];
$colores[0] = "rojo";

// Diccionarios (arrays asociativos)
$persona = array("nombre" => "Juan", "edad" => 18);
$persona["nombre"] = "Juan";
// Sintaxis alternativa
$persona = ["nombre" => "Juan", "edad" => 18];

// Operadores aritméticos
// Suma
$suma = 2 + 2;
// Resta
$resta = 2 - 2;
// Multiplicación
$multiplicacion = 2 * 2;
// División
$division = 2 / 2;
// Módulo
$modulo = 2 % 2;
// Incremento
$incremento = 2;
$incremento++;
// Decremento
$decremento = 2;
$decremento--;
// Potencia
$potencia = 2 ** 2;

// Operadores lógicos
// Igualdad
$igualdad = 2 == 2;
// Desigualdad
$desigualdad = 2 != 2;
// Mayor que
$mayorQue = 2 > 2;
// Mayor o igual que
$mayorIgualQue = 2 >= 2;
// Menor que
$menorQue = 2 < 2;
// Menor o igual que
$menorIgualQue = 2 <= 2;
// Y
$y = true && true;
// O
$o = true || false;
// Negación
$negacion = !true;

// función sin argumentos
function miFuncion()
{
    echo "Hola 2ºDAW!";
}

// función con argumentos
function miFuncion1($arg1, $arg2)
{
    echo "Hola 2ºDAW! $arg1 $arg2";
}

// función con argumentos y valor de retorno
function miFuncion2($arg1, $arg2)
{
    return $arg1 + $arg2;
}

// función con argumentos y valor de retorno opcional

/**
 * Ejermplo de función con argumentos y valor de retorno opcional
 * @param $arg1 Valor 1
 * @param $arg2 Valor 2
 * @return mixed|void Valor de retorno
 */
function miFuncion3($arg1, $arg2)
{
    if ($arg1 == 0) {
        return;
    }
    return $arg1 + $arg2;
}

