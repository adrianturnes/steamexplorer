FROM adrianturnes/http-skelleton-builder:8.4-1.1

ARG TARGETPLATFORM
ARG BUILDPLATFORM

RUN echo "Running on $BUILDPLATFORM, building for $TARGETPLATFORM"

RUN pecl install xdebug && \
    docker-php-ext-enable xdebug
