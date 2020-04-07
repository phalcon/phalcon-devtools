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

        if (true === in_array($driver, [ 'mysql', 'pgsql' ])) {

            $codeceptionDataFile = PATH_DATA . 'acceptance' .
                DIRECTORY_SEPARATOR . $driver .
                DIRECTORY_SEPARATOR . 'config.php';

            $targetWebtoolFile = PROJECT_PATH . 'webtools' .
                DIRECTORY_SEPARATOR . 'app' .
                DIRECTORY_SEPARATOR . 'config' .
                DIRECTORY_SEPARATOR . 'config.php';

            copy($codeceptionDataFile, $targetWebtoolFile);

            //Replace config data from env
            $content = file_get_contents($targetWebtoolFile);
            $content = str_replace('getenv(\'MYSQL_DB_PORT\')', getenv('MYSQL_DB_PORT'), $content);
            $content = str_replace('getenv(\'MYSQL_DB_PASSWORD\')', getenv('MYSQL_DB_PASSWORD'), $content);
            $content = str_replace('getenv(\'POSTGRES_DB_PORT\')', getenv('POSTGRES_DB_PORT'), $content);
            file_put_contents('msghistory.txt', $content);
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
