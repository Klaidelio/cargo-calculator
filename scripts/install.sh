#!/usr/bin/env bash

pushd `dirname $0` > /dev/null
SCRIPT_DIR=`pwd`
popd > /dev/null

set -e

echo "Preparing PHP dependencies..."
$SCRIPT_DIR/backend.sh 'composer' 'install'