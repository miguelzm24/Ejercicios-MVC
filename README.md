docker-compose.yml
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
