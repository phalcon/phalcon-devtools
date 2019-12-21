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

namespace Phalcon\DevTools;

use DirectoryIterator;
use Phalcon\DevTools\Builder\Exception\BuilderException;
use Phalcon\DevTools\Commands\Command;
use Phalcon\DevTools\Commands\CommandsException;
use Phalcon\DevTools\Script\Color;
use Phalcon\DevTools\Script\ScriptException;
use Phalcon\Events\Manager as EventsManager;

/**
 * Component that allows you to write scripts to use CLI.
 */
class Script
{
    /**
     * Events Manager
     *
     * @var EventsManager
     */
    protected $eventsManager;

    /**
     * Commands attached to the Script
     *
     * @var Command[]
     */
    protected $commands;

    /**
     * Script Constructor
     *
     * @param EventsManager $eventsManager
     */
    public function __construct(EventsManager $eventsManager)
    {
        $this->commands = [];
        $this->eventsManager = $eventsManager;
    }

    /**
     * Events Manager
     *
     * @param EventsManager $eventsManager
     */
    public function setEventsManager(EventsManager $eventsManager)
    {
        $this->eventsManager = $eventsManager;
    }

    /**
     * Returns the events manager
     *
     * @return EventsManager
     */
    public function getEventsManager()
    {
        return $this->eventsManager;
    }

    /**
     * Adds commands to the Script
     *
     * @param Command $command
     */
    public function attach(Command $command): void
    {
        $this->commands[] = $command;
    }

    /**
     * Returns the commands registered in the script
     *
     * @return Command[]
     */
    public function getCommands(): array
    {
        return $this->commands;
    }

    /**
     * Dispatch the Command
     *
     * @param Command $command
     * @return bool
     */
    public function dispatch(Command $command): bool
    {
        // If beforeCommand fails abort
        if ($this->eventsManager->fire('command:beforeCommand', $command) === false) {
            return false;
        }

        // If run the commands fails abort too
        try {
            $return = true;
            $command->run($command->getParameters());
        } catch (BuilderException $builderException) {
            echo Color::error($builderException->getMessage());
            $return = false;
        } catch (CommandsException $commandsException) {
            echo Color::error($commandsException->getMessage());
            $return = false;
        }

        $this->eventsManager->fire('command:afterCommand', $command);

        return $return;
    }

    /**
     * Run the scripts
     *
     * @throws ScriptException
     */
    public function run()
    {
        if (!isset($_SERVER['argv'][1])) {
            $_SERVER['argv'][1] = 'commands';
        }

        $input = $_SERVER['argv'][1];

        // Force `commands` command
        if (in_array(strtolower(trim($input)), ['-h', '--help', 'help'], true)) {
            $input = $_SERVER['argv'][1] = 'commands';
        }

        if (in_array(strtolower(trim($input)), ['--version', '-v', '--info'], true)) {
            $input = $_SERVER['argv'][1] = 'info';
        }

        // Try to dispatch the command
        foreach ($this->commands as $command) {
            if ($command->hasIdentifier($input)) {
                return $this->dispatch($command);
            }
        }

        // Check for alternatives
        $available = [];
        foreach ($this->commands as $command) {
            $providedCommands = $command->getCommands();
            foreach ($providedCommands as $alias) {
                $soundex = soundex($alias);
                if (!isset($available[$soundex])) {
                    $available[$soundex] = [];
                }

                $available[$soundex][] = $alias;
            }
        }

        // Show exception with/without alternatives
        $soundex = soundex($input);
        $message = sprintf('%s is not a recognized command.', $input);

        if (isset($available[$soundex])) {
            throw new ScriptException(sprintf('%s Did you mean: %s?', $message, join(' or ', $available[$soundex])));
        }

        throw new ScriptException($message);
    }

    public function loadUserScripts(): void
    {
        if (!file_exists('.phalcon/project.ini')) {
            return;
        }

        $config = parse_ini_file('.phalcon/project.ini');

        if (!isset($config['scripts'])) {
            return;
        }

        foreach (explode(',', $config['scripts']) as $directory) {
            if (!is_dir($directory)) {
                throw new ScriptException("Cannot load user scripts in directory '" . $directory . "'");
            }

            $iterator = new DirectoryIterator($directory);
            foreach ($iterator as $item) {
                if ($item->isDir() || $item->isDot()) {
                    continue;
                }

                /** @noinspection PhpIncludeInspection */
                require $item->getPathname();

                $className = preg_replace('/\.php$/', '', $item->getBasename());
                if (!class_exists($className)) {
                    throw new ScriptException(
                        sprintf(
                            "Expecting class '%s' to be located at '%s'",
                            $className,
                            $item->getPathname()
                        )
                    );
                }

                $this->attach(new $className($this, $this->eventsManager));
            }
        }
    }
}
