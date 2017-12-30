<?php

/*
  +------------------------------------------------------------------------+
  | Phosphorum                                                             |
  +------------------------------------------------------------------------+
  | Copyright (c) 2013-present Phalcon Team and contributors                  |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file  LICENSE.txt.                            |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
*/

use Phalcon\Di;

if (!function_exists('app_path')) {
    /**
     * Get the application path.
     *
     * @param  string $path
     * @return string
     */
    function app_path($path = '')
    {
        $returnPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . '_data'. DIRECTORY_SEPARATOR;
        $returnPath .= 'console' . DIRECTORY_SEPARATOR . 'app' . ($path ? DIRECTORY_SEPARATOR . $path : $path);

        return $returnPath;
    }
}

if (!function_exists('tests_path')) {
    /**
     * Get the tests path.
     *
     * @param  string $path
     * @return string
     */
    function tests_path($path = '')
    {
        return dirname(__DIR__) . DIRECTORY_SEPARATOR . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('env')) {
    function env($key, $default = null)
    {
        if (defined($key)) {
            return constant($key);
        }

        return getenv($key) ?: $default;
    }
}
