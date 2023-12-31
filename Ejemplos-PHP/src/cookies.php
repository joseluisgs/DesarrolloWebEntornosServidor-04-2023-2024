<?php

// Crear una cookie llamada mi curso con 24 horas de duración
setcookie('mi_curso', '2º DAW', time() + 24 * 60 * 60);

// Recuperar el valor de la cookie
echo $_COOKIE['mi_curso'];
echo '<br>';

// Eliminar la cookie
# setcookie('mi_curso', '', time() - 1000);

// Recuperar el valor de la cookie
echo $_COOKIE['mi_curso'];
echo '<br>';

?>
