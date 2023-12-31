<?php

trait Saludar
{
    public function saludar()
    {
        echo "Hola";
    }
}

$coche = new Coche("rojo", "Seat");
echo $coche->describir();
echo "<br />";

// Visibilidad

trait Despedirse
{
    public function despedirse()
    {
        echo "Adiós";
    }
}

$ejemplo = new Ejemplo();
echo $ejemplo->publico; // Funciona
echo "<br />";


// Herencia

interface Encendible
{
    public function encender();
}

interface Prendible
{
    public function prender();
}

$moto = new Moto();
echo $moto->ruedas; // Imprime: 2
$moto->arrancar(); // Imprime: Arrancando el vehículo
echo "<br />";

// Polimorfismo

class Coche
{
    public $color;
    public $marca;

    public function __construct($color, $marca)
    {
        $this->color = $color;
        $this->marca = $marca;
    }

    public function describir()
    {
        return "Este coche es un " . $this->marca . " de color " . $this->color;
    }
}

class Ejemplo
{
    public $publico = 'Público';
    protected $protegido = 'Protegido';
    private $privado = 'Privado';

    function imprimir()
    {
        echo $this->publico;
        echo $this->protegido;
        echo $this->privado;
    }
}

function sonidoAnimal(Animal $animal)
{
    $animal->hacerSonido();
}

$animal = new Animal();
$perro = new Perro();

sonidoAnimal($animal); // Imprime: Algún sonido
echo "<br />";
sonidoAnimal($perro); // Imprime: Guau
echo "<br />";

class Vehiculo
{
    public $ruedas = 4;

    public function arrancar()
    {
        echo "Arrancando el vehículo";
    }
}

class Moto extends Vehiculo
{
    public $ruedas = 2;
}

class Animal
{
    public function hacerSonido()
    {
        echo "Algún sonido";
    }
}


class Perro extends Animal
{
    public function hacerSonido()
    {
        echo "Guau";
    }
}

class Bombilla implements Encendible
{
    public function encender()
    {
        echo "Bombilla encendida";
    }
}

class Persona
{
    use Saludar, Despedirse;
}

$persona = new Persona();
$persona->saludar(); // Imprime: Hola
echo "<br />";
$persona->despedirse(); // Imprime: Adiós
echo "<br />";

// Clases abstractas
abstract class Animal2
{
    public $nombre;

    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    abstract public function hacerSonido();
}

class Perro2 extends Animal2
{
    public function hacerSonido()
    {
        echo "Guau";
    }
}

$perro2 = new Perro2("Toby");
echo $perro2->nombre; // Imprime: Toby
echo "<br />";

// Clases anónimas
$animal3 = new class("Toby") extends Animal2 {
    public function hacerSonido()
    {
        echo "Guau";
    }
};

echo $animal3->nombre; // Imprime: Toby
echo "<br />";

// Métodos mágicos
class Persona2
{
    public $nombre;

    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}

$persona2 = new Persona2("Juan");
echo $persona2; // Imprime: Juan
echo "<br />";
echo $persona2->nombre; // Imprime: Juan
echo "<br />";

// Clonar objetos
class Persona3
{
    public $nombre;

    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    public function __clone()
    {
        $this->nombre = "Copia de " . $this->nombre;
    }
}

$persona3 = new Persona3("Juan");

$persona4 = clone $persona3;

echo $persona3->nombre; // Imprime: Juan
echo "<br />";

echo $persona4->nombre; // Imprime: Copia de Juan
echo "<br />";

// Serializar objetos
class Persona4
{
    public $nombre;

    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    public function __sleep()
    {
        return ["nombre"];
    }

    public function __wakeup()
    {
        $this->nombre = "Copia de " . $this->nombre;
    }
}

// Namespace
/*namespace Example;

class Persona5
{
    public $nombre;

    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }
}

$persona5 = new Persona5("Juan");
echo $persona5->nombre; // Imprime: Juan
echo "<br />";

*/
