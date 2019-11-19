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
        parent::_before($test);

        //shell_exec('phalcon project --directory=' . $this->projectPath);
    }

    public function _after(TestInterface $test)
    {
        parent::_after($test);

        //shell_exec('rm -rf ' . $this->projectPath);
    }
}
