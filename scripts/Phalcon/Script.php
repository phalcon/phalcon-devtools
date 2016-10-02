<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (https://www.phalconphp.com)      |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  |          Serghei Iakovlev <serghei@phalconphp.com>                     |
  +------------------------------------------------------------------------+
*/

namespace Phalcon;

use DirectoryIterator;
use Phalcon\Commands\Command;
use Phalcon\Script\ScriptException;
use Phalcon\Events\Manager as EventsManager;

/**
 * \Phalcon\Script
 *
 * Component that allows you to write scripts to use CLI.
 *
 * @package Phalcon
 */
class Script
{
    /**
     * Events Manager
     *
     * @var \Phalcon\Events\Manager
     */
    protected $_eventsManager;

    /**
     * Commands attached to the Script
     *
     * @var \Phalcon\Commands\Command[]
     */
    protected $_commands;

    /**
     * Script Constructor
     *
     * @param \Phalcon\Events\Manager $eventsManager
     */
    public function __construct(EventsManager $eventsManager)
    {
        $this->_commands = [];
        $this->_eventsManager = $eventsManager;
    }

    /**
     * Events Manager
     *
     * @param \Phalcon\Events\Manager $eventsManager
     */
    public function setEventsManager(EventsManager $eventsManager)
    {
        $this->_eventsManager = $eventsManager;
    }

    /**
     * Returns the events manager
     *
     * @return \Phalcon\Events\Manager
     */
    public function getEventsManager()
    {
        return $this->_eventsManager;
    }

    /**
     * Adds commands to the Script
     *
     * @param \Phalcon\Commands\Command $command
     */
    public function attach(Command $command)
    {
        $this->_commands[] = $command;
    }

    /**
     * Returns the commands registered in the script
     *
     * @return \Phalcon\Commands\Command[]
     */
    public function getCommands()
    {
        return $this->_commands;
    }

    /**
     * Dispatch the Command
     *
     * @param Command $command
     * @return bool
     */
    public function dispatch(Command $command)
    {
        // If beforeCommand fails abort
        if ($this->_eventsManager->fire('command:beforeCommand', $command) === false) {
            return false;
        }

        // If run the commands fails abort too
        if ($command->run($command->getParameters()) === false) {
            return false;
        }

        $this->_eventsManager->fire('command:afterCommand', $command);

        return true;
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
        foreach ($this->_commands as $command) {
            if ($command->hasIdentifier($input)) {
                return $this->dispatch($command);
            }
        }

        // Check for alternatives
        $available = [];
        foreach ($this->_commands as $command) {
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

    public function loadUserScripts()
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

                $this->attach(new $className($this, $this->_eventsManager));
            }
        }
    }
}
