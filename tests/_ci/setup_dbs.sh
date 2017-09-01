#!/usr/bin/env bash
#
#  Phalcon Framework
#
#  Copyright (c) 2011-2017 Phalcon Team (https://www.phalconphp.com)
#
#  This source file is subject to the New BSD License that is bundled
#  with this package in the file LICENSE.txt.
#
#  If you did not receive a copy of the license and are unable to
#  obtain it through the world-wide-web, please send an email
#  to license@phalconphp.com so we can send you a copy immediately.

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
