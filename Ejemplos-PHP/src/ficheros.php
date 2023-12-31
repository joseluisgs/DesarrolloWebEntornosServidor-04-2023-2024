<?php
const UPLOAD_DIR = '/var/www/html/public/uploads/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se ha subido un archivo
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        $archivo = $_FILES['archivo'];

        // Obtener información del archivo
        $nombre = $archivo['name'];
        $tipo = $archivo['type'];
        $tmpPath = $archivo['tmp_name'];
        $error = $archivo['error'];

        // Verificar el tipo y la extensión del archivo
        $allowedTypes = ['image/jpeg', 'image/png'];
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $detectedType = finfo_file($fileInfo, $tmpPath);
        $extension = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));

        if (in_array($detectedType, $allowedTypes) && in_array($extension, $allowedExtensions)) {
            // Generar un nuevo nombre de archivo basado en la hora Unix
            $nuevoNombre = time() . '.' . $extension;

            // Ruta de destino donde se guardará el archivo
            $rutaDestino = UPLOAD_DIR . $nuevoNombre;

            // Mover el archivo a la ruta de destino con el nuevo nombre
            if (move_uploaded_file($tmpPath, $rutaDestino)) {
                echo "El archivo se ha subido y guardado correctamente.";
                echo "<br>";
                echo "<img src='uploads/$nuevoNombre' alt='Imagen subida'>";
                echo "<br>";
                // Ver la imagen con un enlace
                echo "<a href='uploads/$nuevoNombre' target='_blank'>Ver imagen</a>";
            } else {
                echo "Error al mover el archivo a la ruta de destino.";
            }
        } else {
            echo "Tipo o extensión de archivo no permitido.";
        }
    } else {
        echo "No se ha subido ningún archivo o ha ocurrido un error.";
    }
}
?>

<!-- Formulario HTML para subir el archivo -->
<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="archivo">
    <input type="submit" value="Subir archivo">
</form>

