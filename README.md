docker-compose.yml:
~~~
services:
  # nginx
  web:
    container_name: web
    image: nginx:latest
    ports:
      - '8080:80'
    links:
      - 'php'      
    volumes:
      - ./src:/var/www/html
      - ./default.conf:/etc/nginx/conf.d/default.conf
    depends_on:
      - php

  # PHP
  php:
    container_name: php
    build:
      dockerfile: Dockerfile-php
      context: .
    volumes:
      - ./src:/var/www/html
    depends_on:
      - mariadb

  # MariaDB Service
  mariadb:
    container_name: db
    image: mariadb:10.9
    ports:
      - '8306:3306'    
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: mydatabase
    volumes:
      - './mysqldata:/var/lib/mysql'

  # Adminer
  adminer:
    image: adminer:latest
    container_name: adminer
    environment:
      ADMINER_DEFAULT_SERVER: db
    restart: always
    ports:
      - 7777:8080  

# Volumes
volumes:
  mysqldata:
~~~
Dockerfile-php:
~~~
FROM php:8.1-fpm

# Installing dependencies for the PHP modules
RUN apt-get update && \
    apt-get install -y zip curl libcurl3-dev libzip-dev libpng-dev libonig-dev libxml2-dev
    # libonig-dev is needed for oniguruma which is needed for mbstring

# Installing additional PHP modules
RUN docker-php-ext-install curl gd mbstring mysqli pdo pdo_mysql xml

# Install Composer so it's available
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
~~~
default.conf:
~~~
server {
    listen 80;
    listen [::]:80;    
    
    index index.php index.html;
    server_name localhost;
    
    error_log  /var/log/nginx/error.log;
    access_log /var/log/nginx/access.log;
    
    root /var/www/html;
    
    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass php:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }
}
~~~
