#
# Install Composer Dependencies
#
FROM composer:1.7 as vendor

WORKDIR /app

{{--
# It is not ideal that the "database" directory is copied over
# but it is required for the composer to work properly.
COPY database/ database/
 --}}

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

COPY artisan package.json {{ $config->lockFile() }} webpack.mix.js ./

RUN {{ $config->nodeManager() }} install

@foreach ($config->assets() as $asset)
COPY {{ $asset }} ./{{ $asset }}
@endforeach

RUN {{ $config->nodeManager() }} run production

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

# Copy frontend build
COPY --chown=www-data:www-data --from=frontend /app/public/ ./public/

# Copy composer dependencies
COPY --chown=www-data:www-data --from=vendor /app/vendor/ ./vendor/

# Copy application code.
COPY --chown=www-data:www-data . .

@if ($config->cacheRoutes())
RUN php artisan route:cache
@endif
