FROM debian:bookworm-slim

ARG PHP_VERSION=${PHP_VERSION:-7.4}

ENV PATH=/root/composer/vendor/bin:/app/vendor/bin:/app/bin:/app:${PATH} \
    PHP_VERSION=${PHP_VERSION}

LABEL description="Docker image to build Phalcon on Debian Bookworm" \
      maintainer="Phalcon Team <team@phalconphp.com>" \
      vendor=Phalcon \
      name="com.phalconphp.images.build.bookworm-${PHP_VERSION}"

# Installing php and extentions
RUN set -eux \
    && apt-get update \
    && apt-get install --no-install-recommends -yq \
        mc nano git wget curl zip unzip htop re2c ca-certificates lsb-release \
    && curl -sSLo /tmp/debsuryorg-archive-keyring.deb https://packages.sury.org/debsuryorg-archive-keyring.deb \
    && dpkg -i /tmp/debsuryorg-archive-keyring.deb \
    && echo "deb [signed-by=/usr/share/keyrings/deb.sury.org-php.gpg] https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list \
    && apt-get update \
    && apt-get install --no-install-recommends -yq \
        php${PHP_VERSION}-cli \
        php${PHP_VERSION}-fpm \
        php${PHP_VERSION}-dev \
        php${PHP_VERSION}-common \
        php${PHP_VERSION}-curl \
        php${PHP_VERSION}-gettext \
        php${PHP_VERSION}-intl \
        php${PHP_VERSION}-mbstring \
        php${PHP_VERSION}-mysqli \
        php${PHP_VERSION}-opcache \
        php${PHP_VERSION}-pdo_* \
        php${PHP_VERSION}-pgsql \
        php${PHP_VERSION}-shmop \
        php${PHP_VERSION}-xml \
        php${PHP_VERSION}-xml \
        php${PHP_VERSION}-zip \
        php${PHP_VERSION}-psr \
        php${PHP_VERSION}-phalcon5 \
    && apt-get autoremove --purge -y \
    && apt-get autoclean -y \
    && apt-get clean -y \
    && rm -rf /tmp/* /var/tmp/* \
    && find /var/cache/apt/archives /var/lib/apt/lists -not -name lock -type f -delete \
    && find /var/cache -type f -delete \
    && find /var/log -type f | while read f; do echo -n '' > ${f}; done

# Editing www.conf
RUN echo "#!/bin/sh\nexit 0" > /usr/sbin/policy-rc.d \
    && sed -i -e "s/^;clear_env = no$/clear_env = no/" /etc/php/${PHP_VERSION}/fpm/pool.d/www.conf \
    && sed -i -e "/listen = .*/c\listen = [::]:8000" /etc/php/${PHP_VERSION}/fpm/pool.d/www.conf

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /app

EXPOSE 8000

ENTRYPOINT ["/bin/bash", "-c", "/usr/sbin/php-fpm${PHP_VERSION} --nodaemonize --fpm-config=/etc/php/${PHP_VERSION}/fpm/pool.d/www.conf"]
