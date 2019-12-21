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
use Phalcon\Di\FactoryDefault;
use Phalcon\Registry;

/**
 * Serve Command
 *
 * Launch the built-in PHP development server
 */
class Serve extends Command
{
    const DEFAULT_HOSTNAME      = '0.0.0.0';
    const DEFAULT_PORT          = '8000';
    const DEFAULT_BASE_PATH     = '.htrouter.php';
    const DEFAULT_DOCUMENT_ROOT = 'public';

    protected $hostname =      '';
    protected $port =          '';
    protected $base_path =     '';
    protected $document_root = '';
    protected $config =        '';

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams(): array
    {
        return [
            'hostname=s'        => 'Server Hostname [default='.self::DEFAULT_HOSTNAME.']',
            'port=s'            => 'Server Port [default='.self::DEFAULT_PORT.']',
            'basepath=s'        => 'Project entry-point [default='.self::DEFAULT_BASE_PATH.']',
            'rootpath=s'        => 'Document Root (public assets) [default='.self::DEFAULT_DOCUMENT_ROOT.']',
            'config=s'          => 'Server configuration ini [optional]',
            'help'              => 'Shows this help [optional]',
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @param array $parameters
     */
    public function run(array $parameters): void
    {
        $di = new FactoryDefault();
        $di['registry'] = function () {
            return new Registry();
        };

        $cmd = $this->shellCommand();
        print Color::head("Starting Server with $cmd") . PHP_EOL . PHP_EOL;
        passthru($cmd);
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function prepareOptions(): void
    {
        $this->hostname      = $this->getOption(['hostname', 1], null, self::DEFAULT_HOSTNAME);
        $this->port          = $this->getOption(['port',     2], null, self::DEFAULT_PORT);
        $this->base_path     = $this->getOption(['basepath', 3], null, self::DEFAULT_BASE_PATH);
        $this->document_root = $this->getOption(['rootpath', 4], null, self::DEFAULT_DOCUMENT_ROOT);
        $this->config        = $this->customConfig($this->getOption(['config']));
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function printServerDetails(): void
    {
        print Color::head('Preparing Development Server') . PHP_EOL;
        print Color::colorize("  Host: $this->hostname", Color::FG_GREEN) . PHP_EOL;
        print Color::colorize("  Port: $this->port", Color::FG_GREEN) . PHP_EOL;
        print Color::colorize("  Base: $this->base_path", Color::FG_GREEN) . PHP_EOL;
        print Color::colorize("  Document Root: $this->document_root", Color::FG_GREEN) . PHP_EOL;
        if ($this->config != null) {
            print Color::colorize("   ini: $$this->config", Color::FG_GREEN) . PHP_EOL;
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function shellCommand(): string
    {
        $systemInfo = new SystemInfo();
        $binary_path = $systemInfo->getEnvironment()['PHP Bin'];

        $this->prepareOptions();
        $this->printServerDetails();

        return sprintf(
            '%s -S %s:%s -t %s -t %s %s',
            $binary_path,
            $this->hostname,
            $this->port,
            $this->base_path,
            $this->document_root,
            $this->config
        );
    }

    /**
     * {@inheritdoc}
     *
     * @param  mixed $config
     * @return string
     */
    protected function customConfig($config): string
    {
        if ($config === null) {
            return '';
        }

        return sprintf('-c %s', $config);
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getCommands(): array
    {
        return ['serve', 'server'];
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function getHelp(): void
    {
        print Color::head('Help:') . PHP_EOL;
        print Color::colorize('  Launch the built-in PHP development server') . PHP_EOL . PHP_EOL;

        print Color::head('Usage:') . PHP_EOL;
        print Color::colorize('  serve [hostname='.self::DEFAULT_HOSTNAME.
                '] [port='.self::DEFAULT_PORT.
                '] [entrypoint='.self::DEFAULT_BASE_PATH.
                '] [document-root='.self::DEFAULT_DOCUMENT_ROOT.']', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

        print Color::head('Arguments:') . PHP_EOL;
        print Color::colorize('  help', Color::FG_GREEN);
        print Color::colorize("\t\tShows this help text") . PHP_EOL . PHP_EOL;

        $this->printParameters($this->getPossibleParams());
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

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getHostname(): string
    {
        return $this->hostname;
    }

    /**
     * {@inheritdoc}
     *
     * @return int|string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getBasePath(): string
    {
        return $this->base_path;
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getDocumentRoot(): string
    {
        return $this->document_root;
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getConfigPath(): string
    {
        return $this->config;
    }
}
