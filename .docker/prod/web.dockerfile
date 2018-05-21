FROM php:7.2-fpm-alpine

# nanobox configuration
# 
# route http traffic to port 8080 within the container
LABEL io.nanobox.http_port="8080"
# stream service logs
LABEL io.nanobox.logs.1.path="/var/log/runit/nginx/current"
LABEL io.nanobox.logs.1.prefix="nginx[out]"
LABEL io.nanobox.logs.2.path="/var/log/runit/fpm/current"
LABEL io.nanobox.logs.2.prefix="fpm[out]"
# stream nginx logs
LABEL io.nanobox.logs.3.path="/var/log/nginx/access.log"
LABEL io.nanobox.logs.3.prefix="nginx[access]"
LABEL io.nanobox.logs.4.path="/var/log/nginx/error.log"
LABEL io.nanobox.logs.4.prefix="nginx[error]"
# stream php logs
LABEL io.nanobox.logs.4.path="/var/log/php/error.log"
LABEL io.nanobox.logs.4.prefix="php[error]"
# stream fpm logs
LABEL io.nanobox.logs.5.path="/var/log/php/fpm.log"
LABEL io.nanobox.logs.5.prefix="fpm[error]"

RUN apk add --no-cache --virtual .persistent-deps \
    runit \
    nginx \
    bash

# install the PHP extensions we need
RUN set -ex; \
	\
	apk add --no-cache --virtual .build-deps \
    sed \
		libjpeg-turbo-dev \
		libpng-dev \
	; \
	\
	docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr; \
	docker-php-ext-install gd mysqli opcache; \
	\
	runDeps="$( \
		scanelf --needed --nobanner --format '%n#p' --recursive /usr/local/lib/php/extensions \
			| tr ',' '\n' \
			| sort -u \
			| awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
	)"; \
	apk add --virtual .wordpress-phpexts-rundeps $runDeps; \
	apk del .build-deps

# configure php
RUN mkdir -p /var/log/php
COPY .docker/prod/web/php/settings.ini /usr/local/etc/php/conf.d/settings.ini

# configure fpm
COPY .docker/prod/web/fpm/fpm.conf /usr/local/etc/php/php-fpm.conf

# setup runit nginx:
RUN mkdir -p /etc/service/nginx
RUN mkdir -p /etc/service/nginx/log
COPY .docker/prod/web/runit/nginx /etc/service/nginx/run
COPY .docker/prod/web/runit/nginx-log /etc/service/nginx/log/run

# setup runit fpm:
RUN mkdir -p /etc/service/fpm
RUN mkdir -p /etc/service/fpm/log
COPY .docker/prod/web/runit/fpm /etc/service/fpm/run
COPY .docker/prod/web/runit/fpm-log /etc/service/fpm/log/run

# setup nginx:
COPY .docker/prod/web/nginx/nginx.conf /etc/nginx/nginx.conf
COPY .docker/prod/web/nginx/wordpress.conf /etc/nginx/conf.d/wordpress.conf
RUN rm -f /etc/nginx/conf.d/default.conf
RUN mkdir -p /run/nginx

# copy the app into the image
COPY . /var/www/html

# override wp-config.php
COPY .docker/prod/web/wordpress/wp-config.php /var/www/html

CMD ["runsvdir", "-P", "/etc/service"]
