# Control de flujo en PHP

- [Control de flujo en PHP](#control-de-flujo-en-php)
  - [Condicionales](#condicionales)
  - [Bucles](#bucles)
    - [Bucles indefinidos](#bucles-indefinidos)
    - [Bucles definidos](#bucles-definidos)


![logo](./images/01-logo.png)



## Condicionales
El condicional en PHP se basa en el `if-else`

```php
<?php
    if (condicion) {
        // Código a ejecutar si la condición es verdadera
    } else {
        // Código a ejecutar si la condición es falsa
    }
?>
```

También podemos usar el operador ternario:

```php
<?php
    $resultado = (condicion) ? "verdadero" : "falso";

    // Equivalente a:
    if (condicion) {
        $resultado = "verdadero";
    } else {
        $resultado = "falso";
    }
?>
```

También podemos usar switch
  
```php
<?php
  switch (condicion) {
      case 1:
          // Código a ejecutar si la condición es 1
          break;
      case 2:
          // Código a ejecutar si la condición es 2
          break;
      default:
          // Código a ejecutar si la condición no es ninguna de las anteriores
  }
?>
```

## Bucles

### Bucles indefinidos
Podemos hacer uso de `while` y `do-while`.

```php
<?php
    while (condicion) {
        // Código a ejecutar mientras la condición sea verdadera
    }

    do {
        // Código a ejecutar mientras la condición sea verdadera
    } while (condicion);

?>
```

### Bucles definidos
Podemos hacer uso de `for` y `foreach`.

```php
<?php
    for ($i = 0; $i < 10; $i++) {
        // Código a ejecutar mientras la condición sea verdadera
    }

    foreach ($array as $valor) {
        // Código a ejecutar mientras la condición sea verdadera
    }

    foreach ($array as $clave => $valor) {
        // Código a ejecutar mientras la condición sea verdadera
    }
?>
```