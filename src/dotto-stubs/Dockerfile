#
# Install Composer Dependencies
#
FROM composer:1.7 as vendor

WORKDIR /app

COPY database/ database/
COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --no-dev \
    --prefer-dist

COPY . .
RUN composer dump-autoload

#
# Build Frontend Assets
#
FROM node:8.11 as frontend

WORKDIR /app

COPY artisan package.json package-lock.json webpack.mix.js ./

RUN npm install

COPY resources/js ./resources/js
COPY resources/sass ./resources/sass

RUN npm run production

#
# Build PHP-FPM
#
FROM php:7.3-fpm

WORKDIR /app

# Install PHP dependencies
RUN apt-get update -y && apt-get install -y libxml2-dev
RUN docker-php-ext-install pdo pdo_mysql mbstring opcache tokenizer xml ctype json bcmath pcntl

# Install PhpRedis
RUN pecl install redis \
    && docker-php-ext-enable redis \
    &&  rm -rf /tmp/pear

# Copy Frontend build
COPY --chown=www-data:www-data --from=frontend /app/public/js/ ./public/js/
COPY --chown=www-data:www-data --from=frontend /app/public/css/ ./public/css/

# Uncomment this line if you have "mix.version()" setup in your "webpack.mix.js" file.
# COPY --chown=www-data:www-data --from=frontend /app/public/mix-manifest.json ./public/mix-manifest.json

# Copy Composer dependencies
COPY --chown=www-data:www-data --from=vendor /app/vendor/ ./vendor/
COPY --chown=www-data:www-data . .

RUN php artisan config:cache

# Uncomment the line below if you would like to enable route caching. This can greatly improve
# performance but you need to make sure that your application does not use Closure routes.

# RUN php artisan route:cache
