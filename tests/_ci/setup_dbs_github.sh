#!/usr/bin/env bash
#
# This file is part of the Phalcon Framework.
#
# (c) Phalcon Team <team@phalcon.io>
#
# For the full copyright and license information, please view the
# LICENSE.txt file that was distributed with this source code.

CURRENT_DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
BUILD_DIR="${BUILD_DIR:-$(dirname $(dirname $CURRENT_DIR))}"
echo -e "Create PostgreSQL database..."
psql -U postgres devtools -p $POSTGRES_TEST_DB_PORT -h localhost -q -f "${BUILD_DIR}/tests/_data/schemas/postgresql/dump.sql"
echo -e "Done\n"

echo -e "Create MySQL database..."
mysql --host=127.0.0.1 -user=root --port=$MYSQL_TEST_DB_PORT -e "CREATE DATABASE IF NOT EXISTS devtools charset=utf8 collate=utf8_general_ci;"
cat "${BUILD_DIR}/tests/_data/schemas/mysql/dump.sql" | mysql --host=127.0.0.1 -user=root --port=$MYSQL_TEST_DB_PORT --database devtools
echo -e "Done\n"

wait
