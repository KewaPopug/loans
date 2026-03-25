#FROM yiisoftware/yii2-php:8.3-fpm
FROM yiisoftware/yii2-php:8.3-apache

RUN apt-get update && apt-get install -y \
    postgresql-client

WORKDIR /app

COPY ./docker/php/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]