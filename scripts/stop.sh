#!/usr/bin/env bash

pushd `dirname $0` > /dev/null
SCRIPT_DIR=`pwd`
popd > /dev/null

echo "Stopping docker containers..."
docker compose -f "$SCRIPT_DIR/../docker-compose.yml" kill