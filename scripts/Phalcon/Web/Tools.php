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

namespace Phalcon\Web;

use Phalcon\Exception;

/**
 * \Phalcon\Web\Tools
 *
 * Allows to use Phalcon Developer Tools with a web interface.
 *
 * @package Phalcon\Web
 */
class Tools
{
    /**
     * Install webtools
     *
     * @param  string     $path
     * @return bool
     * @throws Exception if document root cannot be located
     */
    public static function install($path)
    {
        $path = str_replace(["\\", '/'], DS, realpath($path)) . DS;

        if (!is_dir($path . 'public' . DS)) {
            throw new Exception('Document root cannot be located');
        }

        $tools = rtrim(str_replace(["\\", '/'], DS, PTOOLSPATH), DS);

        copy($tools . DS . 'webtools.php', $path . 'public' . DS . 'webtools.php');

        if (!file_exists($configPath = $path . 'public' . DS . 'webtools.config.php')) {
            $template = file_get_contents(TEMPLATE_PATH . DS . 'webtools.config.php');
            $code = str_replace('@@PATH@@', $tools, $template);

            file_put_contents($configPath, $code);
        }

        return true;
    }

    /**
     * Uninstall webtools
     *
     * @param  string $path
     * @return bool
     *
     * @throws \Exception
     */
    public static function uninstall($path)
    {
        $path = str_replace(["\\", '/'], DS, realpath($path)) . DS;

        if (!is_dir($path . 'public')) {
            throw new \Exception('Document root cannot be located');
        }

        if (is_file($path . 'public' . DS . 'webtools.config.php')) {
            unlink($path . 'public' . DS . 'webtools.config.php');
        }

        if (is_file($path . 'public' . DS . 'webtools.php')) {
            unlink($path . 'public' . DS . 'webtools.php');
        }

        return true;
    }
}
