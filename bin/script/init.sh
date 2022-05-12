#!/usr/bin/env bash

set -eo allexport
. ./env

docker compose up -d --build
docker exec -it st_magento bash -c "echo 'memory_limit=$PHP_MEMORY_LIMIT' > /usr/local/etc/php/conf.d/memory-limit.ini"
docker exec -it st_magento bash -c "chmod -R 777 generated var"
