<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (http://www.phalconphp.com)       |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file docs/LICENSE.txt.                        |
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

namespace Phalcon;

use Phalcon\Config;

class Utils
{
    const DB_ADAPTER_POSTGRESQL = 'Postgresql';

    public static function camelize($string)
    {
        $stringParts = explode('_', $string);
        $stringParts = array_map('ucfirst', $stringParts);

        return implode('', $stringParts);
    }

    /**
     * Resolves the DB Schema
     *
     * @param \Phalcon\Config $config
     * @return null|string
     */
    public static function resolveDbSchema(Config $config)
    {
        if ($config->offsetExists('schema')) {
            return $config->get('schema');
        }

        if (self::DB_ADAPTER_POSTGRESQL == $config->get('adapter')) {
            return  'public';
        }

        if ($config->offsetExists('dbname')) {
            return $config->get('dbname');
        }

        return null;
    }
}
