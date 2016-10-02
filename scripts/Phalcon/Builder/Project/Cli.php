<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (https://www.phalconphp.com)      |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  |          Serghei Iakovlev <serghei@phalconphp.com>                     |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Builder\Project;

use Phalcon\Script\Color;

/**
 * Cli
 *
 * Builder to create Cli application skeletons
 *
 * @package Phalcon\Builder\Project
 */
class Cli extends ProjectBuilder
{
    /**
     * Project directories
     * @var array
     */
    protected $projectDirectories = [
        'app',
        'app/config',
        'app/tasks',
        'app/models',
        '.phalcon',
    ];

    /**
     * Creates the configuration
     *
     * @return $this
     */
    private function createConfig()
    {
        $type = $this->options->contains('useConfigIni') ? 'ini' : 'php';

        $getFile = $this->options->get('templatePath') . '/project/cli/config.' . $type;
        $putFile = $this->options->get('projectPath') . 'app/config/config.' . $type;
        $this->generateFile($getFile, $putFile);

        $getFile = $this->options->get('templatePath') . '/project/cli/services.php';
        $putFile = $this->options->get('projectPath') . 'app/config/services.php';
        $this->generateFile($getFile, $putFile);

        $getFile = $this->options->get('templatePath') . '/project/cli/loader.php';
        $putFile = $this->options->get('projectPath') . 'app/config/loader.php';
        $this->generateFile($getFile, $putFile);

        return $this;
    }

    /**
     * Create Bootstrap file by default of application
     *
     * @return $this
     */
    private function createBootstrapFiles()
    {
        $getFile = $this->options->get('templatePath') . '/project/cli/bootstrap.php';
        $putFile = $this->options->get('projectPath') . 'app/bootstrap.php';
        $this->generateFile($getFile, $putFile);

        return $this;
    }

    /**
     * Create Default Tasks
     *
     * @return $this
     */
    private function createDefaultTasks()
    {
        $getFile = $this->options->get('templatePath') . '/project/cli/MainTask.php';
        $putFile = $this->options->get('projectPath') . 'app/tasks/MainTask.php';
        $this->generateFile($getFile, $putFile);

        $getFile = $this->options->get('templatePath') . '/project/cli/VersionTask.php';
        $putFile = $this->options->get('projectPath') . 'app/tasks/VersionTask.php';
        $this->generateFile($getFile, $putFile);

        return $this;
    }

    /**
     * Create a launcher file to launch the application simply with ./project/application
     *
     * @return $this
     */
    private function createLauncher()
    {
        $getFile = $this->options->get('templatePath') . '/project/cli/launcher';
        $putFile = $this->options->get('projectPath') . 'run';
        $this->generateFile($getFile, $putFile);
        chmod($putFile, 0755);

        return $this;
    }

    /**
     * Build project
     *
     * @return bool
     */
    public function build()
    {
        $this
            ->buildDirectories()
            ->getVariableValues()
            ->createConfig()
            ->createBootstrapFiles()
            ->createDefaultTasks()
            ->createLauncher();

        print Color::success(sprintf('You can create a symlink to %s to invoke the application', $this->options->get('projectPath') . 'run')) . PHP_EOL;

        return true;
    }
}
