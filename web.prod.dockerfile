FROM nginx:1.10-alpine

ADD vhost.prod.conf /etc/nginx/conf.d/default.conf

COPY public /var/www/public
