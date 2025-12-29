FROM php:8.4.5-fpm-bullseye

ARG TARGETPLATFORM
ARG BUILDPLATFORM
ARG COMPOSER_VERSION=2.6.4

RUN echo "Running on $BUILDPLATFORM, building for $TARGETPLATFORM"

WORKDIR /var/www

# Install dependencies and PHP extensions
RUN apt-get update && apt-get install -y --no-install-recommends \
        git unzip libzip-dev libpng-dev \
    && docker-php-ext-install bcmath gd pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Copy project
COPY ../../../.. /var/www

# Fix permissions
RUN mkdir -p /var/www/.composer \
    && usermod -u 1000 www-data \
    && usermod -a -G www-data root \
    && chown -R www-data:www-data /var/www /var/www/.composer \
    && chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Install Composer
RUN curl -sSL https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=${COMPOSER_VERSION}
ENV PATH="/var/www/vendor/bin:$PATH"

# Switch to www-data to run composer
USER www-data

# Run composer install
RUN composer install --no-dev --optimize-autoloader --no-interaction --working-dir=/var/www

# Switch back to root
USER root

RUN sed -i 's|;error_log = log/fpm.log|error_log = /proc/self/fd/2|' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's|;catch_workers_output = yes|catch_workers_output = yes|' /usr/local/etc/php-fpm.d/www.conf

EXPOSE 9000
CMD ["php-fpm", "-F"]
