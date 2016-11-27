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

namespace Phalcon\Mvc\Dispatcher;

use Phalcon\Dispatcher;
use Phalcon\Events\Event;
use Phalcon\Access\Manager;
use Phalcon\Mvc\Dispatcher\Exception as DispatchException;

/**
 * \Phalcon\Mvc\Dispatcher\ErrorHandler
 *
 * @package Phalcon\Mvc\Dispatcher
 */
class ErrorHandler
{
    /**
     * Before exception is happening.
     *
     * @param Event      $event      Event object.
     * @param Dispatcher $dispatcher Dispatcher object.
     * @param \Exception $exception  Exception object.
     *
     * @throws \Exception
     * @return bool
     */
    public function beforeException(Event $event, Dispatcher $dispatcher, $exception)
    {
        if ($exception instanceof DispatchException) {
            switch ($exception->getCode()) {
                case Dispatcher::EXCEPTION_INVALID_HANDLER:
                case Dispatcher::EXCEPTION_CYCLIC_ROUTING:
                    $action = 'route500';
                    break;
                case Manager::EXCEPTION_ACTION_DISALLOWED:
                    $action = 'route403';
                    break;
                case Dispatcher::EXCEPTION_INVALID_PARAMS:
                    $action = 'route400';
                    break;
                default:
                    $action = 'route404';
            }

            $dispatcher->forward(
                [
                    'controller' => 'error',
                    'action'     => $action,
                ]
            );

            return false;
        }

        if (ENV_PRODUCTION !== APPLICATION_ENV && $exception instanceof \Exception) {
            throw $exception;
        }

        $dispatcher->forward(
            [
                'controller' => 'error',
                'action'     => 'route500'
            ]
        );

        return $event->isStopped();
    }
}
