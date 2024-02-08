FROM php:8.2-cli

COPY ./index.php ./contact.json /var/www/html/
WORKDIR /var/www/html/

CMD ["php", "-S", "0.0.0.0:80"]