FROM nginx:1.15.0-alpine

COPY ./ /var/www/public

RUN rm /etc/nginx/conf.d/default.conf

COPY ./nginx/nginx.conf /etc/nginx/conf.d