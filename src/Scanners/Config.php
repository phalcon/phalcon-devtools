<?php
declare(strict_types=1);

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Phalcon\DevTools\Scanners;

use Phalcon\Config as PhConfig;
use Phalcon\Config\Adapter\Ini as IniConfig;
use Phalcon\Config\Adapter\Json as JsonConfig;
use Phalcon\Config\Adapter\Yaml as YamlConfig;
use Phalcon\Config\Exception;
use Phalcon\DevTools\Utils\FsUtils;
use Phalcon\Di\Injectable;

class Config extends Injectable
{
    /**
     * @var array
     */
    protected $configDirs = [
        'config',
        'app/config',
        'apps/config',
        'app/frontend/config',
        'apps/frontend/config',
        'app/backend/config',
        'apps/backend/config',
    ];

    /**
     * @var array
     */
    protected $configAdapters = [
        'ini'  => IniConfig::class,
        'json' => JsonConfig::class,
        'php'  => PhConfig::class,
        'php5' => PhConfig::class,
        'inc'  => PhConfig::class,
        'yml'  => YamlConfig::class,
        'yaml' => YamlConfig::class,
    ];

    /**
     * @var string
     */
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
    public function scan(string $filename): ?PhConfig
    {
        $config = null;
        $filename = pathinfo($filename, PATHINFO_FILENAME);

        foreach ($this->getConfigPaths() as $probablyPath) {
            foreach ($this->configAdapters as $ext => $adapter) {
                $probablyConfig = $probablyPath . DIRECTORY_SEPARATOR . "{$filename}.{$ext}";

                if (is_file($probablyConfig) && is_readable($probablyConfig)) {
                    if (in_array($ext, ['php', 'php5', 'inc'])) {
                        /** @noinspection PhpIncludeInspection */
                        $config = include($probablyConfig);
                        if (is_array($config)) {
                            $config = new PhConfig($config);
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
    public function load(string $filename): PhConfig
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
    public function getConfigPaths(): array
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
