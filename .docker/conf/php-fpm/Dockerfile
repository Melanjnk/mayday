FROM composer:latest AS composer
FROM php:7.3-fpm-stretch

ARG USER_ID
ARG GROUP_ID

RUN apt-get update && apt-get install -y \
    openssl \
    git \
    unzip \
    libpcre3-dev \
    # install intl ICU (version 60.2), needed for symfony validation
    && curl -sS -o /tmp/icu.tar.gz -L http://download.icu-project.org/files/icu4c/60.2/icu4c-60_2-src.tgz \
    && tar -zxf /tmp/icu.tar.gz -C /tmp \
    && cd /tmp/icu/source \
    && ./configure --prefix=/usr/local \
    && make \
    && make install \
    # just to be certain things are cleaned up
    && rm -rf /tmp/icu*

# install AMQP extansion
RUN apt-get update && apt-get install -y \
        librabbitmq-dev \
        libssh-dev \
    && docker-php-ext-install \
        bcmath \
        sockets \
    && pecl install amqp \
    && docker-php-ext-enable amqp

RUN mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini \
    && docker-php-ext-configure intl --with-icu-dir=/usr/local \
    && docker-php-ext-install intl \
    && docker-php-ext-configure opcache \
    && docker-php-ext-install opcache

COPY --from=composer /usr/bin/composer /usr/bin/composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
#&& composer --version

RUN docker-php-ext-install pdo pdo_mysql

#RUN usermod -u 1000 www-data
RUN usermod -u ${USER_ID} www-data && groupmod -g ${GROUP_ID} www-data

EXPOSE 9000

USER "${USER_ID}:${GROUP_ID}"

CMD ["php-fpm"]