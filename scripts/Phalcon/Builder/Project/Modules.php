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
  |          David Schissler <david.schissler@gmail.com>                   |
  |          Serghei Iakovlev <serghei@phalconphp.com>                     |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Builder\Project;

use Phalcon\Web\Tools;
use Phalcon\Builder\Controller as ControllerBuilder;

/**
 * Multi-Module
 *
 * Builder to create Multi-Module application skeletons
 *
 * @package Phalcon\Builder\Project
 */
class Modules extends ProjectBuilder
{
    use ProjectAware;

    /**
     * Project directories
     * @var array
     */
    protected $projectDirectories = [
        'app/',
        'app/config',
        'app/common',
        'app/common/models',
        'app/common/library',
        'app/modules',
        'app/modules/frontend',
        'app/modules/frontend/views',
        'app/modules/frontend/models',
        'app/modules/frontend/controllers',
        'app/modules/frontend/views/index',
        'app/modules/frontend/views/layouts',
        'app/modules/cli',
        'app/modules/cli/migrations',
        'app/modules/cli/tasks',
        'cache',
        'cache/volt',
        'public',
        'public/img',
        'public/css',
        'public/temp',
        'public/files',
        'public/js',
        '.phalcon'
    ];

    /**
     * Create indexController file
     *
     * @return $this
     */
    private function createControllerFile()
    {
        $namespace = $this->options->get('name');
        if (strtolower(trim($namespace)) == 'default') {
            $namespace = 'MyDefault';
        }

        $builder = new ControllerBuilder([
            'name'           => 'index',
            'controllersDir' => $this->options->get('projectPath') . 'app/modules/frontend/controllers/',
            'namespace'      => ucfirst($namespace) . '\Modules\Frontend\Controllers',
            'baseClass'      => 'ControllerBase'
        ]);

        $builder->build();

        return $this;
    }

    /**
     * Create Default Tasks
     *
     * @return $this
     */
    private function createDefaultTasks()
    {
        $getFile = $this->options->get('templatePath') . '/project/modules/MainTask.php';
        $putFile = $this->options->get('projectPath') . 'app/modules/cli/tasks/MainTask.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/modules/VersionTask.php';
        $putFile = $this->options->get('projectPath') . 'app/modules/cli/tasks/VersionTask.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

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
            $code = '<html><body><h1>Mod-Rewrite is not enabled</h1>' .
                '<p>Please enable rewrite module on your web server to continue</body></html>';
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
        $engine = $this->options->get('templateEngine') == 'volt' ? 'volt' : 'phtml';

        $getFile = $this->options->get('templatePath') . '/project/modules/views/index.' . $engine;
        $putFile = $this->options->get('projectPath') . 'app/modules/frontend/views/index.' . $engine;
        $this->generateFile($getFile, $putFile);

        $getFile = $this->options->get('templatePath') . '/project/modules/views/index/index.' . $engine;
        $putFile = $this->options->get('projectPath') . 'app/modules/frontend/views/index/index.' . $engine;
        $this->generateFile($getFile, $putFile);

        return $this;
    }

    /**
     * Creates the app/configuration
     *
     * @return $this
     */
    private function createConfig()
    {
        $type = $this->options->contains('useConfigIni') ? 'ini' : 'php';

        $getFile = $this->options->get('templatePath') . '/project/modules/config.' . $type;
        $putFile = $this->options->get('projectPath') . 'app/config/config.' . $type;
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/modules/loader.php';
        $putFile = $this->options->get('projectPath') . 'app/config/loader.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/modules/routes.php';
        $putFile = $this->options->get('projectPath') . 'app/config/routes.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/modules/services.php';
        $putFile = $this->options->get('projectPath') . 'app/config/services.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/modules/services_web.php';
        $putFile = $this->options->get('projectPath') . 'app/config/services_web.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/modules/services_cli.php';
        $putFile = $this->options->get('projectPath') . 'app/config/services_cli.php';
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
        $putFile = $this->options->get('projectPath') . 'app/modules/frontend/controllers/ControllerBase.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        return $this;
    }

    /**
     * Create Module
     *
     * @return $this
     */
    private function createModules()
    {
        $getFile = $this->options->get('templatePath') . '/project/modules/Module_web.php';
        $putFile = $this->options->get('projectPath') . 'app/modules/frontend/Module.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/modules/Module_cli.php';
        $putFile = $this->options->get('projectPath') . 'app/modules/cli/Module.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        return $this;
    }

    /**
     * Create application bootstrap files for cli and web environments
     *
     * @return $this
     */
    private function createBootstrapFiles()
    {
        $getFile = $this->options->get('templatePath') . '/project/modules/bootstrap_web.php';
        $putFile = $this->options->get('projectPath') . 'app/bootstrap_web.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/modules/index.php';
        $putFile = $this->options->get('projectPath') . 'public/index.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/modules/bootstrap_cli.php';
        $putFile = $this->options->get('projectPath') . 'app/bootstrap_cli.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/modules/launcher';
        $putFile = $this->options->get('projectPath') . 'run';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));
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
            ->createHtaccessFiles()
            ->createControllerBase()
            ->createDefaultTasks()
            ->createModules()
            ->createIndexViewFiles()
            ->createControllerFile()
            ->createHtrouterFile();

        $this->options->contains('enableWebTools') && Tools::install($this->options->get('projectPath'));

        return true;
    }
}
