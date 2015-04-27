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

use Phalcon\Builder\Controller;
use Phalcon\Web\Tools;

/**
 * Simple
 *
 * Builder to create Simple application skeletons
 *
 * @package     Phalcon\Builder\Project
 * @copyright   Copyright (c) 2011-2015 Phalcon Team (team@phalconphp.com)
 * @license     New BSD License
 */
class Simple extends ProjectBuilder
{

    private $_dirs = array(
        'app',
        'app/cache',
        'app/views',
        'app/config',
        'app/models',
        'app/controllers',
        'app/views/index',
        'app/views/layouts',
        'public',
        'public/img',
        'public/css',
        'public/temp',
        'public/files',
        'public/js',
        '.phalcon'
    );

    /**
     * Create indexController file
     *
     * @param string $path Path to the project root
     */
    private function createControllerFile($path)
    {
        $modelBuilder = new Controller(array(
            'name' => 'index',
            'directory' => $path,
            'controllersDir' => $path . 'app/controllers',
            'baseClass' => 'ControllerBase'
        ));
        $modelBuilder->build();
    }

    /**
     * Create .htaccess files by default of application
     *
     * @param string $path Path to the project root
     * @param string $templatePath Path to the template
     */
    private function createHtaccessFiles($path, $templatePath)
    {

        if (file_exists($path . '.htaccess') == false) {
            $code = '<IfModule mod_rewrite.c>'.PHP_EOL.
                "\t".'RewriteEngine on'.PHP_EOL.
                "\t".'RewriteRule  ^$ public/    [L]'.PHP_EOL.
                "\t".'RewriteRule  (.*) public/$1 [L]'.PHP_EOL.
                '</IfModule>';
            file_put_contents($path.'.htaccess', $code);
        }

        if (file_exists($path . 'public/.htaccess') == false) {
            file_put_contents($path.'public/.htaccess', file_get_contents($templatePath . '/project/simple/htaccess'));
        }

        if (file_exists($path.'index.html') == false) {
            $code = '<html><body><h1>Mod-Rewrite is not enabled</h1><p>Please enable rewrite module on your web server to continue</body></html>';
            file_put_contents($path.'index.html', $code);
        }

    }

    /**
     * Create view files by default
     *
     * @param string $path Path to the project root
     * @param string $templatePath Path to the template
     */
    private function createIndexViewFiles($path, $templatePath)
    {
        $getFile = $templatePath . '/project/simple/views/index.volt';
        $putFile = $path.'app/views/index.volt';
        $this->generateFile($getFile, $putFile);

        $getFile = $templatePath . '/project/simple/views/index/index.volt';
        $putFile = $path.'app/views/index/index.volt';
        $this->generateFile($getFile, $putFile);
    }

    /**
     * Creates the configuration
     *
     * @param string $path Path to the project root
     * @param string $templatePath Path to the template
     * @param string $name Name of the application
     * @param string $type Config type
     */
    private function createConfig($path, $templatePath, $name, $type)
    {
        $getFile = $templatePath . '/project/simple/config.' . $type;
        $putFile = $path . 'app/config/config.' . $type;
        $this->generateFile($getFile, $putFile, $name);

        $getFile = $templatePath . '/project/simple/loader.php';
        $putFile = $path . 'app/config/loader.php';
        $this->generateFile($getFile, $putFile, $name);

        $getFile = $templatePath . '/project/simple/services.php';
        $putFile = $path . 'app/config/services.php';
        $this->generateFile($getFile, $putFile, $name);
    }

    /**
     * Create ControllerBase
     *
     * @param string $path Path to the project root
     * @param string $templatePath Path to the template
     * @param string $name Name of the application
     */
    private function createControllerBase($path, $templatePath, $name)
    {
        $getFile = $templatePath . '/project/simple/ControllerBase.php';
        $putFile = $path . 'app/controllers/ControllerBase.php';
        $this->generateFile($getFile, $putFile, $name);
    }

    /**
     * Create Bootstrap file by default of application
     *
     * @param string $path Path to the project root
     * @param string $templatePath Path to the template
     */
    private function createBootstrapFile($path, $templatePath)
    {
        $getFile = $templatePath . '/project/simple/index.php';
        $putFile = $path . 'public/index.php';
        $this->generateFile($getFile, $putFile);
    }

    /**
     * Build project
     *
     * @param string $path Path to the project root
     * @param string $templatePath Path to the template
     * @param string $name Name of the application
     * @param array $options Options
     *
     * @return bool
     */
    public function build($path, $templatePath, $name, array $options)
    {

        $this->buildDirectories($this->_dirs,$path);

        $this->getVariableValues($options);

        if (isset($options['useConfigIni']) && $options['useConfigIni']) {
            $this->createConfig($path, $templatePath, $name, 'ini');
        } else {
            $this->createConfig($path, $templatePath, $name, 'php');
        }

        $this->createBootstrapFile($path, $templatePath);
        $this->createHtaccessFiles($path, $templatePath);
        $this->createControllerBase($path, $templatePath, $name);
        $this->createIndexViewFiles($path, $templatePath);
        $this->createControllerFile($path, $templatePath);

        if ($options['enableWebTools']) {
            Tools::install($path);
        }

        return true;
    }

}
