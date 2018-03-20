<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-present Phalcon Team (https://www.phalconphp.com)   |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>             |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Devtools\Modules\Core\Application;

use Phalcon\Di;
use Phalcon\DiInterface;
use Phalcon\Application;

/**
 * Phalcon\Devtools\Modules\Core\Application\AbstractApplication
 *
 * @package Phalcon\Devtools\Modules\Core\Application
 */
abstract class AbstractApplication implements ApplicationInterface
{
    /** @var DiInterface */
    protected $di;

    /** @var Application */
    protected $app;

    public function __construct()
    {
        $this->buildApp();
    }

    /**
     * Get application instance
     *
     * @return Application
     */
    public function getApplication()
    {
        return $this->app;
    }

    /**
     * Build application
     */
    protected function buildApp()
    {
        $this->setAppAndDi();

        $this->di->setShared('app', $this->app);
        Di::setDefault($this->di);
    }

    /**
     * Set application instance and DI
     */
    abstract protected function setAppAndDi();

    /**
     * Set data that application depend on
     */
    abstract public function setNecessaryData();
}
