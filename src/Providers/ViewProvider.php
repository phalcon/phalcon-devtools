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

use Phalcon\DevTools\Mvc\View\NotFoundListener;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php;
use Phalcon\Registry;

class ViewProvider implements ServiceProviderInterface
{
    /**
     * Registers a service provider.
     *
     * @param DiInterface $di
     */
    public function register(DiInterface $di): void
    {
        $di->setShared('view', function () {
            /**
             * @var DiInterface $this
             * @var Registry $registry
             */

            $view = new View;
            $registry = $this->getShared('registry');

            $view->registerEngines([
                '.volt' => $this->getShared('volt', [$view, $this]),
                '.phtml' => Php::class
            ]);

            $view->setViewsDir($registry->offsetGet('directories')->webToolsViews . DS)
                ->setLayoutsDir('layouts' . DS)
                ->setRenderLevel(View::LEVEL_AFTER_TEMPLATE);

            $em = $this->getShared('eventsManager');
            $em->attach('view', new NotFoundListener);

            $view->setEventsManager($em);

            return $view;
        });
    }
}