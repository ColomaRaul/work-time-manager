FROM php:8.3-fpm-alpine

COPY conf.d /usr/local/etc/php/conf.d
COPY php.ini /usr/local/etc/php/conf.d/docker-php-config.ini

RUN apk --update upgrade \
        && apk add --no-cache acl fcgi file gettext gnu-libiconv supervisor autoconf automake make gcc g++ git bash rabbitmq-c rabbitmq-c-dev linux-headers \
        $PHPIZE_DEPS icu-dev libzip-dev zlib-dev postgresql-dev

RUN pecl install apcu-5.1.23 amqp-2.1.1 xdebug-3.3.0 \
    && docker-php-ext-enable apcu amqp opcache xdebug

RUN docker-php-ext-configure zip \
    && docker-php-ext-install -j$(nproc) intl zip pdo_pgsql

RUN mkdir -p /srv/app/var/cache /srv/app/var/log &&	\
    setfacl -R -m u:www-data:rwX -m u:"$(whoami)":rwX /srv/app/var && \
	setfacl -dR -m u:www-data:rwX -m u:"$(whoami)":rwX /srv/app/var

WORKDIR /var/www/html

RUN mkdir -p /opt/home
RUN chmod 777 /opt/home
ENV HOME /opt/home

CMD ["supervisord", "-n", "-c", "/etc/supervisord.conf"]
