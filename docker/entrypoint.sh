#!/bin/sh

# Workaround https://bugs.php.net/bug.php?id=71880
tail -f $LOG_STREAM 2>/dev/null &
docker-php-entrypoint "$@"
