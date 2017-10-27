#!/bin/sh
export CONTAINER_NAME_PREFIX="dribly-web"
export HOST_HTTP_PORT=3008
export HOST_HTTPS_PORT=3408
export PHP_FPM_PORT=9008
export COMPOSE_PROJECT_NAME="dribly-web"
echo "Building $CONTAINER_NAME_PREFIX, HTTP $HOST_HTTP_PORT -> PHP $PHP_FPM_PORT"
cd laradock
docker-compose --project-name="dribly-web" up -d nginx php-fpm
echo "All done. Hope it worked"
