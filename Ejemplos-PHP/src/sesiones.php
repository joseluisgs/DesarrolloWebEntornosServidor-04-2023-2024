<?php

// Ejemplo de uso de sesiones

// Iniciar sesión
session_start();

// Almacenar el curso de 2º DAW en una variable de sesión
$_SESSION['curso'] = '2º DAW';

// Almacenar el nombre de un alumno en una variable de sesión
$_SESSION['alumno'] = 'Juan';

// recuperar el valor de la variable de sesión 'curso'
echo $_SESSION['curso'];
echo '<br>';

// eliminar la variable de sesión 'curso'
unset($_SESSION['curso']);

// Eliminar todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();
?>