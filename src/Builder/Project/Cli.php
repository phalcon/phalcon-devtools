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
use Phalcon\DevTools\Script\Color;

/**
 * Builder to create Cli application skeletons
 */
class Cli extends ProjectBuilder
{
    /**
     * Project directories
     *
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
     * Build project
     *
     * @return bool
     * @throws BuilderException
     */
    public function build(): bool
    {
        $this
            ->buildDirectories()
            ->getVariableValues()
            ->createConfig()
            ->createBootstrapFiles()
            ->createDefaultTasks()
            ->createLauncher();

        $sprintMessage = 'You can create a symlink to %s to invoke the application';
        print Color::success(sprintf($sprintMessage, $this->options->get('projectPath') . 'run')) . PHP_EOL;

        return true;
    }

    /**
     * Create a launcher file to launch the application simply with ./project/application
     *
     * @return $this
     */
    private function createLauncher()
    {
        $getFile = $this->options->get('templatePath') .
            DIRECTORY_SEPARATOR . 'project' .
            DIRECTORY_SEPARATOR . 'cli' .
            DIRECTORY_SEPARATOR . 'launcher';

        $putFile = $this->options->get('projectPath') . 'run';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));
        chmod($putFile, 0755);

        if (stripos(PHP_OS, 'WIN') === 0) {
            $getFile = $this->options->get('templatePath') .
                DIRECTORY_SEPARATOR . 'project' .
                DIRECTORY_SEPARATOR . 'cli' .
                DIRECTORY_SEPARATOR . 'launcher.bat';
            $putFile = $this->options->get('projectPath') . 'run.bat';
            $this->generateFile($getFile, $putFile, $this->options->get('name'));
        }

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

        $controllerBuilder = new ControllerBuilder([
            'name' => 'Main',
            'suffix' => 'Task',
            'directory' => $this->options->get('projectPath'),
            'controllersDir' => $this->options->get('projectPath') . 'app/tasks/',
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
            'controllersDir' => $this->options->get('projectPath') . 'app/tasks/',
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
     * Create Bootstrap file by default of application
     *
     * @return $this
     */
    private function createBootstrapFiles()
    {
        $getFile = $this->options->get('templatePath') . '/project/cli/bootstrap.php';
        $putFile = $this->options->get('projectPath') . 'app/bootstrap.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        return $this;
    }

    /**
     * Creates the configuration
     *
     * @return $this
     */
    private function createConfig()
    {
        $type = $this->options->get('useConfigIni') ? 'ini' : 'php';

        $getFile = $this->options->get('templatePath') . '/project/cli/config.' . $type;
        $putFile = $this->options->get('projectPath') . 'app/config/config.' . $type;
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/cli/services.php';
        $putFile = $this->options->get('projectPath') . 'app/config/services.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        $getFile = $this->options->get('templatePath') . '/project/cli/loader.php';
        $putFile = $this->options->get('projectPath') . 'app/config/loader.php';
        $this->generateFile($getFile, $putFile, $this->options->get('name'));

        return $this;
    }
}
