FROM php:8.1-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://phar.phpunit.de/phpunit-9.phar -o /usr/local/bin/phpunit && chmod +x /usr/local/bin/phpunit

WORKDIR /var/www/html

EXPOSE 80
