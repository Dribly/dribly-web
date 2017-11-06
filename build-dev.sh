#!/bin/sh
export CONTAINER_NAME_PREFIX="dribly-web"
echo "Building $CONTAINER_NAME_PREFIX"
cd laradock
docker-compose build --project-name "dribly-web" up -d nginx 
echo "All done. Hope it worked"
