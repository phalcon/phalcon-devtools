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
 * Multi-Module
 *
 * Builder to create Multi-Module application skeletons
 *
 * @package     Phalcon\Builder\Project
 * @copyright   Copyright (c) 2011-2015 Phalcon Team (team@phalconphp.com)
 * @license     New BSD License
 */
class Modules extends ProjectBuilder
{
    private $_dirs = array(
        'apps/',
        'apps/frontend',
        'apps/frontend/views',
        'apps/frontend/config',
        'apps/frontend/models',
        'apps/frontend/migrations',
        'apps/frontend/controllers',
        'apps/frontend/views/index',
        'apps/frontend/views/layouts',
        'config/',
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
     * @param string $name Name of the application
     */
    private function createControllerFile($path, $name)
    {
        $modelBuilder = new Controller(array(
            'name'           => 'index',
            'controllersDir' => $path . 'apps/frontend/controllers/',
            'namespace'      => ucfirst($name) . '\Frontend\Controllers',
            'baseClass'      => 'ControllerBase'
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
            $code = '<IfModule mod_rewrite.c>' . PHP_EOL .
                "\t" . 'RewriteEngine on' . PHP_EOL .
                "\t" . 'RewriteRule  ^$ public/    [L]' . PHP_EOL .
                "\t" . 'RewriteRule  (.*) public/$1 [L]' . PHP_EOL .
                '</IfModule>';
            file_put_contents($path . '.htaccess', $code);
        }

        if (file_exists($path . 'public/.htaccess') == false) {
            file_put_contents($path . 'public/.htaccess', file_get_contents($templatePath . '/project/modules/htaccess'));
        }

        if (file_exists($path . 'index.html') == false) {
            $code = '<html><body><h1>Mod-Rewrite is not enabled</h1><p>Please enable rewrite module on your web server to continue</body></html>';
            file_put_contents($path . 'index.html', $code);
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
        $getFile = $templatePath . '/project/modules/views/index.phtml';
        $putFile = $path . 'apps/frontend/views/index.phtml';
        $this->generateFile($getFile, $putFile);

        $getFile = $templatePath . '/project/modules/views/index/index.phtml';
        $putFile = $path . 'apps/frontend/views/index/index.phtml';
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
        $getFile = $templatePath . '/project/modules/config.' . $type;
        $putFile = $path . 'apps/frontend/config/config.' . $type;
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
        $getFile = $templatePath . '/project/modules/ControllerBase.php';
        $putFile = $path . 'apps/frontend/controllers/ControllerBase.php';
        $this->generateFile($getFile, $putFile, $name);
    }

    /**
     * Create ControllerBase
     *
     * @param string $path Path to the project root
     * @param string $templatePath Path to the template
     * @param string $name Name of the application
     */
    private function createModule($path, $templatePath, $name)
    {
        $getFile = $templatePath . '/project/modules/Module.php';
        $putFile = $path . 'apps/frontend/Module.php';
        $this->generateFile($getFile, $putFile, $name);
    }

    /**
     * Create Bootstrap file by default of application
     *
     * @param string $name Name of the application
     * @param string $path Path to the project root
     * @param string $templatePath Path to the template
     */
    private function createBootstrapFile($name, $path, $templatePath)
    {
        $getFile = $templatePath . '/project/modules/index.php';
        $putFile = $path . 'public/index.php';
        $this->generateFile($getFile, $putFile, $name);

        $getFile = $templatePath . '/project/modules/services.php';
        $putFile = $path . 'config/services.php';
        $this->generateFile($getFile, $putFile, $name);

        $getFile = $templatePath . '/project/modules/modules.php';
        $putFile = $path . 'config/modules.php';
        $this->generateFile($getFile, $putFile, $name);

        $getFile = $templatePath . '/project/modules/routes.php';
        $putFile = $path . 'config/routes.php';
        $this->generateFile($getFile, $putFile, $name);
    }

    /**
     * Build project
     *
     * @param string $name Name of the application
     * @param string $path Path to the project root
     * @param string $templatePath Path to the template
     * @param array $options Options
     *
     * @return bool
     */
    public function build($path, $templatePath, $name, array $options)
    {
        $this->buildDirectories($this->_dirs, $path);

        $this->getVariableValues($options);

        if (isset($options['useConfigIni']) && $options['useConfigIni']) {
            $this->createConfig($path, $templatePath, $name, 'ini');
        } else {
            $this->createConfig($path, $templatePath, $name, 'php');
        }

        $this->createBootstrapFile($name, $path, $templatePath);
        $this->createHtaccessFiles($path, $templatePath);
        $this->createControllerBase($path, $templatePath, $name);
        $this->createModule($path, $templatePath, $name);
        $this->createIndexViewFiles($path, $templatePath);
        $this->createControllerFile($path, $name);

        if ($options['enableWebTools']) {
            Tools::install($path);
        }

        return true;
    }
}
