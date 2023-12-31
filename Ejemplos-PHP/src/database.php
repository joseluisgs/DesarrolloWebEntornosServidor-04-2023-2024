<?php
$host = 'postgres-db'; // El nombre del servicio db en docker-compose.yml
$db = 'tienda';
$user = 'admin'; // Usuario por defecto para PostgreSQL
$pass = 'adminPassword123'; // Asegúrate de cambiarlo por tu contraseña real
$charset = 'utf8';

$dsn = "pgsql:host=$host;dbname=$db;"; // cadena de conexión
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // PDO lanzará excepciones en caso de error
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // PDO devolverá un array asociativo
    PDO::ATTR_EMULATE_PREPARES => false, // Desactiva emulación de consultas preparadas
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Conectado a la base de datos 'tienda'!<br>";

    $stmt = $pdo->query('SELECT * FROM productos');

    // Inicio de la tabla HTML
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>Marca</th>";
    echo "<th>Modelo</th>";
    echo "<th>Precio</th>";
    echo "<th>Stock</th>";
    echo "<th>Imagen</th>";
    echo "</tr>";

    // Iterar sobre cada fila de la base de datos y mostrarla en la tabla HTML
    while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['marca']) . "</td>";
        echo "<td>" . htmlspecialchars($row['modelo']) . "</td>";
        echo "<td>" . htmlspecialchars($row['precio']) . "</td>";
        echo "<td>" . htmlspecialchars($row['stock']) . "</td>";
        // Asumiendo que la columna 'imagen' contiene la URL de la imagen, se usa htmlspecialchars() para evitar XSS
        echo "<td><img src='" . htmlspecialchars($row['imagen']) . "' alt='Imagen del producto' style='width:100px;'/></td>";
        echo "</tr>";
    }

    // Fin de la tabla HTML
    echo "</table>";

} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
?>
