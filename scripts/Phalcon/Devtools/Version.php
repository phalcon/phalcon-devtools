<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2017 Phalcon Team (https://www.phalconphp.com)      |
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

namespace Phalcon\Devtools;

use Phalcon\Version as PhVersion;

/**
 * \Phalcon\Devtools\Version
 *
 * This class allows to get the installed version of the Developer Tools
 *
 * @package Phalcon\Devtools
 */
class Version extends PhVersion
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    protected static function _getVersion()
    {
        return [3, 2, 3, 4, 1];
    }
}
