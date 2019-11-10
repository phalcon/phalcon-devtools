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

use Phalcon\DevTools\Access\Manager as AccessManager;
use Phalcon\DevTools\Access\Policy\Ip as IpPolicy;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class AccessManagerProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'access';

    /**
     * Registers a service provider.
     *
     * @param DiInterface $di
     */
    public function register(DiInterface $di): void
    {
        $ptoolsIp = $di->getShared('application')->getPtoolsIp();

        $di->setShared($this->providerName, function () use ($ptoolsIp) {
            $policy = new IpPolicy($ptoolsIp);

            return new AccessManager($policy);
        });
    }
}
