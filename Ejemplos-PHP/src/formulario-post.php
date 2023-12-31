<h2>Formulario:</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    Nombre: <input name="nombre" type="text"/>
    Edad: <input name="edad" type="text"/>
    <input type="submit" value="Enviar"/>
</form>

<?php
// Comprobar si los datos se han enviado a través de POST
if (isset($_POST['nombre']) && isset($_POST['edad'])) {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];

    // Hacer algo con los datos recibidos
    echo "Hola, tu nombre es " . htmlspecialchars($nombre) . " y tienes " . htmlspecialchars($edad) . " años.";
} else {
    echo "No se han recibido datos.";
}
?>
