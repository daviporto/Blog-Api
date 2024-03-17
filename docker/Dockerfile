FROM phpdockerio/php:8.2-fpm
WORKDIR "/var/www"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff

# Install git
#RUN apt update \
#    && apt -y install git \
#    && apt clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
#
## Instala Biblioteca PDF
#RUN apt update \
#    && apt install wkhtmltopdf \
#    && apt clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install selected extensions and other stuff
RUN apt update \
&& apt -y install \
        php8.2-cli \
        php8.2-curl \
        php8.2-mbstring \
        php8.2-opcache \
        php8.2-readline \
        php8.2-pdo \
        php8.2-mysql \
        php8.2-xml \
        php8.2-zip \
        php8.2-xdebug
    && apt -y php8.2-fpm
    && apt clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

EXPOSE 9001
