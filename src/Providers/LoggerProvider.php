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
use Phalcon\Logger;
use Phalcon\Logger\Adapter\Stream as FileLogger;
use Phalcon\Logger\Adapter\Syslog;
use Phalcon\Logger\Formatter\Line as LineFormatter;

class LoggerProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'logger';

    /**
     * Registers a service provider.
     *
     * @param DiInterface $di
     */
    public function register(DiInterface $di): void
    {
        $application = $di->getShared('application');
        $hostName = $application->getHostName();
        $basePath = $application->getBasePath();

        $di->setShared($this->providerName, function () use ($hostName, $basePath) {
            $ptoolsPath = $basePath . DS . '.phalcon' . DS;
            if (is_dir($ptoolsPath) && is_writable($ptoolsPath)) {
                $formatter = new LineFormatter("%date% {$hostName} php: [%type%] %message%", 'D j H:i:s');
                $adapter = new FileLogger($ptoolsPath . 'devtools.log');
            } else {
                $formatter = new LineFormatter("[devtools@{$hostName}]: [%type%] %message%", 'D j H:i:s');
                $adapter = new Syslog('php://stderr');
            }

            $adapter->setFormatter($formatter);

            return new Logger('messages', ['main' => $adapter]);
        });
    }
}
