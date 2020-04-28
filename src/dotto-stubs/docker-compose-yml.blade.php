version: '3'

services:
  app:
    build: ./
    restart: always
    volumes:
      - ./:/app
    depends_on:
      - database
      - redis

  queue:
    build: ./
    command: 'if [$APP_ENV == "local"]; then php artisan queue:listen; else php artisan queue:work; fi'
    restart: always
    volumes:
      - ./:/app
    depends_on:
      - database
      - redis

  scheduler:
    build: ./
    command: 'while true; do php artisan schedule:run; sleep 60; done'
    restart: always
    volumes:
      - ./:/app
    depends_on:
      - database
      - redis

  nginx:
    image: nginx
    restart: always
    volumes:
      - ./:/app
      - ./nginx.conf:/etc/nginx/conf.d/default.conf
    depends_on:
      - app
    ports:
      - "80:80"

  @include('dotto::mysql-service-yml')

  redis:
    image: redis
    volumes:
     - dotto_redis:/data

volumes:
  dotto_mysql:
  dotto_redis:
