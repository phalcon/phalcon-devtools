<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (https://www.phalconphp.com)      |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  |          Serghei Iakovlev <serghei@phalconphp.com>                     |
  +------------------------------------------------------------------------+
*/

use Phalcon\Bootstrap;

include 'webtools.config.php';
include PTOOLSPATH . '/bootstrap/autoload.php';

$bootstrap = new Bootstrap([
    'ptools_path' => PTOOLSPATH,
    'ptools_ip'   => PTOOLS_IP,
    'base_path'   => BASE_PATH,
]);

if (APPLICATION_ENV === ENV_TESTING) {
    return $bootstrap->run();
} else {
    echo $bootstrap->run();
}
