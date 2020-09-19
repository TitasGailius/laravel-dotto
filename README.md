#### Work In Progress

# Laravel Dotto

Dotto is a very simple yet highly optimized Laravel development environment powered by Docker.

<p align="center">
    <img width="450" src="./images/dotto.png" alt="Dotto">
</p>

# Installation

Install Dotto with composer:

```bash
composer require titasgailius/laravel-dotto --dev
```

# Usage

Dotto automatically discovers, configures and starts the services required for your Laravel application.


```bash
php artisan dotto
```

# Enter Container

You may interact with the application container on the command line:

```bash
php artisan dotto:enter
```

# Laravel Tinker

You may interact with your entire Laravel application on the command line:

```bash
php artisan dotto:tinker
```

# Logs

You may watch your application logs:

```bash
php artisan dotto:logs
```

---

# Configuration

You may customize Dotto setup by publishing the `Dotto.yml` configuration file.


```bash
php artisan dotto:publish
```

### Database

You may override what database(s) are used by your application.

```yml
databases:
    - database-1
    - database-2
```

:round_pushpin: Each value is a database connection name, defined in your `config/database.php` file. <br>
:round_pushpin: By default, the `host` of a database is the same as connection name.

### Cache

You may override what cache backend(s) are used in your application.

```yml
caches:
    - redis
    - memcached
```

Currently supported cache backends: `redis`, `memchached`.

### Queues

You may override what queue backend(s) are used in your application.

```yml
queues:
    - redis
    - beanstalkd
```

Currently supported queue backends: `redis`, `beabstalkd`.

### Extending

You may extend the `docker-compose.yml` & `Dockerfile` files.

```yml
extend:
    docker-compose: docker-compose.yml
    dockerfile: Dockerfile
```

Then, you may add any new services or install additional dependencies for your application:

```Dockerfile
# Dockerfile
RUN docker-php-ext-install pcntl
```

```yml
# docker-compose.yml
services:
    redis:
        image: "redis:alpine"
```
