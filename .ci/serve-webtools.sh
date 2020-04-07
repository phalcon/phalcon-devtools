#!/usr/bin/env bash
#
# This file is part of the Phalcon Framework.
#
# (c) Phalcon Team <team@phalcon.io>
#
# For the full copyright and license information, please view the
# LICENSE.txt file that was distributed with this source code.

set -e

#WEB_TOOLS_PROJECT=${HOME}/webtools

rm -rf webtools
phalcon project --name=webtools
#phalcon project --directory=$HOME --name=webtools
#sed -i "s/'dbname'      => 'test',/'dbname'      => 'devtools',/g" ${WEB_TOOLS_PROJECT}/app/config/config.php
sed -i "s/database->charset/database->charset,\n\t\t'port'     => \$config->database->port/g" webtools/app/config/services.php
#cd ${WEB_TOOLS_PROJECT}
cd webtools

phalcon webtools enable
phalcon serve &
