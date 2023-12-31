# Almacenamiento

- [Almacenamiento](#almacenamiento)
  - [Manejo del almacenamiento](#manejo-del-almacenamiento)
    - [Disco público](#disco-público)
    - [Subir ficheros](#subir-ficheros)


![logo](./images/01-laravel.png)

## Manejo del almacenamiento
Para manejar el [almacenamiento](https://laravel.com/docs/10.x/filesystem) en Laravel, puedes seguir los siguientes pasos:

1. Configuración del sistema de archivos: Laravel utiliza un sistema de archivos para almacenar los archivos. Puedes configurar el sistema de archivos en el archivo `config/filesystems.php`. Aquí puedes definir diferentes discos de almacenamiento, como el disco local o discos en la nube como Amazon S3.

### Disco público
El disco público incluido en el archivo de configuración de sistemas de archivos de tu aplicación está destinado a archivos que van a ser accesibles públicamente. Por defecto, el disco público utiliza el controlador local y almacena sus archivos en storage/app/public.

Para hacer que estos archivos sean accesibles desde la web, debes crear un enlace simbólico desde public/storage a storage/app/public. Utilizar esta convención de carpetas mantendrá tus archivos accesibles públicamente en un directorio que se puede compartir fácilmente en implementaciones utilizando sistemas de implementación sin tiempo de inactividad como Envoyer.

Para crear el enlace simbólico, puedes utilizar el comando Artisan`storage:link`:
```bash
artisan storage:link
```

Una vez que se haya almacenado un archivo y se haya creado el enlace simbólico, puedes crear una URL hacia los archivos utilizando el ayudante asset:
`asset('storage/file.txt');`

### Subir ficheros
Para subir archivos en Laravel, puedes utilizar la clase `Illuminate\Http\Request` para obtener el archivo enviado desde un formulario. Puedes utilizar el método `store` o `storeAs` en la instancia del archivo para almacenarlo en el disco configurado. Por ejemplo:

```php
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

public function uploadFile(Request $request)
{
    // Guardamos la imagen en el disco storage/app/public/products
    $producto->imagen = $imagen->storeAs('productos', $fileToSave, 'public');
}
```

En este ejemplo, el archivo se almacena en la carpeta `carpeta_destino` dentro del disco configurado.

1. Eliminar archivos: Para eliminar archivos, puedes utilizar el método `delete` en la clase `Storage`, pasando la ruta del archivo a eliminar. Por ejemplo:

```php
use Illuminate\Support\Facades\Storage;

public function deleteFile($filePath)
{
    Storage::delete($filePath);
}
```

4. Mostrar archivos desde las vistas: Para mostrar archivos almacenados en Laravel, puedes utilizar la función `asset` para generar la URL del archivo. Por ejemplo:

```php
<img src="{{ asset('ruta_del_archivo') }}" alt="Archivo">
 <img alt="Imagen del producto" class="img-fluid" src="{{ asset('storage/' . $producto->imagen) }}">
```

En este ejemplo, `ruta_del_archivo` es la ruta relativa al archivo almacenado.

5. Enlazar archivos: Si deseas enlazar archivos en tus vistas para que los usuarios puedan descargarlos, puedes utilizar la función `asset` para generar la URL del archivo y luego crear un enlace utilizando la etiqueta `<a>`. Por ejemplo:

```php
<a href="{{ asset('ruta_del_archivo') }}">Descargar archivo</a>
<a href="{{ asset('storage/' . $producto->imagen) }}">Descargar archivo</a>
```
En este caso, `ruta_del_archivo` es la ruta relativa al archivo almacenado.

