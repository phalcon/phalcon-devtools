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

namespace Phalcon\Scanners;

use Phalcon\Utils\FsUtils;
use Phalcon\Config\Exception;
use Phalcon\Mvc\User\Component;
use Phalcon\Config as PhConfig;
use Phalcon\Config\Adapter\Ini as IniConfig;
use Phalcon\Config\Adapter\Json as JsonConfig;
use Phalcon\Config\Adapter\Yaml as YamlConfig;

/**
 * \Phalcon\Scanners\Config
 *
 * @package Phalcon\Scanners
 */
class Config extends Component
{
    protected $configDirs = [
        'config',
        'app/config',
        'apps/config',
        'app/frontend/config',
        'apps/frontend/config',
        'app/backend/config',
        'apps/backend/config',
    ];

    protected $configAdapters = [
        'ini'  => IniConfig::class,
        'json' => JsonConfig::class,
        'php'  => PhConfig::class,
        'php5' => PhConfig::class,
        'inc'  => PhConfig::class,
        'yml'  => YamlConfig::class,
        'yaml' => YamlConfig::class,
    ];

    protected $basePath = '';

    public function __construct($basePath)
    {
        if (is_string($basePath)) {
            $this->basePath = rtrim($basePath, '\\/');
        }
    }

    /**
     * Scans for application config.
     *
     * @param string $filename The config basename.
     * @return null|PhConfig
     */
    public function scan($filename)
    {
        $config = null;
        $filename = pathinfo($filename, PATHINFO_FILENAME);

        foreach ($this->getConfigPaths() as $probablyPath) {
            foreach ($this->configAdapters as $ext => $adapter) {
                $probablyConfig = $probablyPath . DS . "{$filename}.{$ext}";

                if (is_file($probablyConfig) && is_readable($probablyConfig)) {
                    if (in_array($ext, ['php', 'php5', 'inc'])) {
                        /** @noinspection PhpIncludeInspection */
                        $config = include($probablyConfig);
                        if (is_array($config)) {
                            $config = new Config($config);
                        }
                    } else {
                        $config = new $adapter($probablyConfig);
                    }

                    break(2);
                }
            }
        }

        return $config;
    }

    /**
     * Alias for Config::scan but throws Exception if configuration could not be found.
     *
     * @param string $filename The config basename.
     *
     * @return PhConfig
     * @throws Exception
     */
    public function load($filename)
    {
        $config = $this->scan($filename);

        if (!$config instanceof PhConfig) {
            throw new Exception(
                sprintf(
                    "Configuration file couldn't be loaded! Scanned paths: %s",
                    implode(', ', $this->getConfigPaths())
                )
            );
        }

        return $config;
    }

    /**
     * Prepares config paths.
     *
     * @return array
     */
    public function getConfigPaths()
    {
        /** @var FsUtils $fsUtils */
        $fsUtils  = $this->getDI()->getShared('fs');
        $basePath = $this->basePath;

        if (!is_dir($basePath) || !is_readable($basePath)) {
            return [];
        }

        return array_map(function ($val) use ($basePath, $fsUtils) {
            return $basePath . $fsUtils->normalize("/{$val}");
        }, $this->configDirs);
    }
}
