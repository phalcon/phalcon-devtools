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

namespace Phalcon\DevTools\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Mvc\Dispatcher as MvcDispatcher;
use Phalcon\Mvc\Dispatcher\Exception as DispatchErrorHandler;

class DispatcherProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'dispatcher';

    /**
     * Registers a service provider.
     *
     * @param DiInterface $di
     */
    public function register(DiInterface $di): void
    {
        /** @var EventsManager $eventsManager */
        $eventsManager = $di->getShared('eventsManager');
        $access = $di->getShared('access');

        $di->setShared($this->providerName, function () use ($eventsManager, $access) {
            $dispatcher = new MvcDispatcher;
            $dispatcher->setDefaultNamespace('Phalcon\DevTools\Web\Tools\Controllers');

            $eventsManager->attach('dispatch', $access, 1000);
            $eventsManager->attach('dispatch:beforeException', new DispatchErrorHandler, 999);

            $dispatcher->setEventsManager($eventsManager);

            return $dispatcher;
        });
    }
}
