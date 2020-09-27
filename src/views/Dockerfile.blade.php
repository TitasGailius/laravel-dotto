#
# Build PHP-FPM
#
FROM php:7.3-fpm

WORKDIR /app

# Install PHP dependencies
RUN apt-get update -y && apt-get install -y libxml2-dev
RUN docker-php-ext-install pdo pdo_mysql mbstring opcache tokenizer xml ctype json bcmath pcntl

@if ($redis)
# Install PhpRedis
RUN pecl install redis \
    && docker-php-ext-enable redis \
    &&  rm -rf /tmp/pear
@endif

{!! $slot !!}
