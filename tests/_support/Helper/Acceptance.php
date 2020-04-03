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
            copy(PATH_DATA . 'acceptance' .
                DIRECTORY_SEPARATOR . $driver .
                DIRECTORY_SEPARATOR . 'config.php', PROJECT_PATH . 'webtools/app/config/config.php');
            $data = htmlentities(file_get_contents(PROJECT_PATH . 'webtools/app/config/config.php'));
            echo $data;
            echo '---';
            $data = htmlentities(file_get_contents(PATH_DATA . 'acceptance' .
                DIRECTORY_SEPARATOR . $driver .
                DIRECTORY_SEPARATOR . 'config.php'));
            echo $data;
            echo '---';
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
