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

namespace Phalcon\Devtools\Modules\Core;

use Phalcon\Cli\Console as ConsoleApp;
use Phalcon\Di\FactoryDefault\Cli as CliDI;
use Phalcon\Devtools\Modules\Core\Application\AbstractApplication;

/**
 * Phalcon\Devtools\Modules\Core\CliApplication
 *
 * Cli application
 *
 * @package Phalcon\Devtools\Modules\Core
 */
class CliApplication extends AbstractApplication
{
    /**
     * Set application instance and DI
     */
    protected function setAppAndDi()
    {
        $this->di = new CliDI();
        $this->app = new ConsoleApp();

        $this->app->setDI($this->di);
    }

    /**
     * Set data that application depend on
     */
    public function setNecessaryData()
    {
    }
}
