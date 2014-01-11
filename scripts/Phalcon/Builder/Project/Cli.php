<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2014 Phalcon Team (http://www.phalconphp.com)       |
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
 * Builder to create cli application skeletons
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2014 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
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
     * @param $path
     * @param $templatePath
     * @param $type
     */
    private function createConfig($path, $templatePath, $type)
    {
        if (file_exists($path . 'app/config/config.' . $type) == false) {
            $str = file_get_contents($templatePath . '/project/cli/config.' . $type);
            file_put_contents($path . 'app/config/config.' . $type, $str);
        }

        if (file_exists($path . 'app/config/services.php') == false) {
            $str = file_get_contents($templatePath . '/project/cli/services.php');
            file_put_contents($path . 'app/config/services.php', $str);
        }

        if (file_exists($path . 'app/config/loader.php') == false) {
            $str = file_get_contents($templatePath . '/project/cli/loader.php');
            file_put_contents($path . 'app/config/loader.php', $str);
        }
    }

    /**
     * Create Bootstrap file by default of application
     *
     * @param $path
     * @param $templatePath
     * @param $useIniConfig
     */
    private function createBootstrapFiles($path, $templatePath, $useIniConfig)
    {
        if (file_exists($path . 'app/cli.php') == false) {

            if ($useIniConfig)
                $config = '$config = new \Phalcon\Config\Adapter\Ini(__DIR__ . "/config/config.ini");';
            else
                $config = '$config = include __DIR__ . "/config/config.php";';

            $str = file_get_contents($templatePath . '/project/cli/cli.php');
            file_put_contents($path . 'app/cli.php', $str);
        }
    }

    /**
     * Create Default Tasks
     *
     * @param $path
     * @param $templatePath
     */
    private function createDefaultTasks($path, $templatePath)
    {
        if (file_exists($path . 'app/tasks/MainTask.php') == false) {
            $str = file_get_contents($templatePath . '/project/cli/MainTask.php');
            file_put_contents($path . 'app/tasks/MainTask.php', $str);
        }

        if (file_exists($path . 'app/tasks/VersionTask.php') == false) {
            $str = file_get_contents($templatePath . '/project/cli/VersionTask.php');
            file_put_contents($path . 'app/tasks/VersionTask.php', $str);
        }
    }

    /**
     * Create a launcher file to launch the application simply with ./project/application
     *
     * @param $name string name of the application
     * @param $path string path to the project root
     * @param $templatePath
     */
    private function createLauncher($name,$path,$templatePath)
    {
        if (file_exists($path . $name) == false) {
            $str = file_get_contents($templatePath . '/project/cli/launcher');
            file_put_contents($path . $name , $str);
            chmod($path . $name , 0755);
        }
    }

    /**
     * Build project
     *
     * @param $name
     * @param $path
     * @param $templatePath
     * @param $options
     *
     * @return bool
     */
    public function build($name, $path, $templatePath, $options)
    {

        $this->buildDirectories($this->_dirs,$path);

        //Disable ini config
//        if (isset($options['useConfigIni']))
//            $useIniConfig = $options['useConfigIni'];
//        else
            $useIniConfig = false;

        if ($useIniConfig)
            $this->createConfig($path, $templatePath, 'ini');
        else
            $this->createConfig($path, $templatePath, 'php');

        $this->createBootstrapFiles($path, $templatePath,$useIniConfig);

        $this->createDefaultTasks($path, $templatePath);

        $this->createLauncher($name,$path,$templatePath);

        $pathSymLink = realpath( $path . $name );

        print Color::success("You can create a symlink to $pathSymLink to invoke the application") . PHP_EOL;

        return true;
    }

}
