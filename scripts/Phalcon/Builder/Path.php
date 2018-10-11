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

namespace Phalcon\Builder;

use FilesystemIterator;
use Phalcon\Config;
use Phalcon\Config\Factory;
use Phalcon\Text;
use RecursiveCallbackFilterIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

/**
 * Path Class
 *
 * @package Phalcon\Builder
 */
class Path
{
    protected $rootPath = null;

    public function __construct($rootPath = null)
    {
        $this->rootPath = $rootPath ?: realpath('.') . DIRECTORY_SEPARATOR;
    }

    /**
     * getConfigInstance
     * @param SplFileInfo $f
     * @return null|Config
     */
    protected function getConfigInstance(SplFileInfo $f)
    {
        if ($f->isFile() && $f->isReadable() && $f->getExtension() && strpos($f->getBasename(), 'config') !== false) {
            /** @noinspection PhpIncludeInspection */
            if ($f->getExtension() === 'php' && ($config = include $f->getRealPath()) instanceof Config) {
                return $config;
            }

            /** check if extension has supported adapter */
            if (class_exists(sprintf('\Phalcon\Config\Adapter\%s', Text::camelize($f->getExtension())))) {
                return Factory::load([
                    'filePath' => $f->getRealPath(),
                    'adapter' => $f->getExtension()
                ]);
            }
        }
        return null;
    }

    /**
     * Tries to find the current configuration in the application
     *
     * @param string $type Config type: ini | php
     * @return \Phalcon\Config
     * @throws BuilderException
     */
    public function getConfig($type = null)
    {
        $types = ['php' => true, 'ini' => true];
        $type = isset($types[$type]) ? $type : 'ini';

        foreach (['app/config', 'config', 'apps/config', 'apps/frontend/config'] as $configPath) {
            $f = new SplFileInfo(sprintf('%s/config.%s', $this->rootPath . $configPath, $type));
            if (($config = $this->getConfigInstance($f)) instanceof Config) {
                return $config;
            }
        }

        $directory = new RecursiveDirectoryIterator('.', FilesystemIterator::SKIP_DOTS);
        /** Ignore known third party application folders to improve search performance */
        $directory = new RecursiveCallbackFilterIterator($directory, function (SplFileInfo $current) {
            return !in_array($current->getFilename(), ['.svn', '.git', '.hg', '.idea', 'nbproject'], true);
        });
        $iterator = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::LEAVES_ONLY);
        /** @var SplFileInfo $f */
        foreach ($iterator as $f) {
            if (($config = $this->getConfigInstance($f)) instanceof Config) {
                return $config;
            }
        }

        throw new BuilderException("Builder can't locate the configuration file");
    }

    /**
     * setRootPath
     * @param string $path
     * @return $this
     */
    public function setRootPath($path)
    {
        $this->rootPath = rtrim(str_replace('/', DIRECTORY_SEPARATOR, $path), '\\/') . DIRECTORY_SEPARATOR;

        return $this;
    }

    /**
     * getRootPath
     * @param null|string $path
     * @return string
     */
    public function getRootPath($path = null)
    {
        return $this->rootPath . ($path ? trim($path, '\\/') . DIRECTORY_SEPARATOR : '');
    }

    /**
     * appendRootPath
     * @param string $pathPath
     */
    public function appendRootPath($pathPath)
    {
        $this->setRootPath($this->getRootPath() . rtrim($pathPath, '\\/') . DIRECTORY_SEPARATOR);
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
        if (stripos(PHP_OS, 'WIN') === 0 && preg_match('/^[A-Z]:\\\\/', $path)) {
            return true;
        }
        if ($path[0] === DIRECTORY_SEPARATOR) {
            return true;
        }
        return false;
    }

    /**
     * Check Phalcon system dir
     *
     * @return bool
     */
    public function hasPhalconDir()
    {
        return file_exists($this->rootPath . '.phalcon');
    }
}
