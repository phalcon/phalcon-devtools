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

use Phalcon\DevTools\Builder\Component\Module as ModuleBuilder;
use Phalcon\DevTools\Builder\Exception\BuilderException;
use Phalcon\DevTools\Commands\Command;
use Phalcon\DevTools\Script\Color;

/**
 * Module Command
 *
 * Create a module from command line
 */
class Module extends Command
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams(): array
    {
        return [
            'name'            => 'Name of the new module',
            'namespace=s'     => "Module's namespace [optional]",
            'output=s'        => 'Folder where modules are located [optional]',
            'config-type=s'   => 'The config type to be generated (ini, json, php, yaml) [optional]',
            'template-path=s' => 'Specify a template path [optional]',
            'help'            => 'Shows this help [optional]',

        ];
    }

    /**
     * {@inheritdoc}
     *
     * @param array $parameters
     * @throws BuilderException
     */
    public function run(array $parameters): void
    {
        $moduleName   = $this->getOption(['name', 1]);
        $namespace    = $this->getOption('namespace', null, 'Application');
        $configType   = $this->getOption('config-type', null, 'php');
        $modulesDir   = $this->getOption('output');
        $templatePath = $this->getOption('template-path', null, TEMPLATE_PATH . DIRECTORY_SEPARATOR . 'module');

        $builder = new ModuleBuilder([
            'name'         => $moduleName,
            'namespace'    => $namespace,
            'config-type'  => $configType,
            'templatePath' => $templatePath,
            'modulesDir'   => $modulesDir
        ]);

        $builder->build();
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getCommands(): array
    {
        return ['module', 'create-module'];
    }

    /**
     * {@inheritdoc}
     *
     * @return boolean
     */
    public function canBeExternal(): bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function getHelp(): void
    {
        print Color::head('Help:') . PHP_EOL;
        print Color::colorize('  Creates a module') . PHP_EOL . PHP_EOL;

        print Color::head('Example') . PHP_EOL;
        print Color::colorize('  phalcon module backend', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

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
