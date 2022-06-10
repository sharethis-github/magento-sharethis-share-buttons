#!/usr/bin/env bash

set -eo allexport

# Load env variables in.
. ./env

# Get this directory as a variable.
SCRIPT_DIR=$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")" &>/dev/null && pwd)

# Set memory limit to $PHP_MEMORY_LIMIT from env.
docker exec -it st_magento bash -c "chmod -R 777 generated var"
docker exec -it st_magento bash -c "rm -rf generated/* var/*"

# Flush the cache.
"$SCRIPT_DIR/../magento.sh" "cache:flush"

# Run dependency injection compilation.
"$SCRIPT_DIR/../magento.sh" "setup:di:compile"

# Run reindexer.
"$SCRIPT_DIR/../magento.sh" "indexer:reindex"
