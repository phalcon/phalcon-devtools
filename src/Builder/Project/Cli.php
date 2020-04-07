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
        $this->generateFile($getFile, $putFile);
        chmod($putFile, 0755);

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $getFile = $this->options->get('templatePath') .
                DIRECTORY_SEPARATOR . 'project' .
                DIRECTORY_SEPARATOR . 'cli' .
                DIRECTORY_SEPARATOR . 'launcher.bat';
            $putFile = $this->options->get('projectPath') . 'run.bat';
            $this->generateFile($getFile, $putFile);
        }

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
     * Creates the configuration
     *
     * @return $this
     */
    private function createConfig()
    {
        $type = $this->options->get('useConfigIni') ? 'ini' : 'php';

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
}
