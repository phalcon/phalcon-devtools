<?php

namespace Phalcon\Listeners;

use Phalcon\Mvc\Model\Migration\Profiler;
use Phalcon\Events\Event;

class DbListener
{
    protected $_profiler;

    public function __construct()
    {
        $this->_profiler = new Profiler();
    }

    public function beforeQuery(Event $event, $connection)
    {
        $this->_profiler->startProfile(
            $connection->getSQLStatement()
        );
    }

    public function afterQuery()
    {
        $this->_profiler->stopProfile();
    }
}
