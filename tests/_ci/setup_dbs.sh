#!/usr/bin/env bash
#
# This file is part of the Phalcon Framework.
#
# (c) Phalcon Team <team@phalcon.io>
#
# For the full copyright and license information, please view the
# LICENSE.txt file that was distributed with this source code.

CURRENT_DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
TRAVIS_BUILD_DIR="${TRAVIS_BUILD_DIR:-$(dirname $(dirname $CURRENT_DIR))}"

echo -e "Create PostgreSQL database..."
psql -c 'create database devtools;' -U postgres
psql -U postgres devtools -q -f "${TRAVIS_BUILD_DIR}/tests/_data/schemas/postgresql/dump.sql"
echo -e "Done\n"

echo -e "Create MySQL database..."
mysql -u root -e "CREATE DATABASE IF NOT EXISTS devtools charset=utf8 collate=utf8_general_ci;"
cat "${TRAVIS_BUILD_DIR}/tests/_data/schemas/mysql/dump.sql" | mysql -u root devtools
echo -e "Done\n"

wait
