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

use Phalcon\Validation;
use Phalcon\Script\Color;
use Phalcon\Validation\Validator\Namespaces;

/**
 * Abstract Component
 *
 * Base class for builder components
 *
 * @package Phalcon\Builder
 */
abstract class Component
{
    /**
     * Builder Options
     * @var Options
     */
    protected $options = null;

    /**
     * Path Component
     * @var Path
     */
    protected $path;

    /**
     * Create Builder object
     *
     * @param array $options Builder options
     */
    public function __construct(array $options = [])
    {
        $this->options = new Options($options);
        $this->path = new Path(realpath('.') . DIRECTORY_SEPARATOR);
    }

    protected function checkNamespace($namespace)
    {
        $validation = new Validation();

        $validation->add('namespace', new Namespaces([
            'allowEmpty' => true
        ]));

        $messages = $validation->validate(['namespace' => $namespace]);

        if (count($messages)) {
            $errors = [];
            foreach ($messages as $message) {
                $errors[] = $message->getMessage();
            }

            throw new BuilderException(sprintf('%s', implode(PHP_EOL, $errors)));
        }

        return true;
    }

    /**
     * Tries to find the current configuration in the application
     *
     * @param string $type Config type: ini | php
     * @return \Phalcon\Config
     * @throws BuilderException
     */
    protected function getConfig($type = null)
    {
        return $this->path->getConfig($type);
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
        return $this->path->isAbsolutePath($path);
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
    protected function notifySuccess($message)
    {
        print Color::success($message);
    }

    abstract public function build();
}
