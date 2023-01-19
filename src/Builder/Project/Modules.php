<?php
declare(strict_types=1);

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Phalcon\DevTools\Builder\Project;

use Phalcon\DevTools\Builder\Component\Controller as ControllerBuilder;
use Phalcon\DevTools\Builder\Exception\BuilderException;
use Phalcon\DevTools\Web\Tools;

/**
 * Multi-Module
 *
 * Builder to create Multi-Module application skeletons
 *
 * @package Phalcon\Builder\Project
 */
class Modules extends ProjectBuilder
{
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
     * Build project
     *
     * @return bool
     * @throws BuilderException
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

        if ($this->options->has('enableWebTools')) {
            Tools::install($this->options->get('projectPath'));
        }

        return true;
    }

    /**
     * Create indexController file
     *
     * @return $this
     * @throws BuilderException
     */
    private function createControllerFile()
    {
        $controllerBuilder = new ControllerBuilder([
            'name' => 'index',
            'directory' => $this->options->get('projectPath'),
            'controllersDir' => $this->options->get('projectPath') . 'app/modules/frontend/controllers/',
            'namespace' => "{$this->getNamespace()}\Modules\Frontend\Controllers",
            'baseClass' => "{$this->getNamespace()}\Modules\Frontend\Controllers\ControllerBase",
        ]);

        $controllerBuilder->build(['indexAction' => []])->write();

        return $this;
    }

    /**
     * Create view files by default
     *
     * @return $this
     */
    private function createIndexViewFiles()
    {
        $engine = $this->options->get('templateEngine') === 'volt' ? 'volt' : 'phtml';

        $getFile = $this->options->get('templatePath') . '/project/modules/views/index.' . $engine;
        $putFile = $this->options->get('projectPath') . 'app/modules/frontend/views/index.' . $engine;
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/modules/views/index/index.' . $engine;
        $putFile = $this->options->get('projectPath') . 'app/modules/frontend/views/index/index.' . $engine;
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
     * Create Default Tasks
     *
     * @return $this
     * @throws BuilderException
     */
    private function createDefaultTasks()
    {
        $extends = '\Phalcon\Cli\Task';
        $namespace = "{$this->getNamespace()}\Modules\Cli\Tasks";

        $controllerBuilder = new ControllerBuilder([
            'name' => 'Main',
            'suffix' => 'Task',
            'directory' => $this->options->get('projectPath'),
            'controllersDir' => $this->options->get('projectPath') . 'app/modules/cli/tasks/',
            'namespace' => $namespace,
            'baseClass' => $extends,
            'force' => true,
        ]);
        $controllerBuilder->build(['mainAction' => [
            'body' => 'echo "Congratulations! You are now flying with Phalcon CLI!";',
        ]])->write();

        $controllerBuilder = new ControllerBuilder([
            'name' => 'Version',
            'suffix' => 'Task',
            'directory' => $this->options->get('projectPath'),
            'controllersDir' => $this->options->get('projectPath') . 'app/modules/cli/tasks/',
            'namespace' => $namespace,
            'baseClass' => $extends,
            'force' => true,
        ]);
        $controllerBuilder->build(['mainAction' => [
            'body' => function () {
                $config = $this->getDI()->get('config');

                echo $config['version'];
            },
        ]])->write();

        return $this;
    }

    /**
     * Create ControllerBase
     *
     * @return $this
     * @throws BuilderException
     */
    private function createControllerBase()
    {
        $controllerBuilder = new ControllerBuilder([
            'name' => 'ControllerBase',
            'directory' => $this->options->get('projectPath'),
            'controllersDir' => $this->options->get('projectPath') . 'app/modules/frontend/controllers',
            'namespace' => "{$this->getNamespace()}\Modules\Frontend\Controllers",
            'baseClass' => '\Phalcon\Mvc\Controller',
            'suffix' => '',
        ]);

        $controllerBuilder->build()->write();

        return $this;
    }

    /**
     * Create .htaccess files by default of application
     *
     * @return $this
     */
    private function createHtaccessFiles()
    {
        if (!file_exists($this->options->get('projectPath') . '.htaccess')) {
            $code = '<IfModule mod_rewrite.c>' . PHP_EOL .
                "\t" . 'RewriteEngine on' . PHP_EOL .
                "\t" . 'RewriteRule  ^$ public/    [L]' . PHP_EOL .
                "\t" . 'RewriteRule  (.*) public/$1 [L]' . PHP_EOL .
                '</IfModule>';
            file_put_contents($this->options->get('projectPath') . '.htaccess', $code);
        }

        if (!file_exists($this->options->get('projectPath') . 'public/.htaccess')) {
            file_put_contents(
                $this->options->get('projectPath') . 'public/.htaccess',
                file_get_contents($this->options->get('templatePath') . '/project/modules/htaccess')
            );
        }

        if (!file_exists($this->options->get('projectPath') . 'index.html')) {
            $code = '<html><body><h1>Mod-Rewrite is not enabled</h1>' .
                '<p>Please enable rewrite module on your web server to continue</body></html>';
            file_put_contents($this->options->get('projectPath') . 'index.html', $code);
        }

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

        if (stripos(PHP_OS, 'WIN') === 0) {
            $getFile = $this->options->get('templatePath') . '/project/modules/launcher.bat';
            $putFile = $this->options->get('projectPath') . 'run.bat';
            $this->generateFile($getFile, $putFile, $this->options->get('name'));
        }

        return $this;
    }

    /**
     * Creates the app/configuration
     *
     * @return $this
     */
    private function createConfig()
    {
        $type = $this->options->get('useConfigIni') ? 'ini' : 'php';

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
}
