<?php
$valor = 2;

if ($valor == 1) {
    echo "El valor es 1";
} elseif ($valor == 2) {
    echo "El valor es 2";
} else {
    echo "El valor no es ni 1 ni 2";
}

echo "<br />";

switch ($valor) {
    case 1:
        echo "El valor es 1";
        break;
    case 2:
        echo "El valor es 2";
        break;
    default:
        echo "El valor no es ni 1 ni 2";
        break;
}

echo "<br />";

$valor = 1;

while ($valor <= 10) {
    echo $valor;
    echo "<br />";
    $valor++;
}

echo "<br />";

$valor = 1;

do {
    echo $valor;
    echo "<br />";
    $valor++;
} while ($valor <= 10);

for ($i = 1; $i <= 10; $i++) {
    echo $i;
    echo "<br />";
}

$valor = 1;

$lista = [1, 2, 3, 4, 5, 6, 7, 8, 9];

foreach ($lista as $valor) {
    echo $valor;
    echo "<br />";
}

// Clave y valor
$lista = [
    'clave1' => 1,
    'clave2' => 2,
    'clave3' => 3,
    'clave4' => 4,
    'clave5' => 5,
    'clave6' => 6,
    'clave7' => 7,
    'clave8' => 8,
    'clave9' => 9,
];

foreach ($lista as $clave => $valor) {
    echo "$clave => $valor";
    echo "<br />";
}
