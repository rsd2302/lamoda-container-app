#!/usr/bin/env sh

set -e

role=${CONTAINER_ROLE:-app}

if [ "$role" = "app" ]; then
    exec php-fpm
elif [ "$role" = "queue" ]; then
    php /app/artisan queue:work --timeout=999999
fi