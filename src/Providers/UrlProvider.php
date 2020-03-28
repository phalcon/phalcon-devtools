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

use Phalcon\Config;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Url as UrlResolver;

class UrlProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'url';

    /**
     * Registers a service provider.
     *
     * @param DiInterface $di
     */
    public function register(DiInterface $di): void
    {
        $di->setShared($this->providerName, function () {
            /** @var DiInterface $this */
            $config = $this->getShared('config');

            $url = new UrlResolver;

            if ($config->get('application', new Config)->offsetExists('baseUri')) {
                $baseUri = $config->get('application', new Config)->get('baseUri');
            } elseif ($config->offsetExists('baseUri')) {
                $baseUri = $config->get('baseUri');
            } else {
                // @todo Log notice here
                $baseUri = '/';
            }

            if ($config->get('application', new Config)->offsetExists('staticUri')) {
                $staticUri = $config->get('application', new Config)->get('staticUri');
            } elseif ($config->offsetExists('staticUri')) {
                $staticUri = $config->get('staticUri');
            } else {
                // @todo Log notice here
                $staticUri = '/';
            }

            $url->setBaseUri($baseUri);
            $url->setStaticBaseUri($staticUri);

            return $url;
        });
    }
}
