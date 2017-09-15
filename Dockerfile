FROM webdevops/php-nginx:5.6

RUN echo "output_buffering = On" >> /opt/docker/etc/php/php.ini