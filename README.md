# Befit

- Aplicación para control Usuarios y mensualidades en gimnasio Befit Morelia Michoacan

# Requerimientos

- Git `~> 2.42.0`
- Docker `~> 24.0.5`
- Docker Compose `~> 2.20.2`

La creación de la base de datos como la ejecución del proyecto en modo desarrollo se realiza con los comandos para docker `docker-compose up -d` para lo cual es importante tener docker instalado en su version de escritorio para Windows, Mac o Linux y el motor de docker junto con docker compose para su facilidad de uso en la construcción de los contenedores

## Uso de docker

Comandos básicos:

- `docker-compose up -d`: Crear y enciende los contenedores de los servicios y los mantiene corriendo en segundo plano.
- `docker-compose down`: Elimina los contenedores de los servicios, si se agrega la bandera `-v`, va a eliminar los volúmenes. Los volúmenes es donde se almacena la información de la base de datos y el cache de los servicios.
- `docker-compose start`: Enciende los contenedores de los servicios.
- `docker-compose stop`: Apaga los contenedores de los servicios.
- `docker-compose restart`: Reinicia los contenedores de los servicios.
- `docker-compose logs -f`: Muestra los logs de los servicios, se puede visualizar los logs de un servicio en individual si agrego el nombre del servicio después de la bandera `-f`.
- `docker-compose exec [NOMBRE DEL SERVICIO] [COMANDO]`: Ejecuta un comando dentro de los contenedores de un servicio.

## Comandos útiles

- `docker-compose exec laravel composer run-script reset-db`: Esto volverá a ejecutar todas la migraciones y las semillas
- `for d in $(ls -d ./tests/Feature/*/); do php artisan test --without-tty --stop-on-failure $d; if (( $? != 0 )); then break; fi; done`: Ejecuta las pruebas
