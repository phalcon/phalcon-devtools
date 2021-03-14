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

use Phalcon\DevTools\Resources\AssetsResource;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class AssetsResourceProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'resource';

    /**
     * Registers a service provider.
     *
     * @param DiInterface $di
     */
    public function register(DiInterface $di): void
    {
        $di->setShared($this->providerName, function () {
            return new AssetsResource();
        });
    }
}
