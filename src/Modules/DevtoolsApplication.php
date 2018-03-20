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

namespace Phalcon\Devtools\Modules;

use Phalcon\Di;
use Phalcon\DiInterface;
use Phalcon\Application;
use Phalcon\Devtools\Modules\Core\Application\ApplicationInterface;

/**
 * Phalcon\Devtools\Modules\DevtoolsApplication
 *
 * @package Phalcon\Devtools\Modules
 */
class DevtoolsApplication
{
    /** @var DiInterface */
    private $di;

    /** @var ApplicationInterface */
    private $app;

    public function __construct(ApplicationInterface $app)
    {
        $this->setApplication($app);
    }

    protected function setApplication(ApplicationInterface $appClass)
    {
        $this->app = $appClass->getApplication();
        $appClass->setNecessaryData();
    }

    /**
     *  handle Cli commands
     *
     * @param array $argv
     */
    public function run(array $argv)
    {
    }
}
