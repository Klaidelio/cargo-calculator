#!/usr/bin/env bash

ARGS=$@

docker --version > /dev/null 2>&1 || { echo >&2 "Docker not found. Please install it via https://docs.docker.com/install/"; exit 1; }
docker docker-compose --version > /dev/null 2>&1 || { echo >&2 "Docker-compose not found. Please install it via https://docs.docker.com/compose/install/"; exit 1; }

if [ `docker ps | grep docguru_php | wc -l` != "1" ]; then
    echo >&2 "Docker containers not started. Execute scripts/start.sh first"
    exit 1
fi

if [ -t 0 ]; then
    TTY="-it"
fi

if [ "$ARGS" != "" ]; then
    echo "Executing in PHP container: $ARGS"
    docker exec ${TTY} -u root docguru_php $ARGS

    EXIT_CODE=$?
    if [ $EXIT_CODE -eq 129 ]; then
		exit 0
	else
		exit $EXIT_CODE
	fi
else
    echo 'Type "exit" to get out of terminal'
    docker exec ${TTY} docguru_php sh

    EXIT_CODE=$?
  if [ $EXIT_CODE -eq 129 ]; then
		exit 0
	else
		exit $EXIT_CODE
	fi
fi