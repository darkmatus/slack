#!/bin/bash
#
# Build
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

function download_composer() {
  require_binary "wget"
  local composer_version=latest-stable

  if [ ! -f composer.phar ]; then
    wget -O composer.phar https://getcomposer.org/download/${composer_version}/composer.phar
  fi
}

function composer_install() {
  require_binary "docker tar"

  local build_image=${1:-"php-base-build"}
  local mount_path=$(echo $(pwd))

  local composer_file="composer.json"
  if [ -e "composer.lock" ]; then
    composer_file="composer.lock"
  fi

  docker run --rm \
    -e COMPOSER_HOME=/composer \
    -e COMPOSER_ALLOW_SUPERUSER=1 \
    -v ~/.composer:/composer \
    -v $mount_path:/var/www \
    -w /var/www $build_image php composer.phar install
}

echo "Downloading composer if not present..."
download_composer $composer_version

echo "Building build image (slacklib-build)..."
docker build -t slacklib-build:latest -f docker/Dockerfile_build .
echo "Building build image (slacklib-build)... DONE"

echo "Installing PHP dependencies..."
composer_install slacklib-build
echo "Installing PHP dependencies... DONE"

echo "Building image (slacklib)..."
docker build -t slacklib:latest -f docker/Dockerfile_app .
echo "Building image (slacklib)... DONE"

echo "ALL DONE!"
