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

use Phalcon\Cache;
use Phalcon\Cache\AdapterFactory;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Storage\SerializerFactory;

class CacheProvider extends AbstractProvider implements ServiceProviderInterface
{
    protected $providerName = '';

    /**
     * Registers a service provider.
     *
     * @param DiInterface $di
     */
    public function register(DiInterface $di): void
    {
        $instanceName = 'stream';
        $serializerFactory = new SerializerFactory();
        $adapterFactory = new AdapterFactory($serializerFactory);

        $di->set('viewCache', function () use ($adapterFactory, $instanceName) {
            $adapter = $adapterFactory->newInstance($instanceName);

            return new Cache($adapter);
        });

        $di->setShared('modelsCache', function () use ($adapterFactory, $instanceName) {
            $adapter = $adapterFactory->newInstance($instanceName);

            return new Cache($adapter);
        });

        $di->setShared('dataCache', function () use ($adapterFactory, $instanceName) {
            $adapter = $adapterFactory->newInstance($instanceName);

            return new Cache($adapter);
        });
    }
}
