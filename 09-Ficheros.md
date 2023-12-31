# Ficheros
- [Ficheros](#ficheros)
  - [Ficheros](#ficheros-1)

![logo](./images/01-logo.png)

## Ficheros
Debe estar On la variable file_uploads en php.ini.
En php.ini también se encuentra la variable upload_tmp_dir, que indica el directorio donde se dirigirán los archivos cuando se suban. 

El tamaño máximo viene indicado en el mismo archivo de configuración por upload_max_filesize. 

Para ver estos valores se puede utilizar ini_get('upload_tmp_dir') e ini_get('upload_max_filesize'). upload_tmp_dir sólo es manipulable desde el php.ini o httpf.conf, upload_max_filesize puede también desde .htaccess o un user.ini (tienen modo PHP_INI_SYSTEM y PHP_INI_PERDIR respectivamente).

Es necesario que los permisos tanto del directorio temporal como del directorio final sean de escritura.
Para que un formulario tenga la capacidad de aceptar archivos se añade el atributo enctype="multipart/form-data" al elemento form.

```php
<?php
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
            $rutaDestino = '/ruta/donde/guardar/' . $nuevoNombre;

            // Mover el archivo a la ruta de destino con el nuevo nombre
            if (move_uploaded_file($tmpPath, $rutaDestino)) {
                echo "El archivo se ha subido y guardado correctamente.";
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
```

Si todo está bien configurado en base a nuestro docker de desarrollo podrás ver las subidas en: `http://localhost:8080/uploads/1703500942.jpeg`