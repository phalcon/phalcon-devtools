<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-present Phalcon Team (https://www.phalconphp.com)   |
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

namespace Phalcon\Commands;

use Phalcon\Config;
use Phalcon\Script;
use Phalcon\Filter;
use Phalcon\Script\Color;
use Phalcon\Builder\Path;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Config\Adapter\Ini as IniConfig;
use Phalcon\Config\Adapter\Json as JsonConfig;
use Phalcon\Config\Adapter\Yaml as YamlConfig;

/**
 * Command Class
 *
 * @package   Phalcon\Commands
 * @copyright Copyright (c) 2011-2016 Phalcon Team (team@phalconphp.com)
 * @license   New BSD License
 */
abstract class Command implements CommandsInterface
{
    /**
     * Script
     * @var \Phalcon\Script
     */
    protected $script;

    /**
     * Events Manager
     * @var \Phalcon\Events\Manager
     */
    protected $eventsManager;

    /**
     * Output encoding of the script.
     * @var string
     */
    protected $encoding = 'UTF-8';

    /**
     * Parameters received by the script.
     * @var array
     */
    protected $parameters = [];

    /**
     * Possible prepared arguments.
     * @var array
     */
    protected $preparedArguments = [];

    protected $path;

    /**
     * Phalcon\Commands\Command
     *
     * @param \Phalcon\Script         $script
     * @param \Phalcon\Events\Manager $eventsManager
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
     * @param \Phalcon\Events\Manager $eventsManager
     */
    public function setEventsManager(EventsManager $eventsManager)
    {
        $this->eventsManager = $eventsManager;
    }

    /**
     * Returns the events manager
     *
     * @return \Phalcon\Events\Manager
     */
    public function getEventsManager()
    {
        return $this->eventsManager;
    }

    /**
     * Sets the script that will execute the command
     *
     * @param \Phalcon\Script $script
     */
    public function setScript(Script $script)
    {
        $this->script = $script;
    }

    /**
     * Returns the script that will execute the command
     *
     * @return \Phalcon\Script
     */
    public function getScript()
    {
        return $this->script;
    }

    /**
     * @param string $path Config path
     *
     * @return \Phalcon\Config
     * @throws CommandsException
     */
    protected function getConfig($path)
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
     * @return \Phalcon\Config
     * @throws CommandsException
     */
    protected function loadConfig($fileName)
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
    public function parseParameters(array $parameters = [], $possibleAlias = [])
    {
        if (count($parameters) == 0) {
            $parameters = $this->getPossibleParams();
        }

        $arguments = [];
        foreach ($parameters as $parameter => $description) {
            if (strpos($parameter, "=") !== false) {
                $parameterParts = explode("=", $parameter);
                if (count($parameterParts) != 2) {
                    throw new CommandsException("Invalid definition for the parameter '$parameter'");
                }
                if (strlen($parameterParts[0]) == "") {
                    throw new CommandsException("Invalid definition for the parameter '$parameter'");
                }
                if (!in_array($parameterParts[1], ['s', 'i', 'l'])) {
                    throw new CommandsException("Incorrect data type on parameter '$parameter'");
                }
                $this->preparedArguments[$parameterParts[0]] = true;
                $arguments[$parameterParts[0]] = [
                    'have-option' => true,
                    'option-required' => true,
                    'data-type' => $parameterParts[1]
                ];
            } else {
                if (!preg_match('/([a-zA-Z0-9]+)/', $parameter)) {
                    throw new CommandsException("Invalid parameter '$parameter'");
                }

                $this->preparedArguments[$parameter] = true;
                $arguments[$parameter] = [
                    'have-option'     => false,
                    'option-required' => false
                ];
            }
        }

        $param = '';
        $paramName = '';
        $receivedParams = [];
        $numberArguments = count($_SERVER['argv']);

        for ($i = 1; $i < $numberArguments; $i++) {
            $argv = $_SERVER['argv'][$i];
            if (preg_match('#^([\-]{1,2})([a-zA-Z0-9][a-zA-Z0-9\-]*)(=(.*)){0,1}$#', $argv, $matches)) {
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
                    if ($arguments[$paramName]['have-option'] == false) {
                        $receivedParams[$paramName] = true;
                    } elseif (isset($matches[4])) {
                        $receivedParams[$paramName] = $matches[4];
                    }
                }
            } else {
                $param = $argv;
                if ($paramName != '') {
                    if (isset($arguments[$paramName])) {
                        if ($param == '') {
                            if ($arguments[$paramName]['have-option'] == true) {
                                throw new CommandsException("The parameter '$paramName' requires an option");
                            }
                        }
                    }
                    $receivedParams[$paramName] = $param;
                    $param = '';
                    $paramName = '';
                } else {
                    $receivedParams[$i - 1] = $param;
                    $param = '';
                }
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
     * Check that a set of parameters has been received.
     *
     * @param array $required
     *
     * @throws CommandsException
     */
    public function checkRequired($required)
    {
        foreach ($required as $fieldRequired) {
            if (!isset($this->parameters[$fieldRequired])) {
                throw new CommandsException("The parameter '$fieldRequired' is required for this script");
            }
        }
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
     * Displays help for the script.
     *
     * @param array $possibleParameters
     */
    public function showHelp($possibleParameters)
    {
        echo get_class($this).' - Usage:'.PHP_EOL.PHP_EOL;
        foreach ($possibleParameters as $parameter => $description) {
            echo html_entity_decode($description, ENT_COMPAT, $this->encoding).PHP_EOL;
        }
    }

    /**
     * Returns all received options.
     *
     * @param mixed $filters Filter name or array of filters [Optional]
     *
     * @return array
     */
    public function getOptions($filters = null)
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
     * @param  string | string[]  $option
     * @return boolean
     */
    public function isReceivedOption($option)
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
     * Gets the last parameter is not associated with any parameter name.
     *
     * @return string | bool
     */
    public function getLastUnNamedParam()
    {
        foreach (array_reverse($this->parameters) as $key => $value) {
            if (is_numeric($key)) {
                return $value;
            }
        }

        return false;
    }

    /**
     * Checks if exists a certain unnamed parameter
     *
     * @param int $number
     *
     * @return bool
     */
    public function isSetUnNamedParam($number)
    {
        return isset($this->parameters[$number]);
    }

    /**
     * Prints the available options in the script
     *
     * @param array $parameters
     */
    public function printParameters($parameters)
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
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * {@inheritdoc}
     *
     * @return boolean
     */
    public function canBeExternal()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     *
     * @param string $identifier
     *
     * @return boolean
     */
    public function hasIdentifier($identifier)
    {
        return in_array($identifier, $this->getCommands(), true);
    }
}
