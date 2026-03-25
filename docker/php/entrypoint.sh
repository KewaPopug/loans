#!/bin/bash

set -e

echo "Waiting for postgres..."

until pg_isready -h postgres -p 5432 -U user; do
  sleep 1
done

echo "Postgres is ready"

if [ ! -d "vendor" ]; then
  echo "Installing composer dependencies..."
  composer install --no-interaction --prefer-dist
fi

echo "Running migrations..."
php yii migrate --interactive=0

echo "Starting php-fpm..."
php-fpm