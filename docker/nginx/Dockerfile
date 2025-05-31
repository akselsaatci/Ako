FROM nginx:1.25-alpine

WORKDIR /app

COPY ./src/public/ ./public/

COPY ./docker/nginx/nginx.conf /etc/nginx/conf.d/default.conf

