<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Framework                                                      |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2012 Phalcon Team (http://www.phalconphp.com)       |
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
	 * @param \Phalco\Script $script
	 * @param \Phalco\Events\Manager $eventsManager
	 */
	final public function __construct(Script $script, EventsManager $eventsManager){
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
	 * @param	array $parameters
	 * @param	array $possibleAlias
	 * @return	array
	 * @throws	\Phalcon\Script\Exception
	 */
	public function parseParameters($parameters = array(), $possibleAlias = array())
	{

		if (count($parameters)==0) {
			$parameters = $this->_possibleParameters;
		}

		$arguments = array();
		foreach ($parameters as $parameter => $description) {
			if (strpos($parameter, "=") !== false) {
				$parameterParts = explode("=", $parameter);
				if (count($parameterParts) != 2) {
					throw new CommandsException("Invalid definition for the parameter '$parameter'");
				}
				if (strlen($parameterParts[0]) == "") {
					throw new CommandsException("Invalid definition for the parameter '".$parameter."'");
				}
				if (!in_array($parameterParts[1], array('s', 'i'))) {
					throw new CommandsException("Incorrect data type on parameter '".$parameter."'");
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
					if (!in_array($parameterParts[1], array('s', 'i'))) {
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

				if (strlen($matches[1])==1){
					$param = substr($matches[2], 1);
					$paramName = substr($matches[2], 0, 1);
				} else {
					if(strlen($matches[2]) < 2) {
						throw new CommandsException("Invalid script parameter '$argv'");
					}
					$paramName = $matches[2];
				}

				if(!isset($this->_preparedArguments[$paramName])) {
					if(!isset($possibleAlias[$paramName])){
						throw new CommandsException("Unknow parameter '$paramName'");
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
				if ($paramName!='') {
					if (isset($arguments[$paramName])) {
						if ($param==''){
							if ($arguments[$paramName]['have-option'] == true){
								throw new CommandsException("The parameter '$paramName' requires an option");
							}
						}
					}
					$receivedParams[$paramName] = $param;
					$param = '';
					$paramName = '';
				} else {
					$receivedParams[$i-1] = $param;
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
	 * @param array $required
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
	 * Sets the output encoding of the script.
	 *
	 * @param string $encoding
	 */
	public function setEncoding($encoding)
	{
		$this->_encoding = $encoding;
	}

	/**
	 * Displays help for the script.
	 *
	 * @param array $posibleParameters
	 */
	public function showHelp($posibleParameters)
	{
		echo get_class($this).' - Usage:'.PHP_EOL.PHP_EOL;
		foreach ($posibleParameters as $parameter => $description) {
			echo html_entity_decode($description, ENT_COMPAT, $this->_encoding).PHP_EOL;
		}
	}

	/**
	 * Returns the value of an option received. If more parameters are taken as filters.
	 *
	 * @param string $option
	 */
	public function getOption($option, $filters=null, $defaultValue=null)
	{
		if (is_array($option)) {
			foreach ($option as $optionItem) {
				if (isset($this->_parameters[$optionItem])) {
					if ($filters !== null) {
						$filter = new \Phalcon\Filter();
						return $filter->sanitize($this->_parameters[$optionItem], $filters);
					}
					return $this->_parameters[$optionItem];
				}
			}
			return $defaultValue;
		} else {
			if (isset($this->_parameters[$option])) {
				if ($filters !== null) {
					$filter = new \Phalcon\Filter();
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
	 * @param	string $option
	 * @return	boolean
	 */
	public function isReceivedOption($option)
	{
		return isset($this->_parameters[$option]);
	}

	/**
	 * Filters a value
	 *
	 * @param	string $paramValue
	 * @return	mixed
	 */
	protected function filter($paramValue, $filters)
	{
		$filter = new \Phalcon\Filter();
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
	 * @param int $number
	 */
	public function isSetUnNamedParam($number)
	{
		return isset($this->_parameters[$number]);
	}

	/**
	 * Displays a message in the text console.
	 *
	 * @param Exception $exception
	 */
	public static function showConsoleException($exception)
	{

		$isXTermColor = false;
		if(isset($_ENV['TERM'])){
			foreach(array('256color') as $term){
				if(preg_match('/'.$term.'/', $_ENV['TERM'])){
					$isXTermColor = true;
				}
			}
		}

		$isSupportedShell = false;
		if ($isXTermColor) {
			if (isset($_ENV['SHELL'])) {
				foreach (array('bash', 'tcl') as $shell) {
					if (preg_match('/'.$shell.'/', $_ENV['SHELL'])) {
						$isSupportedShell = true;
					}
				}
			}
		}

		ScriptColor::setFlags($isSupportedShell && $isSupportedShell);

		$output   = "";
		$output  .= ScriptColor::colorize(get_class($exception) . ': ', ScriptColor::RED, ScriptColor::BOLD);
		$message  = str_replace("\"", "\\\"", $exception->getMessage());
		$message .= ' (' . $exception->getCode() . ')';
		$output  .= ScriptColor::colorize($message, ScriptColor::WHITE, ScriptColor::BOLD);
		$output  .='\\n';

		$output.= Highlight::getString(file_get_contents($exception->getFile()), 'console', array(
			'firstLine' => ($exception->getLine() - 3 < 0 ? $exception->getLine() : $exception->getLine() - 3),
			'lastLine' => $exception->getLine() + 3
		));

		$i = 1;
		$getcwd = getcwd();
		foreach ($exception->getTrace() as $trace) {
			$output.= ScriptColor::colorize('#'.$i, ScriptColor::WHITE, ScriptColor::UNDERLINE);
			$output.= ' ';
			if (isset($trace['file'])) {
				$file = str_replace($getcwd, '', $trace['file']);
				$output.= ScriptColor::colorize($file.'\\n', ScriptColor::NORMAL);
			}
			$i++;
		}

		if($isSupportedShell){
			system('echo -e "' . $output . '"');
		} else {
			echo $output;
		}

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
			if ($length == 0){
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
	 * Returns the proccesed parameters
	 *
	 * @param array
	 */
	public function getParameters()
	{
		return $this->_parameters;
	}

}
