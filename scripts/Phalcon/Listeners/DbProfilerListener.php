<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2017 Phalcon Team (https://www.phalconphp.com)      |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Sergii Svyrydenko <sergey.v.svyrydenko@gmail.com>             |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Listeners;

use Phalcon\Mvc\Model\Migration\Profiler;
use Phalcon\Events\Event;

/**
 * Phalcon\Listeners\DbProfilerListener
 *
 * Db event listener
 *
 * @package Phalcon\Listeners
 */
class DbProfilerListener
{
    protected $profiler;

    public function __construct()
    {
        $this->profiler = new Profiler();
    }

    public function beforeQuery(Event $event, $connection)
    {
        $this->profiler->startProfile($connection->getSQLStatement());
    }

    public function afterQuery()
    {
        $this->profiler->stopProfile();
    }
}
