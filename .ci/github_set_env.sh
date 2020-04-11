#!/usr/bin/env bash
#
# This file is part of the Phalcon Framework.
#
# (c) Phalcon Team <team@phalcon.io>
#
# For the full copyright and license information, please view the
# LICENSE.txt file that was distributed with this source code.

set -e

sed -i "s/MYSQL_DB_PORT=3306/MYSQL_DB_PORT=$MYSQL_DB_PORT/g" .env
sed -i "s/MYSQL_DB_PASSWORD=''/MYSQL_DB_PASSWORD='$MYSQL_DB_PASSWORD'/g" .env
sed -i "s/POSTGRES_DB_PORT=5432/POSTGRES_DB_PORT=$POSTGRES_DB_PORT/g" .env
