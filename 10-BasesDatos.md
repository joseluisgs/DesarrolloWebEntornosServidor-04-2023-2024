# Bases de Datos

- [Bases de Datos](#bases-de-datos)
  - [Bases de Datos con PDO](#bases-de-datos-con-pdo)
    - [Instalación de PostgreSQL y Habilitación de PDO\_PGSQL](#instalación-de-postgresql-y-habilitación-de-pdo_pgsql)
    - [Conexión a PostgreSQL usando PDO](#conexión-a-postgresql-usando-pdo)
      - [Opciones de configuración](#opciones-de-configuración)
    - [CRUD Básico con PDO y PostgreSQL](#crud-básico-con-pdo-y-postgresql)
      - [Create (Crear)](#create-crear)
      - [Read (Leer)](#read-leer)
      - [Update (Actualizar)](#update-actualizar)
      - [Delete (Borrar)](#delete-borrar)
    - [Importancia de las Consultas Preparadas](#importancia-de-las-consultas-preparadas)
    - [Ventajas de usar PDO](#ventajas-de-usar-pdo)

![logo](./images/01-logo.png)


## Bases de Datos con PDO

PDO es una interfaz de acceso a bases de datos que ofrece una forma estándar para que los desarrolladores trabajen con bases de datos en PHP. Utilizando PDO con consultas preparadas, puedes mejorar la seguridad de tu aplicación al prevenir inyecciones SQL y también puede mejorar el rendimiento.

### Instalación de PostgreSQL y Habilitación de PDO_PGSQL

Antes de comenzar, asegúrate de que PostgreSQL esté instalado en tu servidor y que la extensión `pdo_pgsql` esté habilitada en tu archivo `php.ini`. Si no está habilitada, descomenta o añade la siguiente línea:

```ini
extension=pdo_pgsql.so
```

### Conexión a PostgreSQL usando PDO

Primero, debes establecer una conexión con la base de datos PostgreSQL usando PDO. 

Aquí tienes un ejemplo de cómo hacerlo:

```php
<?php
$host = '127.0.0.1';
$db   = 'nombre_de_tu_base_de_datos';
$user = 'tu_usuario';
$pass = 'tu_contraseña';
$port = "5432";
$charset = 'utf8';

$dsn = "pgsql:host=$host;port=$port;dbname=$db;user=$user;password=$pass";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
```

#### Opciones de configuración

PDO es una interfaz de acceso a bases de datos que ofrece una capa de abstracción para trabajar con diferentes motores de bases de datos en PHP. Este array de opciones se pasa generalmente al constructor de la clase PDO para configurar el comportamiento de la conexión a la base de datos.

Vamos a explicar cada una de las opciones:

1. `PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION`
   Esta opción configura el modo de reporte de errores. Al establecer `PDO::ERRMODE_EXCEPTION`, le dices a PDO que lance excepciones cuando ocurre un error. Esto es muy útil para el manejo de errores, ya que puedes atrapar las excepciones con bloques `try/catch` y manejar los errores de una manera más controlada en lugar de que el script falle silenciosamente o emita advertencias.

2. `PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC`
   Esta opción establece el modo de recuperación por defecto. Cuando realizas una consulta y obtienes los resultados, PDO puede devolver los datos en diferentes formatos. Al usar `PDO::FETCH_ASSOC`, le indicas a PDO que devuelva los resultados como un array asociativo. Esto significa que puedes acceder a los datos de las columnas por su nombre en lugar de por su índice numérico.

3. `PDO::ATTR_EMULATE_PREPARES => false`
   Esta opción indica a PDO si debe emular las sentencias preparadas. Las sentencias preparadas son una característica de seguridad y rendimiento que permite a la base de datos compilar y optimizar una consulta una sola vez, y luego ejecutarla múltiples veces con diferentes parámetros. Al establecer `false`, le estás diciendo a PDO que use las sentencias preparadas reales de la base de datos (si están disponibles) en lugar de emularlas. Esto puede mejorar el rendimiento y es más seguro en términos de inyección de SQL.

Estas son algunas de las opciones más comunes que se configuran al usar PDO, pero hay muchas otras disponibles que puedes utilizar para ajustar el comportamiento de PDO según tus necesidades. Algunas de estas opciones adicionales incluyen:

- `PDO::ATTR_PERSISTENT`: Esta opción puede ser usada para crear conexiones persistentes, lo que puede mejorar el rendimiento al reutilizar conexiones a la base de datos en lugar de abrir una nueva cada vez.
- `PDO::ATTR_TIMEOUT`: Configura el tiempo de espera para la conexión a la base de datos.
- `PDO::ATTR_AUTOCOMMIT`: Puede ser utilizado para activar o desactivar el auto-commit después de cada sentencia.
- `PDO::MYSQL_ATTR_USE_BUFFERED_QUERY`: Específico para MySQL, determina si se deben usar consultas en buffer.

Para usar estas opciones, simplemente las agregarías al array `$options` y las pasarías al constructor de PDO cuando creas una nueva instancia de conexión a la base de datos. Aquí hay un ejemplo de cómo se vería esto en código:

```php
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    // Otras opciones pueden ser añadidas aquí
];

$pdo = new PDO($dsn, $user, $password, $options);
```

En este ejemplo, `$dsn` es el Data Source Name que contiene la información necesaria para conectarse a la base de datos, `$user` es el nombre de usuario y `$password` es la contraseña.

### CRUD Básico con PDO y PostgreSQL

A continuación, te presento cómo realizar operaciones básicas de CRUD (Crear, Leer, Actualizar, Borrar) utilizando PDO.

#### Create (Crear)

Para insertar datos en PostgreSQL:

```php
try {
    $sql = "INSERT INTO usuarios (nombre, email) VALUES (:nombre, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nombre' => 'John Doe', 'email' => 'john@example.com']);
    echo "Nuevo usuario creado con éxito.";
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}
```

#### Read (Leer)

Para seleccionar y leer datos:

```php
try {
    $stmt = $pdo->query("SELECT * FROM usuarios");
    while ($row = $stmt->fetch()) {
        echo $row['nombre'] . "\n";
        echo $row['email'] . "\n";
    }
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}
```

#### Update (Actualizar)

Para actualizar datos:

```php
try {
    $sql = "UPDATE usuarios SET email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => 'newemail@example.com', 'id' => 1]);
    echo "Usuario actualizado con éxito.";
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}
```

#### Delete (Borrar)

Para borrar datos:

```php
try {
    $sql = "DELETE FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => 1]);
    echo "Usuario borrado con éxito.";
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}
```

### Importancia de las Consultas Preparadas

Las consultas preparadas son importantes por varias razones:

1. **Seguridad**: Las consultas preparadas ayudan a proteger tu aplicación contra ataques de inyección SQL, ya que los valores son vinculados como parámetros y no son parte de la consulta SQL directamente.

2. **Rendimiento**: Cuando se utiliza una consulta preparada, el servidor de bases de datos puede optimizar el plan de ejecución de la consulta, lo cual puede ser beneficioso si se ejecuta la misma consulta varias veces con diferentes parámetros.

3. **Mantenibilidad**: El código es más limpio y fácil de mantener cuando se utilizan consultas preparadas.

### Ventajas de usar PDO

- **Abstracción de la base de datos**: PDO proporciona una capa de abstracción para trabajar con diferentes sistemas de bases de datos. Si decides cambiar de PostgreSQL a otro sistema de bases de datos, el cambio será más sencillo.

- **Consistencia**: PDO ofrece una interfaz consistente para trabajar con diferentes bases de datos.

- **Orientado a objetos**: PDO es una extensión orientada a objetos, lo cual se adapta bien al desarrollo moderno de PHP.

Recuerda que este es un tutorial básico y que las operaciones de bases de datos en aplicaciones de producción deben ser manejadas con cuidado, especialmente en lo que respecta a la validación y saneamiento de entradas de usuario y el manejo de errores y transacciones.