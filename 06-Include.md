# Include y Require

- [Include y Require](#include-y-require)
  - [Include y Require](#include-y-require-1)
    - [`include` vs `require`:](#include-vs-require)
    - [`include_once` y `require_once`:](#include_once-y-require_once)
    - [Ejemplos de uso:](#ejemplos-de-uso)
    - [Consejos para decidir cuándo usar cada uno:](#consejos-para-decidir-cuándo-usar-cada-uno)

![logo](./images/01-logo.png)


## Include y Require
En PHP, `include` y `require` son dos construcciones que te permiten insertar el contenido de un archivo PHP en otro archivo PHP antes de que el servidor ejecute el script. Esto es útil para reutilizar código, como funciones, clases, o simplemente bloques de HTML en múltiples páginas de tu sitio web. Las versiones "_once" de estas instrucciones (`include_once` y `require_once`) se comportan de manera similar, pero con una comprobación adicional para evitar la inclusión múltiple del mismo archivo.

### `include` vs `require`:

**include:**
- Si el archivo no se encuentra, `include` emite una advertencia (`E_WARNING`), pero el script seguirá ejecutándose.
- Es útil cuando el archivo incluido no es esencial para que el script se ejecute, por ejemplo, elementos de la plantilla como cabeceras, pies de página, etc.

**require:**
- Si el archivo no se encuentra, `require` emite un error (`E_COMPILE_ERROR`) y detiene la ejecución del script.
- Se utiliza cuando el archivo es esencial para la ejecución del script, como archivos de configuración, bibliotecas de funciones o clases.

### `include_once` y `require_once`:

**include_once:**
- Funciona igual que `include`, pero si el archivo ya ha sido incluido anteriormente, no se incluirá de nuevo.
- Previene problemas de redeclaración de funciones, clases o reasignación de valores a variables.

**require_once:**
- Funciona igual que `require`, pero si el archivo ya ha sido requerido anteriormente, no se requerirá de nuevo.
- Es útil para incluir archivos críticos como archivos de configuración o bibliotecas de clases, asegurándote de que solo se incluyen una vez.

### Ejemplos de uso:

**include:**
```php
// Incluir un archivo de plantilla
include 'header.php';

// El script seguirá ejecutándose incluso si header.php no existe
echo "El resto del script.";
```

**require:**
```php
// Incluir un archivo de configuración
require 'config.php';

// Si config.php no existe, el script se detendrá aquí y mostrará un error fatal
echo "El resto del script.";
```

**include_once:**
```php
// Incluir un archivo con funciones
include_once 'library.php';

// Aunque library.php sea incluido de nuevo más adelante, no causará errores
// de funciones ya definidas.
```

**require_once:**
```php
// Incluir un archivo esencial
require_once 'important-library.php';

// Asegura que el archivo se incluya solo una vez, evitando errores fatales
// si el archivo es esencial para el resto del script.
```

### Consejos para decidir cuándo usar cada uno:

- Usa `require` cuando el archivo es esencial para el funcionamiento de tu aplicación (por ejemplo, un archivo de configuración o una biblioteca de funciones críticas).
- Usa `include` cuando el archivo es un complemento, como una plantilla de vista o un archivo de idioma que no es esencial para el funcionamiento de la aplicación.
- Usa las versiones "_once" para evitar la inclusión múltiple del mismo archivo, lo que puede causar errores de "función ya definida" o "clase ya definida".

En resumen, `include` y `require` son para casos en los que la inclusión del archivo es opcional o esencial, respectivamente, mientras que `include_once` y `require_once` son para evitar problemas causados por incluir el mismo archivo más de una vez en el flujo de ejecución del script.