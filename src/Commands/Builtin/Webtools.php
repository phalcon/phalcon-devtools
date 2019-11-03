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
use Phalcon\DevTools\Commands\CommandsException;
use Phalcon\DevTools\Script\Color;
use Phalcon\DevTools\Web\Tools;
use Phalcon\Exception;

/**
 * Webtools Command
 *
 * Enables/disables webtools in a project
 */
class Webtools extends Command
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams(): array
    {
        return [
            'action=s' => 'Enables/Disables webtools in a project [enable|disable]',
            'help'     => 'Shows this help [optional]',
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @param array $parameters
     * @throws CommandsException
     * @throws Exception
     * @throws \Exception
     */
    public function run(array $parameters): void
    {
        $action = $this->getOption(['action', 1]);
        $directory = './';

        if ($action == 'enable') {
            if (file_exists($directory . 'public/webtools.php')) {
                throw new CommandsException('Webtools are already enabled!');
            }

            Tools::install($directory);

            echo Color::success('Webtools successfully enabled!');
        } elseif ($action == 'disable') {
            if (!file_exists($directory . 'public/webtools.php')) {
                throw new CommandsException('Webtools are already disabled!');
            }

            Tools::uninstall($directory);

            echo Color::success('Webtools successfully disabled!');
        } else {
            throw new CommandsException('Invalid action!');
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getCommands(): array
    {
        return ['webtools', 'create-webtools'];
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function getHelp(): void
    {
        echo Color::head('Help:') . PHP_EOL;
        echo Color::colorize('  Enables/disables webtools in a project') . PHP_EOL . PHP_EOL;

        print Color::head('Usage: Enable webtools') . PHP_EOL;
        print Color::colorize('  webtools enable', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

        print Color::head('Usage: Disable webtools') . PHP_EOL;
        print Color::colorize('  webtools disable', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

        echo Color::head('Arguments:') . PHP_EOL;
        echo Color::colorize('  help', Color::FG_GREEN);
        echo Color::colorize("\tShows this help text") . PHP_EOL . PHP_EOL;

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
