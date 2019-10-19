<?php

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
