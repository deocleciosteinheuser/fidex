FROM php:8.2-fpm

WORKDIR /var/www/

RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    unzip \
    git \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copy the composer.json and composer.lock files to the container
# COPY composer.json composer.lock ./var/www/

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install project dependencies
# RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application code
COPY . /var/www/

# Generate the autoload files
# RUN composer dump-autoload --optimize

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY xdebug.ini /usr/local/etc/php/conf.d
# RUN echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
# && echo "xdebug.remote_autostart=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# insltar npm
# RUN apt-get update

# RUN apt-get install -y nodejs npm

# Expose port 80 for the web server
EXPOSE 8080


# Specify the command to run on container start
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
