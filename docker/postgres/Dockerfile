FROM postgres:14.4-alpine
ARG TZ=Europe/Berlin

RUN apk -U add tzdata && \
    cp /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone && \
    apk del tzdata
