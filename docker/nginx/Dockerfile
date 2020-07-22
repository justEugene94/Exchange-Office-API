FROM nginx:latest

RUN apt-get update && apt-get install -y nano

RUN deluser www-data
RUN adduser --disabled-password --no-create-home --uid 1000 --shell /bin/bash www-data

COPY ./nginx.conf /etc/nginx/conf.d/default.conf
COPY ./exchanger.loc.crt /etc/ssl/certs/exchanger.loc.crt
COPY ./exchanger.loc.key /etc/ssl/private/exchanger.loc.key

ENV TERM xterm
