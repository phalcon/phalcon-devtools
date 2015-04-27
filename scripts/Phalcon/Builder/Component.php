<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2015 Phalcon Team (http://www.phalconphp.com)       |
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
  |          Serghei Iakovlev <sadhooklay@gmail.com>                       |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Builder;

use Phalcon\Script\Color;
use Phalcon\Config;
use Phalcon\Config\Adapter\Ini as ConfigIni;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Abstract Component
 *
 * Base class for builder components
 *
 * @package     Phalcon\Builder
 * @copyright   Copyright (c) 2011-2015 Phalcon Team (team@phalconphp.com)
 * @license     New BSD License
 */
abstract class Component
{

    protected $_options = array();

    /**
     * @param $options
     */
    public function __construct($options)
    {
        $this->_options = $options;
    }

    /**
     * Tries to find the current configuration in the application
     *
     * @param string $path Project path
     *
     * @return mixed|Config|ConfigIni
     * @throws BuilderException
     */
    protected function _getConfig($path)
    {
        $path = realpath($path) . DIRECTORY_SEPARATOR;

        foreach (array('app/config/', 'config/') as $configPath) {
            if (file_exists($path . $configPath . 'config.ini')) {
                return new ConfigIni($path . $configPath . 'config.ini');
            } else {
                if (file_exists($path . $configPath. 'config.php')) {
                    $config = include($path . $configPath . 'config.php');
                    if (is_array($config)) {
                        $config = new Config($config);
                    }

                    return $config;
                }
            }
        }

        $directory = new RecursiveDirectoryIterator('.');
        $iterator = new RecursiveIteratorIterator($directory);
        foreach ($iterator as $f) {
            if (preg_match('/config\.php$/i', $f->getPathName())) {
                $config = include $f->getPathName();
                if (is_array($config)) {
                    $config = new Config($config);
                }

                return $config;
            } else {
                if (preg_match('/config\.ini$/i', $f->getPathName())) {
                    return new ConfigIni($f->getPathName());
                }
            }
        }

        throw new BuilderException('Builder can\'t locate the configuration file');
    }

    /**
     * Check if a path is absolute
     *
     * @param string $path Path to check
     *
     * @return bool
     */
    public function isAbsolutePath($path)
    {
        if (PHP_OS == "WINNT") {
            if (preg_match('/^[A-Z]:\\\\/', $path)) {
                return true;
            }
        } else {
            if (substr($path, 0, 1) == DIRECTORY_SEPARATOR) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if the script is running on Console mode
     *
     * @return boolean
     */
    public function isConsole()
    {
        return PHP_SAPI == 'cli';
    }

    /**
     * Check if the current adapter is supported by Phalcon
     *
     * @param  string $adapter
     *
     * @return bool
     * @throws BuilderException
     */
    public function isSupportedAdapter($adapter)
    {
        if (!class_exists('\Phalcon\Db\Adapter\Pdo\\' . $adapter)) {
            throw new BuilderException("Adapter $adapter is not supported");
        }

        return true;
    }

    /**
     * Shows a success notification
     *
     * @param string $message
     */
    protected function _notifySuccess($message)
    {
        print Color::success($message);
    }

    abstract public function build();
}
