#!/usr/bin/env bash

set -eo allexport
. ./env

docker run --rm -v \
  $(PWD):/app \
  prooph/composer:7.4 \
  --working-dir="${WORKING_DIR:-.}" \
  "${@:-help}"
