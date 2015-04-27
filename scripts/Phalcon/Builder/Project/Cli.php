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

    private $_dirs = array(
        'app',
        'app/config',
        'app/tasks',
        '.phalcon',
    );

    /**
     * Creates the configuration
     *
     * @param string $path Path to the project root
     * @param string $templatePath Path to the template
     */
    private function createConfig($path, $templatePath)
    {
        $getFile = $templatePath . '/project/cli/config.php';
        $putFile = $path . 'app/config/config.php';
        $this->generateFile($getFile, $putFile);

        $getFile = $templatePath . '/project/cli/services.php';
        $putFile = $path . 'app/config/services.php';
        $this->generateFile($getFile, $putFile);

        $getFile = $templatePath . '/project/cli/loader.php';
        $putFile = $path . 'app/config/loader.php';
        $this->generateFile($getFile, $putFile);
    }

    /**
     * Create Bootstrap file by default of application
     *
     * @param string $path Path to the project root
     * @param string $templatePath Path to the template
     */
    private function createBootstrapFiles($path, $templatePath)
    {
        $getFile = $templatePath . '/project/cli/cli.php';
        $putFile = $path . 'app/cli.php';
        $this->generateFile($getFile, $putFile);
    }

    /**
     * Create Default Tasks
     *
     * @param string $path Path to the project root
     * @param string $templatePath Path to the template
     */
    private function createDefaultTasks($path, $templatePath)
    {
        $getFile = $templatePath . '/project/cli/MainTask.php';
        $putFile = $path . 'app/tasks/MainTask.php';
        $this->generateFile($getFile, $putFile);

        $getFile = $templatePath . '/project/cli/VersionTask.php';
        $putFile = $path . 'app/tasks/VersionTask.php';
        $this->generateFile($getFile, $putFile);
    }

    /**
     * Create a launcher file to launch the application simply with ./project/application
     *
     * @param string $name Name of the application
     * @param string $path Path to the project root
     * @param string $templatePath Path to the template
     */
    private function createLauncher($name, $path, $templatePath)
    {
        $getFile = $templatePath . '/project/cli/launcher';
        $putFile = $path . $name;
        $this->generateFile($getFile, $putFile);
        chmod($putFile , 0755);
    }

    /**
     * Build project
     *
     * @param string $path Path to the project root
     * @param string $templatePath Path to the template
     * @param string $name Name of the application
     * @param array $options
     *
     * @return bool
     */
    public function build($path, $templatePath, $name, array $options)
    {

        $this->buildDirectories($this->_dirs,$path);

        $this->getVariableValues($options);

        $this->createConfig($path, $templatePath);

        /*if (isset($options['useConfigIni']) && $options['useConfigIni']) {
            $this->createConfig($path, $templatePath, 'ini');
        } else {
            $this->createConfig($path, $templatePath, 'php');
        }*/

        $this->createBootstrapFiles($path, $templatePath);

        $this->createDefaultTasks($path, $templatePath);

        $this->createLauncher($name,$path,$templatePath);

        $pathSymLink = realpath( $path . $name );

        print Color::success("You can create a symlink to $pathSymLink to invoke the application") . PHP_EOL;

        return true;
    }

}
