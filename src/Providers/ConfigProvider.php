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
use Phalcon\DevTools\Scanners\Config as ConfigScanner;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class ConfigProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'config';

    /**
     * Registers a service provider.
     *
     * @param DiInterface $di
     */
    public function register(DiInterface $di): void
    {
        $basePath = $di->getShared('application')->getBasePath();
        $di->setShared($this->providerName, function () use ($basePath) {
            $scanner = new ConfigScanner($basePath);
            $config = $scanner->load('config');

            if (ENV_PRODUCTION !== APPLICATION_ENV) {
                $override = $scanner->scan(APPLICATION_ENV);
                if ($override instanceof Config) {
                    $config->merge($override);
                }
            }
            return $config;
        });
    }
}
