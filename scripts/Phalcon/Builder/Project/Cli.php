<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2015 Phalcon Team (http://www.phalconphp.com)       |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file docs/LICENSE.txt.                        |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  |          Serghei Iakovlev <sadhooklay@gmail.com>                       |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Builder\Project;

use Phalcon\Script\Color;

/**
 * Cli
 *
 * Builder to create Cli application skeletons
 *
 * @package     Phalcon\Builder\Project
 * @copyright   Copyright (c) 2011-2015 Phalcon Team (team@phalconphp.com)
 * @license     New BSD License
 */
class Cli extends ProjectBuilder
{
    /**
     * Project directories
     * @var array
     */
    protected $projectDirectories = array(
        'app',
        'app/config',
        'app/tasks',
        '.phalcon',
    );

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
        $getFile = $this->options->get('templatePath') . '/project/cli/cli.php';
        $putFile = $this->options->get('projectPath') . 'app/cli.php';
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
