FROM ubuntu:22.04


ENV DEBIAN_FRONTEND noninteractive
ENV DEBCONF_NONINTERACTIVE_SEEN true

RUN apt update \
    && apt-get install -y zip unzip git
RUN apt-get install -y php8.1-cli php8.1-dev \
    && apt -y install zip php8.1-gd
# RUN docker-php-ext-install pdo_mysql imap xml soap zip gd


# Copia tu código PHP al directorio de trabajo en el contenedor
COPY . /var/www/html

# Establece el directorio de trabajo
WORKDIR /var/www/html

COPY --from=composer:2.2.0 /usr/bin/composer /usr/bin/composer

# Expone el puerto 80 para que puedas acceder a la aplicación web
EXPOSE 80

# Comando para ejecutar el servidor web (por ejemplo, PHP Built-in Server)
CMD ["php", "-S", "0.0.0.0:80"]
