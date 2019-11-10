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
use Phalcon\Flash\Session as FlashSession;

class FlashSessionProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'flashSession';

    /**
     * Registers a service provider.
     *
     * @param DiInterface $di
     */
    public function register(DiInterface $di): void
    {
        $cssClasses = [
            'error'   => 'alert alert-danger fade in',
            'success' => 'alert alert-success fade in',
            'notice'  => 'alert alert-info fade in',
            'warning' => 'alert alert-warning fade in',
        ];

        $di->setShared($this->providerName, function () use ($cssClasses) {
            $flash = new FlashSession();
            $flash->setAutoescape(false);
            $flash->setCssClasses($cssClasses);

            return $flash;
        });
    }
}
