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
