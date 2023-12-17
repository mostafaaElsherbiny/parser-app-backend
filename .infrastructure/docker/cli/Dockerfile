# Use a lightweight PHP image for CLI
FROM php:8.1.1-cli

# Fix debconf warnings upon .build
ARG DEBIAN_FRONTEND=noninteractive

# Install required dependencies
RUN apt-get update && apt-get install -y \
    locales \
    librabbitmq-dev \
    libzip-dev \
    zip \
    unzip \
    p7zip-full \
    && docker-php-ext-install zip opcache mysqli pdo pdo_mysql

# Install Composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin && \
    composer --version

# Set working directory
WORKDIR "/application"

# Copy PHP configuration
COPY php.ini "$PHP_INI_DIR"/conf.d
