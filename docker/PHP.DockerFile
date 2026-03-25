FROM yiisoftware/yii2-php:8.3-fpm

RUN apt-get update && apt-get install -y \
    postgresql-client

# composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY ./docker/php/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]