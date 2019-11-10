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

use DirectoryIterator;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\Router\Annotations as AnnotationsRouter;

class RouterProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'router';

    /**
     * Registers a service provider.
     *
     * @param DiInterface $di
     */
    public function register(DiInterface $di): void
    {
        $ptoolsPath = $di->getShared('application')->getPtoolsPath();

        $di->setShared($this->providerName, function () use ($ptoolsPath) {
            /** @var DiInterface $this */
            $em = $this->getShared('eventsManager');

            $router = new AnnotationsRouter(false);
            $router->removeExtraSlashes(true);
            $router->notFound(['controller' => 'error', 'action' => 'route404']);
            $router->setDefaultAction('index');
            $router->setDefaultController('index');
            $router->setDefaultNamespace('Phalcon\DevTools\Web\Tools\Controllers');

            // @todo Use Path::normalize()
            $controllersDir = $ptoolsPath . DS . str_replace('/', DS, 'src/Web/Tools/Controllers');
            $dir = new DirectoryIterator($controllersDir);

            $resources = [];

            foreach ($dir as $fileInfo) {
                if ($fileInfo->isDot() || false === strpos($fileInfo->getBasename(), 'Controller.php')) {
                    continue;
                }

                $controller = $fileInfo->getBasename('Controller.php');
                $resources[] = $controller;
            }

            foreach ($resources as $controller) {
                $router->addResource($controller);
            }

            $router->setEventsManager($em);

            return $router;
        });
    }
}
