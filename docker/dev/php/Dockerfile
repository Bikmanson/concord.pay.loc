FROM php:7.4-fpm

# Update and install modules for php and other
RUN apt update && apt install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        nano \
    && apt install -y wget zip unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql \
    && docker-php-ext-install mysqli \
    && apt install -y libxml2-dev

#Install mysql client
RUN apt install -y default-mysql-client

#Install xdebug
RUN pecl install xdebug-2.9.1 && docker-php-ext-enable xdebug

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install git
RUN apt install -y git

# Install phpunit
RUN wget https://phar.phpunit.de/phpunit-6.5.phar && \
        chmod +x phpunit-6.5.phar && \
        mv phpunit-6.5.phar /usr/local/bin/phpunit

# Install codecept
RUN wget http://codeception.com/codecept.phar && \
        chmod +x codecept.phar && \
        mv codecept.phar /usr/local/bin/codecept

ADD php.ini /usr/local/etc/php/php.ini

WORKDIR /app

CMD ["php-fpm"]
