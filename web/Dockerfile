#FROM php:7.4-apache
#COPY . /var/www/html
#WORKDIR /var/www/html
#EXPOSE 80
#CMD [ "php", "./your-script.php" ]

FROM ubuntu/apache2:latest

RUN apt-get update
RUN apt install -y php libapache2-mod-php
ENV TZ="America/Argentina/Buenos_Aires"
#RUN rm /etc/apt/preferences.d/no-debian-php
RUN apt-get install -y php-mysqli php-curl curl wget ffmpeg at php-ldap pdo_mysql
#COPY . /var/www/html
WORKDIR /var/www/html
# Use the default production configuration
#RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
EXPOSE 80
#CMD [ "php", "./your-script.php" ]
CMD ["apachectl", "-D", "FOREGROUND"]