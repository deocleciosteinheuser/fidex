FROM php:8.2-fpm

WORKDIR /var/www/

RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install zip pdo_mysql



# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the composer.json and composer.lock files to the container
COPY composer.json composer.lock ./

# Install project dependencies
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application code
COPY . .

# Generate the autoload files
RUN composer dump-autoload --optimize

# Expose port 80 for the web server
EXPOSE 80

# Specify the command to run on container start
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
