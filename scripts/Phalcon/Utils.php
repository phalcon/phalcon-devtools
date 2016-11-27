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

namespace Phalcon;

class Utils
{
    const DB_ADAPTER_POSTGRESQL = 'Postgresql';

    const DB_ADAPTER_SQLITE = 'Sqlite';

    /**
     * Converts the underscore_notation to the UpperCamelCase
     *
     * @param string $string
     * @return string
     */
    public static function camelize($string)
    {
        $stringParts = explode('_', $string);
        $stringParts = array_map('ucfirst', $stringParts);

        return implode('', $stringParts);
    }

    /**
     * Converts the underscore_notation to the lowerCamelCase
     *
     * @param string $string
     * @return string
     */
    public static function lowerCamelize($string)
    {
        return lcfirst(self::camelize($string));
    }

    /**
     * Resolves the DB Schema
     *
     * @param Config $config
     * @return null|string
     */
    public static function resolveDbSchema(Config $config)
    {
        if ($config->offsetExists('schema')) {
            return $config->get('schema');
        }

        if (self::DB_ADAPTER_POSTGRESQL == $config->get('adapter')) {
            return 'public';
        }

        if (self::DB_ADAPTER_SQLITE == $config->get('adapter')) {
            // SQLite only supports the current database, unless one is
            // attached. This is not the case, so don't return a schema.
            return null;
        }

        if ($config->offsetExists('dbname')) {
            return $config->get('dbname');
        }

        return null;
    }
}
