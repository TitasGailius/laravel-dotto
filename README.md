#### Work In Progress

# Laravel Dotto

Laravel Dotto is a very simple yet highly optimized docker setup for your Laravel application.

<p align="center">
    <img width="450" src="./images/dotto.png" alt="Dotto">
</p>

# Usage

Everything is automated...

```bash
php artisan dotto:up
```

... and Dotto will launch your application.

# How It Works?

Dotto automatically discovers what services your application requires and nicely bundles docker-compose services for you.

# Logs

If you would like to tail your application logs, simply run:

```bash
php artisan dotto:logs
```

<!-- # Stack

- Nginx
- PHP 7.3
- MySQL 8.0
- Redis
- Queues
- Scheduler

# Features

- Build
    - **Fast builds**- multi-stage docker setup is highly optimised for caching.
    - **Simple**- Only 3 files are required to run the entire setup.
    - Uses **PHP 7.3** to install your composer dependencies.
    - Uses **Yarn** with **NodeJS 13** to build your frontend assets.
- Local Development
    - Queue workers always run the latest code (no need to manually restart anything).
    - Laravel scheduler always runs the latest code.
- Production
    - Routes, views and configuration files are cached.
    - Queues are setup for maximum performance.
    - Uses PhpRedis pecl extension for maximum performance.

# Installation

Require Dotto as a composer dependency.

```bash
composer require titasgailius/laravel-dotto --dev
```

Publish docker files:

```bash
php artisan dotto:install
```

This command will publish 3 files for your docker setup: `Dockerfile`, `docker-compose.yml` and `nginx.conf`

# Usage

Start the application with docker-compose.

```bash
docker-compose up
```

# Configuration

#### Development
For the best development experience, set `APP_ENV=local` in your `.env` file when developing locally.

#### Laravel Mix: Versioning / Cache Busting

If your application uses [Versioning / Cache Busting](https://laravel.com/docs/7.x/mix#versioning-and-cache-busting), you will need to
uncomment the line below in your `Dockerfile` file:

```Dockerfile
...

# Uncomment this line if you have "mix.version()" setup in your "webpack.mix.js" file.
# COPY --chown=www-data:www-data --from=frontend /app/public/mix-manifest.json ./public/mix-manifest.json

...
```

#### Frontend build

If you use apllication uses other than default `js`, `sass` asset directories, make sure that the correct files are copied during the build stage:

```Dockerfile
...

RUN yarn install

COPY resources/js ./resources/js
COPY resources/sass ./resources/sass

RUN yarn production

...
```

#### TailwindCSS users

If you use TailwindCSS in your Laravel application, you will need to make sure that the `tailwind.config.js` file is copied to the image during a build stage:

```Dockerfile
#
# Build Frontend Assets
#
FROM node:8.11 as frontend

WORKDIR /app

COPY artisan package.json webpack.mix.js yarn.lock tailwind.config.js ./

...
```

#### MySQL

Database **name**, **username** and **password** is configured using environment variables from your `.env` file:
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`

You may also change the **root password**.
- On the initiail run add: `DB_ROOT_PASSWORD=secret docker-compose up`

---

:round_pushpin: **If you have already built the mysql image and want to change the credentials, the easiest option is to start over by destroying the mysql volume:**

```bash
# Stop the containers
docker-compose down

# List volumes to find the mysql volume
docker volume ls

## Destroy the appropriate mysql volume
docker volume rm laravel_dotto_mysql

# Set a new password in .env file
DB_PASSWORD=secret

# Start the containers back up
docker-compose up
```
 -->

