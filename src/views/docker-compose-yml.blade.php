version: '3'

services:
  app:
    build: ./
    restart: always
    volumes:
      - .././:/app
    depends_on:
      - database
      {{ $redis ? '- redis' : '' }}

  queue:
    build: ./
    command: 'php artisan queue:listen'
    restart: always
    volumes:
      - .././:/app
    depends_on:
      - database
      {{ $redis ? '- redis' : '' }}

  scheduler:
    build: ./
    command: 'while true; do php artisan schedule:run; sleep 60; done'
    restart: always
    volumes:
      - .././:/app
    depends_on:
      - database
      {{ $redis ? '- redis' : '' }}

  nginx:
    image: nginx
    restart: always
    volumes:
      - .././:/app
      - ./nginx.conf:/etc/nginx/conf.d/default.conf
    depends_on:
      - app
    ports:
      - "80:80"

@if ($mysql)
  database:
    image: mysql:8
    restart: always
    environment:
      - "MYSQL_RANDOM_ROOT_PASSWORD=1"
      - "MYSQL_ROOT_PASSWORD=${DB_ROOT_PASSWORD:-}"
      - "MYSQL_DATABASE=${DB_DATABASE}"
      - "MYSQL_USER=${DB_USERNAME}"
      - "MYSQL_PASSWORD=${DB_PASSWORD}"
    command:
      - "--default-authentication-plugin=mysql_native_password"
    volumes:
     - dotto_mysql:/var/lib/mysql
@endif

@if ($redis)
  redis:
    image: redis
    volumes:
     - dotto_redis:/data
@endif

volumes:
  dotto_mysql:
  dotto_redis:
