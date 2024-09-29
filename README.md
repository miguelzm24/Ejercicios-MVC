docker-compose.yml:
~~~
services:
  web:
    image: nginx:latest
    ports:
      - "8080:80"
    volumes:
      - ./php:/var/www/html
      - ./default.conf:/etc/nginx/conf.d/default.conf
    links:
      - php-fpm

  php-fpm:
    image: php:8-fpm
    volumes:
      - ./php:/var/www/html
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