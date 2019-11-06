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

namespace Phalcon\DevTools\Commands\Builtin;

use Phalcon\DevTools\Builder\Component\Project as ProjectBuilder;
use Phalcon\DevTools\Builder\Exception\BuilderException;
use Phalcon\DevTools\Commands\Command;
use Phalcon\DevTools\Script\Color;

/**
 * Project Command
 *
 * Creates project skeletons
*/
class Project extends Command
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams(): array
    {
        return [
            'name=s'            => 'Name of the new project',
            'enable-webtools'   => 'Determines if webtools should be enabled [optional]',
            'directory=s'       => 'Base path on which project will be created [optional]',
            'type=s'            => 'Type of the application to be generated (cli, micro, simple, modules)',
            'template-path=s'   => 'Specify a template path [optional]',
            'template-engine=s' => 'Define the template engine, default phtml (phtml, volt) [optional]',
            'use-config-ini'    => 'Use a ini file as configuration file [optional]',
            'trace'             => 'Shows the trace of the framework in case of exception [optional]',
            'help'              => 'Shows this help [optional]',
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @param array $parameters
     * @return mixed
     * @throws BuilderException
     */
    public function run(array $parameters)
    {
        $projectName    = $this->getOption(['name', 1], null, 'default');
        $projectType    = $this->getOption(['type', 2], null, 'simple');
        $projectPath    = $this->getOption(['directory', 3], null, '.');
        $templatePath   = $this->getOption(['template-path'], null, TEMPLATE_PATH);
        $enableWebtools = $this->getOption(['enable-webtools', 4], null, false);
        $useConfigIni   = $this->getOption('use-config-ini');
        $templateEngine = $this->getOption(['template-engine'], null, "phtml");

        $builder = new ProjectBuilder([
            'name'           => $projectName,
            'type'           => $projectType,
            'directory'      => $projectPath,
            'enableWebTools' => $enableWebtools,
            'templatePath'   => $templatePath,
            'templateEngine' => $templateEngine,
            'useConfigIni'   => $useConfigIni
        ]);

        return $builder->build();
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getCommands(): array
    {
        return ['project', 'create-project'];
    }

    /**
     * {@inheritdoc}
     *
     * @return bool
     */
    public function canBeExternal(): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function getHelp(): void
    {
        print Color::head('Help:') . PHP_EOL;
        print Color::colorize('  Creates a project') . PHP_EOL . PHP_EOL;

        print Color::head('Usage:') . PHP_EOL;
        print Color::colorize('  project [name] [type] [directory] [enable-webtools]', Color::FG_GREEN)
            . PHP_EOL . PHP_EOL;

        print Color::head('Arguments:') . PHP_EOL;
        print Color::colorize('  help', Color::FG_GREEN);
        print Color::colorize("\tShows this help text") . PHP_EOL . PHP_EOL;

        print Color::head('Example') . PHP_EOL;
        print Color::colorize('  phalcon project store simple', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

        $this->printParameters($this->getPossibleParams());
    }

    /**
     * {@inheritdoc}
     *
     * @return int
     */
    public function getRequiredParams(): int
    {
        return 1;
    }
}
