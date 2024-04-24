#!/usr/bin/env bash

pushd `dirname $0` > /dev/null
SCRIPT_DIR=`pwd`
popd > /dev/null

set -e

echo "Preparing PHP dependencies..."
$SCRIPT_DIR/backend.sh 'composer' 'install'
$SCRIPT_DIR/backend.sh 'php' 'artisan' 'key:generate'
$SCRIPT_DIR/backend.sh 'php' 'artisan' 'migrate'
$SCRIPT_DIR/backend.sh 'php' 'artisan' 'db:seed'
$SCRIPT_DIR/backend.sh 'npm' 'install'
$SCRIPT_DIR/backend.sh 'npm' 'run' 'build'

