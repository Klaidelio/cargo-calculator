#!/usr/bin/env bash

pushd `dirname $0` > /dev/null
SCRIPT_DIR=`pwd`
popd > /dev/null

docker --version > /dev/null 2>&1 || { echo >&2 "Docker not found. Please install it via https://docs.docker.com/install/"; exit 1;}
docker docker-compose --version > /dev/null 2>&1 || { echo >&2 "Docker-compose not found. Please install it via https://docs.docker.com/compose/install/"; exit 1; }

if [ ! -f "$SCRIPT_DIR/../.env" ]; then
    if [ -f "$SCRIPT_DIR/../.env.example" ]; then
        cp "$SCRIPT_DIR/../.env.example" "$SCRIPT_DIR/../.env"
    else
        echo >&2 "No .env file. Current Laravel project setup will not work"
        exit 1
    fi
fi

echo "Starting docker containers..."
CURRENT_UID=$(id -u):$(id -g) docker compose -f "$SCRIPT_DIR/../docker-compose.yml" up -d
