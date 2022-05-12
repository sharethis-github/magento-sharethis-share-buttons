#!/usr/bin/env bash

set -eo allexport

# Load env variables in.
. ./env

# Get this directory as a variable.
SCRIPT_DIR=$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")" &>/dev/null && pwd)

# Set memory limit to $PHP_MEMORY_LIMIT from env.
docker exec -it st_magento bash -c "echo 'memory_limit=$PHP_MEMORY_LIMIT' > /usr/local/etc/php/conf.d/memory-limit.ini"
docker exec -it st_magento bash -c "chmod -R 777 generated var"

# Run base install from env variables.
"$SCRIPT_DIR/../magento.sh" setup:install \
  --backend-frontname="$MAGENTO_BACKEND_FRONTNAME" \
  --base-url="$MAGENTO_URL" \
  --db-host="$MYSQL_HOST" \
  --db-name="$MYSQL_DATABASE" \
  --db-user="$MYSQL_USER" \
  --db-password="$MYSQL_PASSWORD" \
  --admin-firstname="$MAGENTO_ADMIN_FIRSTNAME" \
  --admin-lastname="$MAGENTO_ADMIN_LASTNAME" \
  --admin-email="$MAGENTO_ADMIN_EMAIL" \
  --admin-user="$MAGENTO_ADMIN_USERNAME" \
  --admin-password="$MAGENTO_ADMIN_PASSWORD" \
  --language="$MAGENTO_LANGUAGE" \
  --currency="$MAGENTO_DEFAULT_CURRENCY" \
  --timezone="$MAGENTO_TIMEZONE" \
  --use-rewrites=1

ADMIN_URL="$MAGENTO_URL/$MAGENTO_BACKEND_FRONTNAME/"

# Print credentials to screen.
printf "Opening %s\n\nusername: %s\npassword: %s\n" \
  $ADMIN_URL \
  $MAGENTO_ADMIN_USERNAME \
  $MAGENTO_ADMIN_PASSWORD

# Open the URL in the local default browser.
open "$ADMIN_URL"
