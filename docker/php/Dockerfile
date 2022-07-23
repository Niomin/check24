FROM php:8.1-fpm-alpine

ARG TIMEZONE

RUN ln -s /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone \
    && echo "date.timezone = ${TIMEZONE}" > /usr/local/etc/php/conf.d/timezone.ini

RUN apk --update upgrade && \
    apk add --update --no-cache \
            curl openssh-client bash libzip-dev freetype-dev autoconf make g++ \
    && docker-php-ext-install -j$(nproc)\
        opcache zip

RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN echo "xdebug.mode=debug,develop" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=trigger" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.output_dir=/spool/www/buyout/var/log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=127.0.0.1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.log='/tmp/xdebug.log'" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

COPY php.ini /usr/local/etc/php/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /www