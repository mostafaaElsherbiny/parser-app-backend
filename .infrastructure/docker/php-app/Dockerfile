FROM php:8.1-fpm as local

# Fix debconf warnings upon .build
ARG DEBIAN_FRONTEND=noninteractive
ARG env

RUN apt-get update && apt-get install -y \
    libfreetype6-dev  \
    libjpeg62-turbo-dev  \
    libpng-dev \
    librabbitmq-dev \
    p7zip-full \
    libxslt-dev \
    libzip-dev \
    zip \
    unzip \
    chromium \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*\
    && pecl install amqp \
    && docker-php-ext-enable amqp \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install zip mysqli pdo pdo_mysql opcache xsl gd

# Install PHP Redis extension
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin && \
    echo "alias composer='COMPOSER_MEMORY_LIMIT=-1 composer'" >> /root/.bashrc && \
    composer

COPY .infrastructure/docker/php-app/${env}/opcache.ini "$PHP_INI_DIR"/conf.d
COPY .infrastructure/docker/php-app/${env}/php.ini "$PHP_INI_DIR"/conf.d

WORKDIR "/application"




FROM local as prod

COPY . .
RUN chown -R www-data:www-data .
