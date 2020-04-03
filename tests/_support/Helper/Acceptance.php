<?php

namespace Helper;

use Codeception\Module;
use Codeception\TestInterface;

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

    public function _initialize()
    {
        $this->projectPath = tests_path('_data/acceptance/' . $this->projectName);
    }

    public function _before(TestInterface $test)
    {
        $driver = $test->getMetadata()->getCurrent('env');
        if (!empty($driver)) {
            $this->driver = $driver;
        }

      /*  print_r(scandir(getenv('WEB_TOOLS_PROJECT')));
        echo '-----';
        print_r(scandir(getenv('HOME')));
        echo '-----';*/
        echo '-----';
        echo getenv('MYSQL_TEST_DB_HOST');
        echo '-----';
        echo getenv('MYSQL_TEST_DB_USER');
        echo '-----';
        echo getenv('MYSQL_TEST_DB_PASSWORD');
        echo '-----';
        echo getenv('MYSQL_TEST_DB_DATABASE');
        echo '-----';
        echo getenv('MYSQL_TEST_DB_PORT');
        echo '-----';
        echo '-----';
        echo getenv('POSTGRES_TEST_DB_HOST');
        echo '-----';
        echo getenv('POSTGRES_TEST_DB_USER');
        echo '-----';
        echo getenv('POSTGRES_TEST_DB_PASSWORD');
        echo '-----';
        echo getenv('POSTGRES_TEST_DB_PORT');
        echo '-----';
        echo getenv('POSTGRES_TEST_DB_DATABASE');

        if (true === in_array($driver, [ 'mysql', 'pgsql' ])) {
            copy(PATH_DATA . 'acceptance' .
                DIRECTORY_SEPARATOR . $driver .
                DIRECTORY_SEPARATOR . 'config.php', PROJECT_PATH . 'webtools/app/config/config.php');
        }

        parent::_before($test);

        //shell_exec('phalcon project --directory=' . $this->projectPath);
    }

    public function _after(TestInterface $test)
    {
        parent::_after($test);

        //shell_exec('rm -rf ' . $this->projectPath);
    }
}
