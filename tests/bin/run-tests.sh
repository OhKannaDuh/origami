#!/bin/bash

set -e

tests/bin/run-unit-tests.sh

tests/bin/run-static-analysis.sh

tests/bin/run-infection-tests.sh