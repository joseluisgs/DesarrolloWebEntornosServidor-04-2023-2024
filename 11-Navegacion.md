# Navegación
- [Navegación](#navegación)
  - [Navegación entre páginas](#navegación-entre-páginas)
    - [Navegación mediante enlaces:](#navegación-mediante-enlaces)
    - [Navegación mediante formularios:](#navegación-mediante-formularios)
    - [Navegación mediante redirecciones:](#navegación-mediante-redirecciones)



![logo](./images/01-logo.png)

## Navegación entre páginas
En PHP, hay varias formas de realizar la navegación entre páginas. A continuación, te mostraré algunos ejemplos de cómo puedes implementar la navegación utilizando enlaces, formularios y redirecciones.

### Navegación mediante enlaces:

Puedes utilizar enlaces HTML para navegar entre páginas. Aquí tienes un ejemplo:

```html
<!-- index.php -->
<a href="pagina1.php">Ir a página 1</a>
<a href="pagina2.php">Ir a página 2</a>
```

```html
<!-- pagina1.php -->
<a href="index.php">Volver a la página principal</a>
<a href="pagina2.php">Ir a página 2</a>
```

```html
<!-- pagina2.php -->
<a href="index.php">Volver a la página principal</a>
<a href="pagina1.php">Ir a página 1</a>
```

### Navegación mediante formularios:

También puedes utilizar formularios HTML para enviar datos y navegar entre páginas. Aquí tienes un ejemplo:

```html
<!-- index.php -->
<form action="pagina1.php" method="POST">
  <input type="submit" value="Ir a página 1">
</form>

<form action="pagina2.php" method="POST">
  <input type="submit" value="Ir a página 2">
</form>
```

```html
<!-- pagina1.php -->
<form action="index.php" method="POST">
  <input type="submit" value="Volver a la página principal">
</form>

<form action="pagina2.php" method="POST">
  <input type="submit" value="Ir a página 2">
</form>
```

```html
<!-- pagina2.php -->
<form action="index.php" method="POST">
  <input type="submit" value="Volver a la página principal">
</form>

<form action="pagina1.php" method="POST">
  <input type="submit" value="Ir a página 1">
</form>
```

### Navegación mediante redirecciones:

Puedes redirigir al usuario a otra página utilizando la función `header()` de PHP. Aquí tienes un ejemplo:

```php
// index.php
<?php
header("Location: pagina1.php");
exit;
?>
```

```php
// pagina1.php
<?php
header("Location: index.php");
exit;
?>
```

```php
// pagina2.php
<?php
header("Location: index.php");
exit;
?>
```

Al utilizar redirecciones, es importante asegurarse de que no haya salida de contenido antes de la llamada a `header()`, ya que esto podría causar errores. Además, después de una redirección, se recomienda utilizar `exit` o `die` para detener la ejecución del script y evitar que se siga procesando código innecesario.

Estos son solo algunos ejemplos básicos de cómo puedes realizar la navegación entre páginas en PHP. Puedes adaptar estos ejemplos según tus necesidades y requerimientos específicos.
