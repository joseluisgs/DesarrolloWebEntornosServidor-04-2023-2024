<h2>Formulario:</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
    Nombre: <input name="nombre" type="text"/>
    Edad: <input name="edad" type="text"/>
    <input type="submit" value="Enviar"/>
</form>

<?php
// Comprobar si los datos se han enviado a través de GET
if (isset($_GET['nombre']) && isset($_GET['edad'])) {
    $nombre = $_GET['nombre'];
    $edad = $_GET['edad'];

    // Hacer algo con los datos recibidos
    echo "Hola, tu nombre es " . htmlspecialchars($nombre) . " y tienes " . htmlspecialchars($edad) . " años.";
} else {
    echo "No se han recibido datos.";
}
?>
