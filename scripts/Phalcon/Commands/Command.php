<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2014 Phalcon Team (http://www.phalconphp.com)       |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file docs/LICENSE.txt.                        |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Commands;

use Phalcon\Script;
use Phalcon\Script\Color;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Filter;

/**
 * Phalcon\Commands\Command
 *
 * Allows to implement devtools commands
 */
abstract class Command
{

    /**
     * Script
     *
     * @var \Phalcon\Script
     */
    protected $_script;

    /**
     * Events Manager
     *
     * @var \Phalcon\Events\Manager
     */
    protected $_eventsManager;

    /**
     * Output encoding of the script.
     *
     * @var string
     */
    protected $_encoding = 'UTF-8';

    /**
     * Parameters received by the script.
     *
     * @var string
     */
    protected $_parameters = array();

    /**
     * Possible prepared arguments.
     *
     * @var array
     */
    protected $_preparedArguments = array();

    /**
     * Phalcon\Commands\Command
     *
     * @param \Phalcon\Script         $script
     * @param \Phalcon\Events\Manager $eventsManager
     */
    final public function __construct(Script $script, EventsManager $eventsManager)
    {
        $this->_script = $script;
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
     * Sets the script that will execute the command
     *
     * @param \Phalcon\Script $script
     */
    public function setScript(Script $script)
    {
        $this->_script = $script;
    }

    /**
     * Returns the script that will execute the command
     *
     * @return \Phalcon\Script
     */
    public function getScript()
    {
        return $this->_script;
    }

    /**
     * Parse the parameters passed to the script.
     *
     * @param  array             $parameters
     * @param  array             $possibleAlias
     * @return array
     * @throws CommandsException
     */
    public function parseParameters($parameters = array(), $possibleAlias = array())
    {

        if (count($parameters) == 0) {
            if (isset($this->_possibleParameters)) {
                $parameters = $this->_possibleParameters;
            } else {
                if (method_exists($this, 'getPossibleParams')) {
                    $parameters = $this->getPossibleParams();
                } else {
                    throw new CommandsException("Cannot load possible parameters for script: " . get_class($this));
                }
            }
        }

        if (!is_array($parameters)) {
            throw new CommandsException("Cannot load possible parameters for script: " . get_class($this));
        }

        $arguments = array();
        foreach ($parameters as $parameter => $description) {
            if (strpos($parameter, "=") !== false) {
                $parameterParts = explode("=", $parameter);
                if (count($parameterParts) != 2) {
                    throw new CommandsException("Invalid definition for the parameter '$parameter'");
                }
                if (strlen($parameterParts[0]) == "") {
                    throw new CommandsException("Invalid definition for the parameter '" . $parameter . "'");
                }
                if (!in_array($parameterParts[1], array('s', 'i', 'l'))) {
                    throw new CommandsException("Incorrect data type on parameter '" . $parameter . "'");
                }
                $this->_preparedArguments[$parameterParts[0]] = true;
                $arguments[$parameterParts[0]] = array(
                    'have-option' => true,
                    'option-required' => true,
                    'data-type' => $parameterParts[1]
                );
            } else {
                if (strpos($parameter, "=") !== false) {
                    $parameterParts = explode("=", $parameter);
                    if (count($parameterParts) != 2) {
                        throw new CommandsException("Invalid definition for the parameter '$parameter'");
                    }
                    if (strlen($parameterParts[0]) == "") {
                        throw new CommandsException("Invalid definition for the parameter '$parameter'");
                    }
                    if (!in_array($parameterParts[1], array('s', 'i', 'l'))) {
                        throw new CommandsException("Incorrect data type on parameter '$parameter'");
                    }
                    $this->_preparedArguments[$parameterParts[0]] = true;
                    $arguments[$parameterParts[0]] = array(
                        'have-option' => true,
                        'option-required' => false,
                        'data-type' => $parameterParts[1]
                    );
                } else {
                    if (preg_match('/([a-zA-Z0-9]+)/', $parameter)) {
                        $this->_preparedArguments[$parameter] = true;
                        $arguments[$parameter] = array(
                            'have-option' => false,
                            'option-required' => false
                        );
                    } else {
                        throw new CommandsException("Invalid parameter '$parameter'");
                    }
                }
            }
        }

        $param = '';
        $paramName = '';
        $receivedParams = array();
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

                if (!isset($this->_preparedArguments[$paramName])) {
                    if (!isset($possibleAlias[$paramName])) {
                        throw new CommandsException("Unknown parameter '$paramName'");
                    } else {
                        $paramName = $possibleAlias[$paramName];
                    }
                }

                if (isset($arguments[$paramName])) {
                    if ($param != '') {
                        $receivedParams[$paramName] = $param;
                        $param = '';
                        $paramName = '';
                    }
                    if ($arguments[$paramName]['have-option'] == false) {
                        $receivedParams[$paramName] = true;
                    } else {
                        if (isset($matches[4])) {
                            $receivedParams[$paramName] = $matches[4];
                        }
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

        $this->_parameters = $receivedParams;

        return $receivedParams;
    }

    /**
     * Check that a set of parameters has been received.
     *
     * @param $required
     *
     * @throws CommandsException
     */
    public function checkRequired($required)
    {
        foreach ($required as $fieldRequired) {
            if (!isset($this->_parameters[$fieldRequired])) {
                throw new CommandsException("The parameter '$fieldRequired' is required for this script");
            }
        }
    }

    /**
     *  Sets the output encoding of the script.
     * @param $encoding
     *
     * @return $this
     */
    public function setEncoding($encoding)
    {
        $this->_encoding = $encoding;

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
            echo html_entity_decode($description, ENT_COMPAT, $this->_encoding).PHP_EOL;
        }
    }

    /**
     * Returns the value of an option received. If more parameters are taken as filters.
     * @param      $option
     * @param null $filters
     * @param null $defaultValue
     *
     * @return mixed|null
     */
    public function getOption($option, $filters=null, $defaultValue=null)
    {
        if (is_array($option)) {
            foreach ($option as $optionItem) {
                if (isset($this->_parameters[$optionItem])) {
                    if ($filters !== null) {
                        $filter = new Filter();

                        return $filter->sanitize($this->_parameters[$optionItem], $filters);
                    }

                    return $this->_parameters[$optionItem];
                }
            }

            return $defaultValue;
        } else {
            if (isset($this->_parameters[$option])) {
                if ($filters !== null) {
                    $filter = new Filter();

                    return $filter->sanitize($this->_parameters[$option], $filters);
                }

                return $this->_parameters[$option];
            } else {
                return $defaultValue;
            }
        }
    }

    /**
     * Indicates whether the script was a particular option.
     *
     * @param  string  $option
     * @return boolean
     */
    public function isReceivedOption($option)
    {
        return isset($this->_parameters[$option]);
    }

    /**
     * Filters a value
     *
     * @param $paramValue
     * @param $filters
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
     * @return string
     */
    public function getLastUnNamedParam()
    {
        foreach (array_reverse($this->_parameters) as $key => $value) {
            if (is_numeric($key)) {
                return $value;
            }
        }

        return false;
    }

    /**
     * Checks if exists a certain unnamed parameter
     *
     * @param $number
     *
     * @return bool
     */
    public function isSetUnNamedParam($number)
    {
        return isset($this->_parameters[$number]);
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
     * @return string
     */
    public function getParameters()
    {
        return $this->_parameters;
    }

    /**
     * By default all commands must be external
     *
     * @return boolean
     */
    public function canBeExternal()
    {
        return false;
    }

    /**
     * Return required parameters
     */
    public function getRequiredParams()
    {

    }

}
