FROM php:8.2-apache

WORKDIR /var/www/html

RUN set -eux; \
    a2enmod rewrite; \
    { \
        echo 'default_charset=windows-1251'; \
        echo 'display_errors=On'; \
        echo 'log_errors=On'; \
        echo 'error_reporting=E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED'; \
    } > /usr/local/etc/php/conf.d/legacy-app.ini

COPY . /var/www/html/

RUN set -eux; \
    touch /var/www/html/ip.txt; \
    chown -R www-data:www-data \
        /var/www/html/article \
        /var/www/html/counter \
        /var/www/html/logs \
        /var/www/html/pages \
        /var/www/html/new.dat \
        /var/www/html/ip.txt \
        /var/www/html/forum/data \
        /var/www/html/forum/logs \
        /var/www/html/forum/templates \
        /var/www/html/forum/lock/data \
        /var/www/html/forum/lock/logs \
        /var/www/html/forum/lock/templates \
        /var/www/html/forum/robot777/data \
        /var/www/html/forum/robot777/logs \
        /var/www/html/forum/robot777/lock; \
    find \
        /var/www/html/article \
        /var/www/html/counter \
        /var/www/html/logs \
        /var/www/html/pages \
        /var/www/html/forum/data \
        /var/www/html/forum/logs \
        /var/www/html/forum/templates \
        /var/www/html/forum/lock/data \
        /var/www/html/forum/lock/logs \
        /var/www/html/forum/lock/templates \
        /var/www/html/forum/robot777/data \
        /var/www/html/forum/robot777/logs \
        /var/www/html/forum/robot777/lock \
        -type d -exec chmod 775 {} +; \
    find \
        /var/www/html/article \
        /var/www/html/counter \
        /var/www/html/logs \
        /var/www/html/pages \
        /var/www/html/forum/data \
        /var/www/html/forum/logs \
        /var/www/html/forum/templates \
        /var/www/html/forum/lock/data \
        /var/www/html/forum/lock/logs \
        /var/www/html/forum/lock/templates \
        /var/www/html/forum/robot777/data \
        /var/www/html/forum/robot777/logs \
        /var/www/html/forum/robot777/lock \
        -type f -exec chmod 664 {} +

EXPOSE 80
