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

use Phalcon\DevTools\Commands\Command;
use Phalcon\DevTools\Script\Color;
use Psy\Configuration;
use Psy\Shell;

/**
 * Console Command
 */
class Console extends Command
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams(): array
    {
        return [
            'include=s' => 'Script to include [optional]',
            'help' => 'Shows this help [optional]',
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @param array $parameters
     * @return mixed
     */
    public function run(array $parameters)
    {
        $config = new Configuration;
        $shell = new Shell($config);

        if ($this->isReceivedOption('include')) {
            $shell->setIncludes([substr($this->getOption('include'), 2)]);
        }

        $shell->run();

        return 0;
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getCommands(): array
    {
        return ['console', 'shell', 'psysh'];
    }

    /**
     * {@inheritdoc}
     *
     * @return boolean
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
        print Color::colorize('  Start a runtime developer console') . PHP_EOL . PHP_EOL;
        $this->printParameters($this->getPossibleParams());
    }

    /**
     * {@inheritdoc}
     *
     * @return integer
     */
    public function getRequiredParams(): int
    {
        return 0;
    }
}
