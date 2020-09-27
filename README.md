# Laravel Dotto

Dotto is a very simple yet highly optimized Laravel development environment setup powered by Docker.

<p align="center">
    <img width="450" src="./images/dotto.png" alt="Dotto">
</p>

# Installation

Install Dotto with composer:

```bash
composer require titasgailius/laravel-dotto --dev
```

# Usage

Dotto automatically discovers, configures and starts the services required by your Laravel application.

```bash
php artisan dotto
```

## Enter Container

You may interact with the application container on the command line:

```bash
php artisan dotto:enter
```

## Laravel Tinker

You may interact with your entire Laravel application on the command line:

```bash
php artisan dotto:tinker
```

## Logs

You may watch your application logs:

```bash
php artisan dotto:logs
```

---

## Configuration

You may customize the Dotto setup by publishing the `Dotto.yml` configuration file.

```bash
php artisan dotto:publish
```

### Database

Dotto automatically detects your default database connection and starts the appropriate services.
Of course, You may override what database connection(s) are used by your application.

```yml
databases:
  - database-1
  - database-2
```

:round_pushpin: By default, Dotto uses the database credentials defined in your `config/database.php` configuration file. <br>
:round_pushpin: The `host` of a database is the same as connection name.

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

You may instruct Dotto to merge the existing `docker-compose.yml` and `Dockerfile` files by running Dotto with the `--m` option (or `--merge`).

```bash
php artisan dotto --m
```

Additionally, you may call the `mergeDockerCompose` or `mergeDockerfile` methods in your `AppServiceProvider` to
instruct Dotto to merge these files by default.

```php
<?php

namespace App\Providers;

use TitasGailius\Dotto\Facades\Dotto;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Dotto::mergeDockerfile();
        Dotto::mergeDockerCompose();
    }
  }
```

Then, you may simply use your regular `docker-compose.yml` and `Dockerfile` files to add any new services or install additional PHP dependencies.

```yml
# dotto-compose.yml
version: '3'

services:
  your-service-name:
    image: "hello-world"
```

```Dockerfile
# Dockerfile
RUN docker-php-ext-install pcntl

...
```
