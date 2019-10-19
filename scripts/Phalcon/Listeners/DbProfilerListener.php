<?php

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
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
