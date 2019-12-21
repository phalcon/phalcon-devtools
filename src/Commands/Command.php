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

namespace Phalcon\DevTools\Commands;

use Phalcon\Config;
use Phalcon\Config\Adapter\Ini as IniConfig;
use Phalcon\Config\Adapter\Json as JsonConfig;
use Phalcon\Config\Adapter\Yaml as YamlConfig;
use Phalcon\DevTools\Builder\Path;
use Phalcon\DevTools\Script;
use Phalcon\DevTools\Script\Color;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Filter;

abstract class Command implements CommandsInterface
{
    /**
     * Script
     *
     * @var Script
     */
    protected $script;

    /**
     * Events Manager
     *
     * @var EventsManager
     */
    protected $eventsManager;

    /**
     * Output encoding of the script.
     *
     * @var string
     */
    protected $encoding = 'UTF-8';

    /**
     * Parameters received by the script.
     *
     * @var array
     */
    protected $parameters = [];

    /**
     * Possible prepared arguments.
     *
     * @var array
     */
    protected $preparedArguments = [];

    /**
     * @var Path
     */
    protected $path;

    /**
     * @param Script $script
     * @param EventsManager $eventsManager
     */
    final public function __construct(Script $script, EventsManager $eventsManager)
    {
        $this->script = $script;
        $this->eventsManager = $eventsManager;
        $this->path = new Path();
    }

    /**
     * Events Manager
     *
     * @param EventsManager $eventsManager
     */
    public function setEventsManager(EventsManager $eventsManager): void
    {
        $this->eventsManager = $eventsManager;
    }

    /**
     * Returns the events manager
     *
     * @return EventsManager
     */
    public function getEventsManager(): EventsManager
    {
        return $this->eventsManager;
    }

    /**
     * Sets the script that will execute the command
     *
     * @param Script $script
     */
    public function setScript(Script $script): void
    {
        $this->script = $script;
    }

    /**
     * Returns the script that will execute the command
     *
     * @return Script
     */
    public function getScript(): Script
    {
        return $this->script;
    }

    /**
     * @param string $path Config path
     *
     * @return Config
     * @throws CommandsException
     */
    protected function getConfig(string $path): Config
    {
        foreach (['app/config/', 'config/'] as $configPath) {
            foreach (['ini', 'php', 'json', 'yaml', 'yml'] as $extension) {
                if (file_exists($path . $configPath . "config." . $extension)) {
                    return $this->loadConfig($path . $configPath . "/config." . $extension);
                }
            }
        }

        $directory = new \RecursiveDirectoryIterator('.');
        $iterator = new \RecursiveIteratorIterator($directory);
        foreach ($iterator as $f) {
            if (preg_match('/config\.(php|ini|json|yaml|yml)$/i', $f->getPathName())) {
                return $this->loadConfig($f->getPathName());
            }
        }

        throw new CommandsException("Builder can't locate the configuration file.");
    }

    /**
     * Determines correct adapter by file name
     * and load config
     *
     * @param string $fileName Config file name
     *
     * @return Config
     * @throws CommandsException
     */
    protected function loadConfig(string $fileName): Config
    {
        $pathInfo = pathinfo($fileName);

        if (!isset($pathInfo['extension'])) {
            throw new CommandsException("Config file extension not found.");
        }

        $extension = strtolower(trim($pathInfo['extension']));

        switch ($extension) {
            case 'php':
                $config = include($fileName);
                if (is_array($config)) {
                    $config = new Config($config);
                }

                return $config;

            case 'ini':
                return new IniConfig($fileName);

            case 'json':
                return new JsonConfig($fileName);

            case 'yaml':
            case 'yml':
                return new YamlConfig($fileName);

            default:
                throw new CommandsException("Builder can't locate the configuration file.");
        }
    }

    /**
     * Parse the parameters passed to the script.
     *
     * @param  array $parameters    Command parameters
     * @param  array $possibleAlias Command aliases
     * @return array
     *
     * @throws CommandsException
     *
     * @todo Refactor
     */
    public function parseParameters(array $parameters = [], $possibleAlias = []): array
    {
        if (count($parameters) == 0) {
            $parameters = $this->getPossibleParams();
        }

        $arguments = [];
        foreach ($parameters as $parameter => $description) {
            if (strpos($parameter, '=') !== false) {
                $parameterParts = explode('=', $parameter);
                if (count($parameterParts) !== 2) {
                    throw new CommandsException("Invalid definition for the parameter '$parameter'");
                }

                if (strlen($parameterParts[0]) == 0) {
                    throw new CommandsException("Invalid definition for the parameter '$parameter'");
                }

                if (!in_array($parameterParts[1], ['s', 'i', 'l'])) {
                    throw new CommandsException("Incorrect data type on parameter '$parameter'");
                }

                $this->preparedArguments[$parameterParts[0]] = true;
                $arguments[$parameterParts[0]] = [
                    'have-option' => true,
                    'option-required' => true,
                    'data-type' => $parameterParts[1],
                ];

                continue;
            }

            if (!preg_match('/([a-zA-Z0-9]+)/', $parameter)) {
                throw new CommandsException("Invalid parameter '$parameter'");
            }

            $this->preparedArguments[$parameter] = true;
            $arguments[$parameter] = [
                'have-option'     => false,
                'option-required' => false
            ];
        }

        $param = '';
        $paramName = '';
        $receivedParams = [];
        $numberArguments = count($_SERVER['argv']);

        for ($i = 1; $i < $numberArguments; $i++) {
            $argv = $_SERVER['argv'][$i];
            if (is_string($argv) &&
                preg_match('#^([\-]{1,2})([a-zA-Z0-9][a-zA-Z0-9\-]*)(=(.*)){0,1}$#', $argv, $matches)
            ) {
                if (strlen($matches[1]) == 1) {
                    $param = substr($matches[2], 1);
                    $paramName = substr($matches[2], 0, 1);
                } else {
                    if (strlen($matches[2]) < 2) {
                        throw new CommandsException("Invalid script parameter '$argv'");
                    }
                    $paramName = $matches[2];
                }

                if (!isset($this->preparedArguments[$paramName])) {
                    if (!isset($possibleAlias[$paramName])) {
                        throw new CommandsException("Unknown parameter '$paramName'");
                    }
                    $paramName = $possibleAlias[$paramName];
                }

                if (isset($arguments[$paramName])) {
                    if ($param != '') {
                        $receivedParams[$paramName] = $param;
                        $param = '';
                        $paramName = '';
                    }

                    if (!$arguments[$paramName]['have-option']) {
                        $receivedParams[$paramName] = true;
                    } elseif (isset($matches[4])) {
                        $receivedParams[$paramName] = $matches[4];
                    }
                }

                continue;
            }

            $param = $argv;
            if ($paramName != '') {
                /**
                 * @psalm-suppress InvalidArgument
                 */
                if (!empty($arguments[$paramName]['have-option']) && $param == '') {
                    throw new CommandsException("The parameter '$paramName' requires an option");
                }

                $receivedParams[$paramName] = $param;
                $param = '';
                $paramName = '';
            } else {
                $receivedParams[$i - 1] = $param;
                $param = '';
            }
        }

        foreach (['ini', 'php', 'json', 'yaml'] as $extension) {
            $customConfig = "config.{$extension}";
            if (file_exists($customConfig)) {
                $config = $this->loadConfig($customConfig);
                $commandName = $this->getCommands()[0];
                $optionsToMerge = $config->get($commandName);
                if (!empty($optionsToMerge)) {
                    $receivedParams = array_merge($optionsToMerge->toArray(), $receivedParams);
                }

                break;
            }
        }

        $this->parameters = $receivedParams;

        return $receivedParams;
    }

    /**
     * Sets the output encoding of the script.
     * @param string $encoding
     *
     * @return $this
     */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;

        return $this;
    }

    /**
     * Returns all received options.
     *
     * @param mixed $filters Filter name or array of filters [Optional]
     *
     * @return array
     */
    public function getOptions($filters = null): array
    {
        if (!$filters) {
            return $this->parameters;
        }

        $result = [];
        foreach ($this->parameters as $param) {
            $result[] = $this->filter($param, $filters);
        }

        return $result;
    }

    /**
     * Returns the value of an option received.
     *
     * @param mixed $option Option name or array of options
     * @param mixed $filters Filter name or array of filters [Optional]
     * @param mixed $defaultValue Default value [Optional]
     *
     * @return mixed
     */
    public function getOption($option, $filters = null, $defaultValue = null)
    {
        if (is_array($option)) {
            foreach ($option as $optionItem) {
                if (isset($this->parameters[$optionItem])) {
                    if ($filters !== null) {
                        return $this->filter($this->parameters[$optionItem], $filters);
                    }

                    return $this->parameters[$optionItem];
                }
            }

            return $defaultValue;
        }

        if (isset($this->parameters[$option])) {
            if ($filters !== null) {
                return $this->filter($this->parameters[$option], $filters);
            }

            return $this->parameters[$option];
        }

        return $defaultValue;
    }

    /**
     * Indicates whether the script was a particular option.
     *
     * @param string|string[] $option
     * @return bool
     */
    public function isReceivedOption($option): bool
    {
        if (!is_array($option)) {
            $option = [$option];
        }

        foreach ($option as $op) {
            if (isset($this->parameters[$op])) {
                return true;
            }
        }

        return false;
    }

    /**
     * Filters a value
     *
     * @param mixed $paramValue
     * @param array $filters
     *
     * @return mixed
     */
    protected function filter($paramValue, $filters)
    {
        $filter = new Filter();

        return $filter->sanitize($paramValue, $filters);
    }

    /**
     * Prints the available options in the script
     *
     * @param array $parameters
     */
    public function printParameters($parameters): void
    {
        $length = 0;
        foreach ($parameters as $parameter => $description) {
            if ($length == 0) {
                $length = strlen($parameter);
            }
            if (strlen($parameter) > $length) {
                $length = strlen($parameter);
            }
        }

        print Color::head('Options:') . PHP_EOL;
        foreach ($parameters as $parameter => $description) {
            print Color::colorize(' --' . $parameter . str_repeat(' ', $length - strlen($parameter)), Color::FG_GREEN);
            print Color::colorize("    " . $description) . PHP_EOL;
        }
    }

    /**
     * Returns the processed parameters
     *
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * {@inheritdoc}
     *
     * @return bool
     */
    public function canBeExternal(): bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     *
     * @param string $identifier
     *
     * @return bool
     */
    public function hasIdentifier($identifier): bool
    {
        return in_array($identifier, $this->getCommands(), true);
    }
}
