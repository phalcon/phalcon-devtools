FROM mileschou/phalcon:5.5-alpine AS builder

WORKDIR /source

RUN apk add --no-cache git

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY composer.json ./composer.json
RUN composer install

COPY . .

RUN set -xe && \
        php -d phar.readonly=off vendor/bin/box build && \
        php phalcon.phar

FROM mileschou/phalcon:5.5-alpine

COPY --from=builder /source/phalcon.phar /usr/bin/phalcon

ENTRYPOINT ["sh", "-c", "/usr/bin/phalcon"]
