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
use Phalcon\DevTools\Utils\SystemInfo;

/**
 * Info Command
 */
class Info extends Command
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams(): array
    {
        return [
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
        $info = new SystemInfo();

        printf("%s\n", Color::head('Environment:'));
        foreach ($info->getEnvironment() as $k => $v) {
            printf("  %s: %s\n", $k, $v);
        }

        printf("%s\n", Color::head('Versions:'));
        foreach ($info->getVersions() as $k => $v) {
            printf("  %s: %s\n", $k, $v);
        }

        print PHP_EOL;

        return 0;
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getCommands(): array
    {
        return ['info', 'i'];
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
        print Color::colorize('  Shows versions and environment configuration') . PHP_EOL . PHP_EOL;
    }

    /**
     * {@inheritdoc}
     *
     * @return int
     */
    public function getRequiredParams(): int
    {
        return 0;
    }
}
