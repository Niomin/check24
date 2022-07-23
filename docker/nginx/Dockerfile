FROM nginx:1.23.0-alpine

ARG TZ
RUN apk -U add tzdata && \
    cp /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone && \
    apk del tzdata
COPY ./default.conf /etc/nginx/conf.d/default.conf
