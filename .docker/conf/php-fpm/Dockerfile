FROM php:7.3-fpm-stretch

ARG USER
ARG USER_HOME_DIR

RUN apt-get update && apt-get install -y \
    openssl \
    git \
    unzip \
    libpcre3-dev \
    libxml2-dev \
    libjpeg62-turbo-dev \
    libmemcached-dev \
    apt-transport-https \
    libfreetype6-dev \
    libmcrypt-dev \
    zip unzip \
    wget \
    # install intl ICU (version 60.2), needed for symfony validation
    && curl -sS -o /tmp/icu.tar.gz -L http://download.icu-project.org/files/icu4c/60.2/icu4c-60_2-src.tgz \
    && tar -zxf /tmp/icu.tar.gz -C /tmp \
    && cd /tmp/icu/source \
    && ./configure --prefix=/usr/local \
    && make \
    && make install \
    # just to be certain things are cleaned up
    && rm -rf /tmp/icu*

RUN pecl install memcached \
    && docker-php-ext-enable memcached \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) iconv mcrypt zip pdo pdo_mysql mysqli gd soap

#RUN mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini \
RUN docker-php-ext-configure intl --with-icu-dir=/usr/local \
    && docker-php-ext-install intl \
    && docker-php-ext-configure opcache \
    && docker-php-ext-install opcache

## install AMQP extansion
RUN apt-get update && apt-get install -y \
        librabbitmq-dev \
        libssh-dev \
    && docker-php-ext-install \
        bcmath \
        sockets \
    && pecl install amqp \
    && docker-php-ext-enable amqp

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
&& composer --version


#RUN groupadd ${USER}
#RUN useradd -r -u 1000 -g ${USER} ${USER} -d ${USER_HOME_DIR}
RUN usermod -u 1000 www-data

EXPOSE 9000

#USER ${USER}
CMD ["php-fpm"]