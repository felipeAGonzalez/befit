# Utiliza la imagen oficial de PHP desde Docker Hub como base
FROM php:latest

RUN docker-php-ext-install pdo_mysql

# Copia tu código PHP al directorio de trabajo en el contenedor
COPY . /var/www/html

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Expone el puerto 80 para que puedas acceder a la aplicación web
EXPOSE 80

# Comando para ejecutar el servidor web (por ejemplo, PHP Built-in Server)
CMD ["php", "-S", "0.0.0.0:80"]
