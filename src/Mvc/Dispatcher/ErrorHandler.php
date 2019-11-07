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

namespace Phalcon\DevTools\Mvc\Dispatcher;

use Exception;
use Phalcon\DevTools\Access\Manager;
use Phalcon\Dispatcher\Exception as DispatcherException;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Dispatcher\Exception as DispatchException;

class ErrorHandler
{
    /**
     * Before exception is happening.
     *
     * @param Event $event Event object.
     * @param Dispatcher $dispatcher Dispatcher object.
     * @param Exception $exception Exception object.
     *
     * @return bool
     * @throws Exception
     */
    public function beforeException(Event $event, Dispatcher $dispatcher, $exception)
    {
        if ($exception instanceof DispatchException) {
            switch ($exception->getCode()) {
                case DispatcherException::EXCEPTION_INVALID_HANDLER:
                case DispatcherException::EXCEPTION_CYCLIC_ROUTING:
                    $action = 'route500';
                    break;
                case Manager::EXCEPTION_ACTION_DISALLOWED:
                    $action = 'route403';
                    break;
                case DispatcherException::EXCEPTION_INVALID_PARAMS:
                    $action = 'route400';
                    break;
                default:
                    $action = 'route404';
            }

            $dispatcher->forward([
                'controller' => 'error',
                'action' => $action,
            ]);

            return false;
        }

        if (ENV_PRODUCTION !== APPLICATION_ENV && $exception instanceof Exception) {
            throw $exception;
        }

        $dispatcher->forward([
            'controller' => 'error',
            'action' => 'route500'
        ]);

        return $event->isStopped();
    }
}
