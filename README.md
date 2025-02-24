# Proyecto PHP con Arquitectura Hexagonal y Doctrine

Este proyecto es una aplicación PHP que sigue la arquitectura hexagonal, utilizando Doctrine como ORM y sin frameworks adicionales.

## Requisitos

* Docker instalado y configurado.

## Instalación

1.  Clona este repositorio.
2.  Navega al directorio del proyecto.
3.  Ejecuta el script de inicialización:

    ```bash
    ./init.sh
    ```

    Este script se encargará de configurar el entorno Docker, instalar las dependencias, preparar la base de datos MySQL y otras configuraciones necesarias.

## Configuración de la base de datos

Este proyecto utiliza MySQL como base de datos. La configuración de la conexión se encuentra en el archivo `config/doctrine.php`. El script `init.sh` se encarga de configurar las variables de entorno necesarias para la conexión.

## Ejecución de pruebas unitarias

Después de ejecutar el script de inicialización, puedes correr las pruebas unitarias con el siguiente comando:

```bash
./test.sh
```

## Autor

* Harold Rondon
* haroldcordero64@gmail.com

## Licencia

Este proyecto está bajo la licencia [MIT](https://www.google.com/url?sa=E&source=gmail&q=https://www.google.com/url?sa=E%26source=gmail%26q=LICENSE).
