FROM ubuntu
RUN apt-get update -y 
RUN apt-get install apache2 -y
RUN apt-get install php -y
RUN apt-get install libapache2-mod-php  -y
RUN apt-get install curl -y
RUN apt-get install php7.0-mysql
RUN mkdir /var/www/html/php_uploads
RUN chown www-data /var/www/html/php_uploads/
RUN service apache2 restart
RUN sed -i "s/AllowOverride None/AllowOverride All/g" /etc/apache2/apache2.conf
RUN a2enmod rewrite
CMD ["apachectl",  "-D FOREGROUND"]
# RUN echo "\nLoadModule rewrite_module modules/mod_rewrite.so" >> /etc/apache2/apache2.conf