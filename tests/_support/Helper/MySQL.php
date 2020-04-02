<?php

declare(strict_types=1);

namespace Helper;

use Codeception\Module;
use Codeception\TestInterface;
use PDO;
use Phalcon\Config;
use Phalcon\Db\Adapter\Pdo\AbstractPdo;
use Phalcon\Db\Adapter\PdoFactory;

class Acceptance extends Module
{
    /**
     * @var string
     */
    protected $projectName = 'web-tools-tests';

    /**
     * @var string
     */
    protected $projectPath;

    /**
     * @var AbstractPdo|null
     */
    protected static $phalconDb;

    public function _initialize()
    {
        $this->projectPath = tests_path('_data/mysql/' . $this->projectName);
        /** @var AbstractPdo $db */
        self::$phalconDb = (new PdoFactory())
            ->newInstance(
                'mysql',
                $this->getDevToolsConfig()->get('database')->toArray()
            );
    }

    public function _before(TestInterface $test)
    {
        parent::_before($test);

        //shell_exec('phalcon project --directory=' . $this->projectPath);
    }

    public function _after(TestInterface $test)
    {
        parent::_after($test);

        //shell_exec('rm -rf ' . $this->projectPath);
    }

    /**
     * @return PDO
     * @throws \Codeception\Exception\ModuleException
     */
    public function getDb(): PDO
    {
        return $this->getModule('Db')->_getDbh();
    }

    /**
     * @return AbstractPdo
     */
    public function getPhalconDb(): AbstractPdo
    {
        return self::$phalconDb;
    }

    /**
     * @return Config
     */
    public function getDevToolsConfig(): Config
    {
        return new Config([
            'database' => [
                'adapter' => 'mysql',
                'host' => getenv('MYSQL_TEST_DB_HOST'),
                'port' => getenv('MYSQL_TEST_DB_PORT'),
                'username' => getenv('MYSQL_TEST_DB_USER'),
                'password' => getenv('MYSQL_TEST_DB_PASSWORD'),
                'dbname' => getenv('MYSQL_TEST_DB_DATABASE'),
            ]
        ]);
    }
}
