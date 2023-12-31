# GET y POST
- [GET y POST](#get-y-post)
  - [GET y POST](#get-y-post-1)
    - [Método GET:](#método-get)
    - [Método POST:](#método-post)
    - [Consejos y mejores prácticas:](#consejos-y-mejores-prácticas)


![logo](./images/01-logo.png)


## GET y POST

En PHP, `GET` y `POST` son dos métodos comunes para enviar datos desde el cliente (por ejemplo, un navegador web) al servidor. Ambos métodos se utilizan para pasar información, pero tienen diferencias importantes en cuanto a cómo transmiten los datos y cuándo se deben usar.

### Método GET:

El método `GET` envía la información codificada en la URL, con un límite de longitud (dependiendo del navegador y del servidor, pero generalmente alrededor de 2000 caracteres). Es adecuado para solicitudes de búsqueda o cuando los datos no son sensibles, ya que la información se muestra en la URL y se puede guardar en el historial del navegador o en registros del servidor.

**Ejemplo de uso de GET en PHP:**

HTML (formulario.html):
```html
<form action="procesar_get.php" method="get">
  Nombre: <input type="text" name="nombre" />
  Edad: <input type="text" name="edad" />
  <input type="submit" value="Enviar" />
</form>
```

PHP (procesar_get.php):
```php
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
```

### Método POST:

El método `POST` envía la información a través del cuerpo de la solicitud HTTP, no en la URL, lo que significa que no hay límite de longitud y los datos no se muestran en la URL. Es más seguro que `GET` y se debe usar para enviar datos sensibles como contraseñas o información personal.

**Ejemplo de uso de POST en PHP:**

HTML (formulario.html):
```html
<form action="procesar_post.php" method="post">
  Nombre: <input type="text" name="nombre" />
  Edad: <input type="text" name="edad" />
  <input type="submit" value="Enviar" />
</form>
```

PHP (procesar_post.php):
```php
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
```

### Consejos y mejores prácticas:

1. **Validar y Sanitizar Entradas:** Siempre valida y sanitiza las entradas del usuario para prevenir ataques como inyección SQL o XSS. En los ejemplos, uso `htmlspecialchars()` para evitar la ejecución de HTML o JavaScript malintencionado.
   
2. **Uso Adecuado:** Utiliza `GET` para solicitudes que no afectan el estado del servidor (como buscar datos). Usa `POST` para operaciones que cambian el estado del servidor o envían datos sensibles.
   
3. **Datos Sensibles:** Nunca uses `GET` para enviar información confidencial ya que los datos se exponen en la URL y pueden ser almacenados en cachés o historiales.
   
4. **Límites de Datos:** Utiliza `POST` si necesitas enviar una gran cantidad de datos o archivos al servidor, ya que `GET` tiene limitaciones de longitud.

5. **Idempotencia:** Las solicitudes `GET` deben ser idempotentes, lo que significa que realizar la misma solicitud `GET` muchas veces obtendrá el mismo resultado sin causar efectos adicionales. Las solicitudes `POST` pueden no ser idempotentes, ya que pueden crear o cambiar recursos en el servidor cada vez que se envían.

Siguiendo estos consejos, podrás implementar formularios y solicitudes HTTP en PHP de manera segura y efectiva.
