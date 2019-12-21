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

use Phalcon\DevTools\Builder\Component\Controller as ControllerBuilder;
use Phalcon\DevTools\Builder\Exception\BuilderException;
use Phalcon\DevTools\Commands\Command;
use Phalcon\DevTools\Script\Color;

/**
 * Controller Command
 *
 * Create a handler for the command line.
 */
class Controller extends Command
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams(): array
    {
        return [
            'name=s'        => 'Controller name',
            'namespace=s'   => "Controller's namespace [option]",
            'directory=s'   => 'Base path on which project is located [optional]',
            'output=s'      => 'Directory where the controller should be created [optional]',
            'base-class=s'  => 'Base class to be inherited by the controller [optional]',
            'force'         => 'Force to rewrite controller [optional]',
            'help'          => 'Shows this help [optional]',
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
        $controllerBuilder = new ControllerBuilder([
            'name' => $this->getOption(['name', 1]),
            'directory' => $this->getOption('directory'),
            'controllersDir' => $this->getOption('output'),
            'namespace' => $this->getOption('namespace'),
            'baseClass' => $this->getOption('base-class', null, '\\' . \Phalcon\Mvc\Controller::class),
            'force' => $this->isReceivedOption('force')
        ]);

        return $controllerBuilder->build();
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getCommands(): array
    {
        return ['controller', 'create-controller'];
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function getHelp(): void
    {
        print Color::head('Help:') . PHP_EOL;
        print Color::colorize('  Creates a controller') . PHP_EOL . PHP_EOL;

        print Color::head('Usage:') . PHP_EOL;
        print Color::colorize('  controller [name] [directory]', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

        print Color::head('Arguments:') . PHP_EOL;
        print Color::colorize('  help', Color::FG_GREEN);
        print Color::colorize("\tShows this help text") . PHP_EOL . PHP_EOL;

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
