FROM php:8.4.5-fpm-bullseye

ARG TARGETPLATFORM
ARG BUILDPLATFORM

RUN echo "Running on $BUILDPLATFORM, building for $TARGETPLATFORM"

WORKDIR "/var/www"

RUN apt-get update; \
    apt-get -y --no-install-recommends install \
        git \
        unzip \
        libzip-dev \
        libpng-dev

RUN docker-php-ext-install bcmath gd pdo_mysql zip

RUN apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

COPY .. /var/www

EXPOSE 9000

CMD ["php-fpm"]
