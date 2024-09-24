FROM php:8.3-fpm

MAINTAINER David Garcia <me@davidgarcia.cat>

# Check installed version
# ~~~~~~~~~~~~~~~~~~~~~~~

RUN php -v

# Install dependencies for PHP
# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~

RUN apt-get update
RUN apt-get install -y openssl git unzip iputils-ping telnet

# Download and install Composer
# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer --version

# Enable PHP ZIP Extension
# ~~~~~~~~~~~~~~~~~~~~~~~~

RUN apt-get install -y zip unzip libzip-dev

RUN docker-php-ext-install zip

# Enable PHP OPCache Extension
# ~~~~~~~~~~~~~~~~~~~~~~~~~~~~

RUN docker-php-ext-install opcache

# Enable PHP XDebug Extension
# ~~~~~~~~~~~~~~~~~~~~~~~~~~~

RUN #pecl install xdebug-2.9.8
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.idekey=\"PHPSTORM\"" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_port=9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
