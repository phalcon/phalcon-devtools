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

use Phalcon\Builder\Controller as ControllerBuilder;
use Phalcon\Web\Tools;
use Phalcon\Builder\Options;

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
    /**
     * Project directories
     * @var array
     */
    protected $projectDirectories = array(
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
     * @return $this
     */
    private function createControllerFile()
    {
        $builder = new ControllerBuilder(array(
            'name'           => 'index',
            'controllersDir' => $this->options->get('projectPath') . 'apps/frontend/controllers/',
            'namespace'      => ucfirst($this->options->get('name')) . '\Frontend\Controllers',
            'baseClass'      => 'ControllerBase'
        ));

        $builder->build();

        return $this;
    }

    /**
     * Create .htaccess files by default of application
     *
     * @return $this
     */
    private function createHtaccessFiles()
    {
        if (file_exists($this->options->get('projectPath') . '.htaccess') == false) {
            $code = '<IfModule mod_rewrite.c>' . PHP_EOL .
                "\t" . 'RewriteEngine on' . PHP_EOL .
                "\t" . 'RewriteRule  ^$ public/    [L]' . PHP_EOL .
                "\t" . 'RewriteRule  (.*) public/$1 [L]' . PHP_EOL .
                '</IfModule>';
            file_put_contents($this->options->get('projectPath') . '.htaccess', $code);
        }

        if (file_exists($this->options->get('projectPath') . 'public/.htaccess') == false) {
            file_put_contents(
                $this->options->get('projectPath') . 'public/.htaccess',
                file_get_contents($this->options->get('templatePath') . '/project/modules/htaccess')
            );
        }

        if (file_exists($this->options->get('projectPath') . 'index.html') == false) {
            $code = '<html><body><h1>Mod-Rewrite is not enabled</h1><p>Please enable rewrite module on your web server to continue</body></html>';
            file_put_contents($this->options->get('projectPath') . 'index.html', $code);
        }

        return $this;
    }

    /**
     * Create view files by default
     *
     * @return $this
     */
    private function createIndexViewFiles()
    {
        $getFile = $this->options->get('templatePath') . '/project/modules/views/index.phtml';
        $putFile = $this->options->get('projectPath') . 'apps/frontend/views/index.phtml';
        $this->generateFile($getFile, $putFile);

        $getFile = $this->options->get('templatePath') . '/project/modules/views/index/index.phtml';
        $putFile = $this->options->get('projectPath') . 'apps/frontend/views/index/index.phtml';
        $this->generateFile($getFile, $putFile);

        return $this;
    }

    /**
     * Creates the configuration
     *
     * @return $this
     */
    private function createConfig()
    {
        $type = $this->options->contains('useConfigIni') ? 'ini' : 'php';

        $getFile = $this->options->get('templatePath') . '/project/modules/config.' . $type;
        $putFile = $this->options->get('projectPath') . 'apps/frontend/config/config.' . $type;
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        return $this;
    }

    /**
     * Create ControllerBase
     *
     * @return $this
     */
    private function createControllerBase()
    {
        $getFile = $this->options->get('templatePath') . '/project/modules/ControllerBase.php';
        $putFile = $this->options->get('projectPath') . 'apps/frontend/controllers/ControllerBase.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        return $this;
    }

    /**
     * Create ControllerBase
     *
     * @return $this
     */
    private function createModule()
    {
        $getFile = $this->options->get('templatePath') . '/project/modules/Module.php';
        $putFile = $this->options->get('projectPath') . 'apps/frontend/Module.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        return $this;
    }

    /**
     * Create Bootstrap file by default of application
     *
     * @return $this
     */
    private function createBootstrapFile()
    {
        $getFile = $this->options->get('templatePath') . '/project/modules/index.php';
        $putFile = $this->options->get('projectPath') . 'public/index.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/modules/services.php';
        $putFile = $this->options->get('projectPath') . 'config/services.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/modules/modules.php';
        $putFile = $this->options->get('projectPath') . 'config/modules.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/modules/routes.php';
        $putFile = $this->options->get('projectPath') . 'config/routes.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        return $this;
    }

    /**
     * Create .htrouter.php file
     *
     * @return $this
     */
    private function createHtrouterFile()
    {
        $getFile = $this->options->get('templatePath') . '/project/modules/.htrouter.php';
        $putFile = $this->options->get('projectPath') . '.htrouter.php';
        $this->generateFile($getFile, $putFile);

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
            ->createBootstrapFile()
            ->createHtaccessFiles()
            ->createControllerBase()
            ->createModule()
            ->createIndexViewFiles()
            ->createControllerFile()
            ->createHtrouterFile();

        $this->options->contains('enableWebTools') && Tools::install($this->options->get('projectPath'));

        return true;
    }
}
