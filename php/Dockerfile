FROM php:8.3-fpm

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

# Install Vim
RUN apt install -y vim    

WORKDIR /var/www/

# Copiando o php.ini para a localização correta
RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN wget https://get.symfony.com/cli/installer -O - | bash
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN echo "PATH=\"\$HOME/.symfony5/bin:\$PATH\"" >> ~/.bashrc
RUN export PATH="$HOME/.symfony5/bin:$PATH"
RUN git config --global user.email "jonaspoli@gmail.com" \ 
    && git config --global user.name "Jonas Poli"
