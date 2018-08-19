#!/usr/bin/env bash

git clone -n git@github.com:symfony/symfony.git test-fixtures/symfony
cd test-fixtures/symfony
git checkout 75be8b747d06850136f181bac1bd67528eab6ce3
rm -rf .git
