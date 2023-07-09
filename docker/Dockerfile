FROM phpdockerio/php:8.2-fpm
WORKDIR "/var/www"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff

# Install git
RUN apt update \
    && apt -y install git \
    && apt clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Instala Biblioteca PDF
RUN apt update \
    && apt install wkhtmltopdf \
    && apt clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install selected extensions and other stuff
RUN apt update \
&& apt -y install \
        php8.2-apcu \
        php8.2-apcu-bc \
        php8.2-cli \
        php8.2-curl \
        php8.2-json \
        php8.2-mbstring \
        php8.2-opcache \
        php8.2-readline \
        php8.2-xml \
        php8.2-zip \
    && apt -y php8.2-fpm \
    && apt clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN apt update -y
RUN apt install -y php-xdebug php-mysql

EXPOSE 9001
