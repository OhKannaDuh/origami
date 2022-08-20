#!/bin/bash

set -e

vendor/bin/infection \
    --only-covered \
    --min-covered-msi=100 \
    -j16 \
    --ignore-msi-with-no-mutations \
    --coverage=tests/coverage \
    --skip-initial-tests \
    --test-framework-options="--configuration=phpunit.xml"
