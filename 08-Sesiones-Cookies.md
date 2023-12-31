# Sesiones y Cookies
- [Sesiones y Cookies](#sesiones-y-cookies)
- [Sesiones](#sesiones)
    - [Crear una sesión:](#crear-una-sesión)
    - [Leer una sesión:](#leer-una-sesión)
    - [Cerrar una sesión:](#cerrar-una-sesión)
    - [Configurar el tiempo de espera (timeout):](#configurar-el-tiempo-de-espera-timeout)
    - [Destruir una sesión:](#destruir-una-sesión)
  - [Cookies](#cookies)

![logo](./images/01-logo.png)

# Sesiones
Una sesión en el contexto de PHP es un mecanismo que permite mantener y almacenar datos del usuario a lo largo de múltiples solicitudes o páginas web. Una sesión se crea cuando un usuario visita un sitio web y se destruye cuando el usuario cierra el navegador o cuando la sesión expira debido a un tiempo de espera.

Cuando un usuario inicia una sesión, PHP genera un identificador único llamado "ID de sesión". Este ID se utiliza para identificar de manera única la sesión del usuario y asociar los datos almacenados en la sesión con ese usuario específico.

El ID de sesión se puede transmitir de diferentes maneras, pero la forma más común es a través de una cookie en el navegador del usuario. Esta cookie contiene el ID de sesión y se envía automáticamente con cada solicitud al servidor, lo que permite que PHP recupere los datos de sesión correspondientes.

¡Claro! Aquí tienes un tutorial con ejemplos de uso de sesiones en PHP, que incluye la creación de una sesión, lectura de una sesión, cierre de sesión, configuración de tiempo de espera (timeout) y destrucción de una sesión.

### Crear una sesión:

```php
<?php
// Iniciar la sesión
session_start();

// Establecer variables de sesión
$_SESSION['usuario'] = 'JohnDoe';
$_SESSION['rol'] = 'admin';

echo 'Sesión creada con éxito.';
?>
```

### Leer una sesión:

```php
<?php
// Iniciar la sesión
session_start();

// Leer variables de sesión
$usuario = $_SESSION['usuario'];
$rol = $_SESSION['rol'];

echo 'Usuario: ' . $usuario . '<br>';
echo 'Rol: ' . $rol;
?>
```

### Cerrar una sesión:

```php
<?php
// Iniciar la sesión
session_start();

// Eliminar todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

echo 'Sesión cerrada con éxito.';
?>
```

### Configurar el tiempo de espera (timeout):

```php
<?php
// Iniciar la sesión
session_start();

// Establecer el tiempo de espera en segundos (por ejemplo, 30 minutos)
$tiempoEspera = 1800; // 30 minutos
$_SESSION['tiempoInicio'] = time();

// Verificar si ha pasado el tiempo de espera
if (isset($_SESSION['tiempoInicio']) && (time() - $_SESSION['tiempoInicio']) > $tiempoEspera) {
    // Cerrar la sesión
    session_unset();
    session_destroy();
    echo 'Sesión cerrada debido al tiempo de espera.';
} else {
    // Actualizar el tiempo de inicio
    $_SESSION['tiempoInicio'] = time();
    echo 'Sesión activa.';
}
?>
```

### Destruir una sesión:

```php
<?php
// Iniciar la sesión
session_start();

// Eliminar todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

echo 'Sesión destruida con éxito.';
?>
```

Recuerda que para utilizar sesiones en PHP, debes asegurarte de llamar a `session_start()` al inicio de cada archivo donde desees trabajar con las sesiones. Esto permite que PHP inicie o reanude la sesión existente.

Las sesiones en PHP son una forma conveniente de almacenar y mantener datos del usuario a través de diferentes páginas y solicitudes. Puedes almacenar cualquier tipo de datos en una sesión y acceder a ellos en cualquier momento mientras la sesión esté activa.

## Cookies
Una cookie es un pequeño archivo de texto que se almacena en el navegador del usuario cuando visita un sitio web. Las cookies se utilizan para almacenar información específica del usuario y se envían automáticamente con cada solicitud al servidor. Esto permite al sitio web recordar información sobre el usuario y proporcionar una experiencia personalizada.

En PHP, puedes crear y manipular cookies utilizando la función `setcookie()`. Esta función se utiliza para establecer una cookie con un nombre, un valor, y opcionalmente, otras propiedades como el tiempo de expiración, el dominio y la ruta.

Aquí tienes algunos ejemplos de uso de cookies en PHP:

1. Crear una cookie:

```php
<?php
// Establecer una cookie con nombre "miCookie" y valor "Hola, mundo!"
setcookie("miCookie", "Hola, mundo!");

echo "Cookie creada.";
?>
```

2. Leer una cookie:

```php
<?php
// Leer el valor de la cookie "miCookie"
$valor = $_COOKIE["miCookie"];

echo "Valor de la cookie: " . $valor;
?>
```

3. Establecer una cookie con tiempo de expiración:

```php
<?php
// Establecer una cookie que expira en 7 días
$expiracion = time() + (7 * 24 * 60 * 60); // 7 días
setcookie("miCookie", "Hola, mundo!", $expiracion);

echo "Cookie creada con tiempo de expiración.";
?>
```

4. Establecer una cookie con dominio y ruta específicos:

```php
<?php
// Establecer una cookie con dominio y ruta específicos
setcookie("miCookie", "Hola, mundo!", time() + 3600, "/ruta", "dominio.com");

echo "Cookie creada con dominio y ruta específicos.";
?>
```

5. Eliminar una cookie:

```php
<?php
// Establecer una cookie con tiempo de expiración en el pasado para eliminarla
setcookie("miCookie", "", time() - 3600);

echo "Cookie eliminada.";
?>
```

Es importante tener en cuenta que las cookies tienen algunas limitaciones en cuanto a su tamaño y cantidad. Cada navegador tiene un límite de almacenamiento de cookies, y un sitio web no puede leer las cookies establecidas por otros sitios web debido a las restricciones de seguridad del mismo origen (same-origin policy).

Además, es esencial tener en cuenta la privacidad y seguridad al utilizar cookies. Almacenar información sensible en una cookie puede ser un riesgo de seguridad, por lo que se recomienda evitar almacenar datos confidenciales en ellas.

En resumen, una cookie es un archivo de texto almacenado en el navegador del usuario que se utiliza para almacenar información específica del usuario. En PHP, puedes crear, leer y eliminar cookies utilizando la función `setcookie()`. Las cookies son útiles para recordar información sobre el usuario y proporcionar una experiencia personalizada en un sitio web.