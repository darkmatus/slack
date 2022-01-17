#!/bin/bash
#
set -e

function require_binary() {
  for cmd in $1
  do
    echo "Checking if binary ${cmd} is present"
    command -v $cmd >/dev/null 2>&1 || \
    {
      echo >&2 "Binary ${cmd} is required to execute this script. Aborting.";
      exit 1;
    }
  done
}

function gracefull_shutdown_docker_compose() {
  exit_code=$?

  require_binary "docker-compose"

  local flags=${1}

  trap '' EXIT

  echo "Stopping and removing containers"
  docker-compose $flags down

  if [ "$exit_code" -ne "0" ]
  then
    echo "Failed"
    exit 1
  fi

  echo "Done"
}

echo "Bringing services up with docker compose"
docker-compose -f docker-compose.yml up -d

# On error or when finished, shutdown containers
trap 'gracefull_shutdown_docker_compose "-f docker-compose.yml"' ERR EXIT

echo "Running tests"
docker-compose -f docker-compose.yml exec -T \
  php \
  /var/www/vendor/bin/phpunit "$@"
