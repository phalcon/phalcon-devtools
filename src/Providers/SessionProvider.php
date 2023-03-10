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
use Phalcon\Session\Adapter\Stream as SessionStream;
use Phalcon\Session\Manager;

class SessionProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'session';

    /**
     * Registers a service provider.
     *
     * @param DiInterface $di
     */
    public function register(DiInterface $di): void
    {
        $di->setShared($this->providerName, function () {
            $files = new SessionStream([
                'savePath' => sys_get_temp_dir(),
            ]);

            $session = new Manager();
            $session->setAdapter($files);
            $session->start();

            return $session;
        });
    }
}
