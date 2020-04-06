#!/usr/bin/env bash
#
# This file is part of the Phalcon Framework.
#
# (c) Phalcon Team <team@phalcon.io>
#
# For the full copyright and license information, please view the
# LICENSE.txt file that was distributed with this source code.

CURRENT_DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
BUILD_DIR="${BUILD_DIR:-"$( dirname "$( dirname "$CURRENT_DIR" ) ")"}"
echo -e "Create PostgreSQL database..."
psql -U postgres devtools -p "$POSTGRES_DB_PORT" -h localhost -q -f "${BUILD_DIR}/tests/_data/schemas/postgresql/dump.sql"
echo -e "Done\n"

echo -e "Create MySQL database..."
cat "${BUILD_DIR}/tests/_data/schemas/mysql/dump.sql" | mysql --host=127.0.0.1 --user=root --password=root --port="$MYSQL_DB_PORT" --database devtools

echo -e "Check database created"
mysql --host=127.0.0.1 --user=root --password=root --port="$MYSQL_DB_PORT" -e 'show databases;'
echo -e "Done\n"

wait
