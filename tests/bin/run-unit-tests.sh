#!/bin/bash

set -e

if [ "$1" == "" ]; then
    php artisan test \
        --parallel \
        --processes=16 \
        --configuration=phpunit.xml \
        --coverage-xml=tests/coverage/coverage-xml \
        --coverage-html=tests/coverage \
        --log-junit=tests/coverage/junit.xml
else
    php artisan test \
        --configuration=phpunit.xml \
        --coverage-xml=/tmp/coverage/coverage-xml \
        --coverage-html=tests/coverage \
        --log-junit=tests/coverage/junit.xml \
        $1
fi
