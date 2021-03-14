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

use Phalcon\Db\Adapter\Pdo\AbstractPdo;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class DatabaseProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'db';

    /**
     * Registers a service provider.
     *
     * @param DiInterface $di
     */
    public function register(DiInterface $di): void
    {
        $di->setShared($this->providerName, function () {
            /** @var DiInterface $this */

            $em = $this->getShared('eventsManager');

            if ($this->getShared('config')->offsetExists('database')) {
                $config = $this->getShared('config')->get('database')->toArray();
            } else {
                $dbname = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'phalcon.sqlite';
                $this->getShared('logger')->warning(
                    'Unable to initialize "db" service. Used Sqlite adapter at path: {path}',
                    ['path' => $dbname]
                );

                $config = [
                    'adapter' => 'Sqlite',
                    'dbname'  => $dbname,
                ];
            }

            $adapter = 'Phalcon\Db\Adapter\Pdo\\' . $config['adapter'];

            $params = [
                'host'     => $config['host'],
                'username' => $config['username'],
                'password' => $config['password'],
                'dbname'   => $config['dbname'],
                'charset'  => $config['charset'],
                'port'     => $config['port'],
            ];

            if ($config['adapter'] == 'Postgresql' || $config['adapter'] == 'Sqlite') {
                unset($params['charset']);
            }

            /** @var AbstractPdo $connection */
            $connection = new $adapter($params);
            $connection->setEventsManager($em);

            return $connection;
        });
    }
}
