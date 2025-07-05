FROM adrianturnes/steamexplorer-builder:8.4-1.0

ARG TARGETPLATFORM
ARG BUILDPLATFORM
ARG HOVERFLY_VERSION=1.11.2

RUN echo "Running on $BUILDPLATFORM, building for PLATFORM"

RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

RUN ARCH=$(echo "$TARGETPLATFORM" | cut -d'/' -f2) && curl -sSL "https://github.com/SpectoLabs/hoverfly/releases/download/v${HOVERFLY_VERSION}/hoverfly_bundle_linux_$ARCH.zip" -o hoverfly.zip && \
    unzip -q hoverfly.zip -d hoverfly && \
    mv hoverfly/hoverfly /usr/local/bin && \
    mv hoverfly/hoverctl /usr/local/bin && \
    rm -rf hoverfly hoverfly.zip

COPY rootfs /

WORKDIR /tmp

RUN mv /usr/local/etc/ssl/private/hoverfly.key.dist /usr/local/etc/ssl/private/hoverfly.key && \
    chmod 0600 /usr/local/etc/ssl/private/hoverfly.key && \
    chmod 0700 /usr/local/etc/ssl/private && \
    update-ca-certificates

WORKDIR /var/www
