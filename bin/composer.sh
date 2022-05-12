#!/usr/bin/env bash

set -eo allexport
. ./env

docker exec -it \
  -u www-data:www-data \
  st_magento \
  composer \
  "${@:---help}"
