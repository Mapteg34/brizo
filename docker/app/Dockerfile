FROM php:fpm

ARG UID
ARG GUID
ARG TZ

ENV UID "${UID}"
ENV GUID "${GUID}"
ENV TZ "${TZ}"

RUN usermod -u $UID www-data && groupmod -g $GUID www-data
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN chown www-data:www-data /var/www -R

RUN apt-get update --fix-missing && DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends apt-utils

# external packages
RUN DEBIAN_FRONTEND=noninteractive apt-get install -y \
    # for memcached
    zlib1g-dev \
    libmemcached-dev \
    libmemcachedutil2 \
    # for xdebug
    git \
    # for composer
    unzip \
;

# pdo_pgsql
RUN docker-php-ext-install -j$(nproc) pdo_mysql

# memcached
RUN pecl install memcached && \
    docker-php-ext-enable memcached

# opcache
RUN docker-php-ext-install opcache

# xdebug
RUN git clone git://github.com/xdebug/xdebug.git /tmp/xdebug && \
    cd /tmp/xdebug && \
    phpize && \
    ./configure --enable-xdebug && \
    make -j$(nproc)&& \
    make install && \
    docker-php-ext-enable xdebug && \
    touch /var/log/xdebug_remote.log && \
    chown www-data:www-data /var/log/xdebug_remote.log && \
    cd / && \
    rm -Rf /tmp/xdebug

# use mailer !
RUN    echo "#!/bin/sh\n/bin/true" > /usr/bin/fake_mail.sh \
    && chmod +x /usr/bin/fake_mail.sh \
    && echo "sendmail_path = /usr/bin/fake_mail.sh" > /usr/local/etc/php/conf.d/mail.ini

# zip
RUN apt-get install -y --no-install-recommends libzip-dev && \
    docker-php-ext-install zip

# composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

# clean
RUN rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/app
