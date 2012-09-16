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

namespace Phalcon\Command;

use Phalcon\Script\Exception as ScriptException;

abstract class Command
{
	/**
	 * Output encoding of the script.
	 *
	 * @var string
	 */
	private $_encoding = 'UTF-8';

	/**
	 * Parameters received by the script.
	 *
	 * @var string
	 */
	private $_parameters = array();

	/**
	 * Possible arguments.
	 *
	 * @var array
	 */
	private $_possibleArguments = array();

	/**
	 * Parse the parameters passed to the script.
	 *
	 * @param	array $parameters
	 * @param	array $possibleAlias
	 * @return	array
	 * @throws \Phalcon\Script\Exception
	 */
	public function parseParameters($parameters = array(), $possibleAlias = array()) {

		$arguments = array();

		foreach ($parameters as $parameter => $description) {
			if (strpos($parameter, "=") !== false) {
				$parameterParts = explode("=", $parameter);
				if (count($parameterParts)!=2) {
					throw new ScriptException("Invalid definition for the parameter '$parameter'");
				}
				if (strlen($parameterParts[0])=="") {
					throw new ScriptException("Invalid definition for the parameter '".$parameter."'");
				}
				if (!in_array($parameterParts[1], array('s', 'i'))) {
					throw new ScriptException("Incorrect data type on parameter '".$parameter."'");
				}
				$this->_possibleArguments[$parameterParts[0]] = true;
				$arguments[$parameterParts[0]] = array(
					'have-option' => true,
					'option-required' => true,
					'data-type' => $parameterParts[1]
				);
			} else {
				if (strpos($parameter, "=") !== false) {
					$parameterParts = explode("=", $parameter);
					if(count($parameterParts)!=2){
						throw new ScriptException("Invalid definition for the parameter '$parameter'");
					}
					if(strlen($parameterParts[0])==""){
						throw new ScriptException("Invalid definition for the parameter '$parameter'");
					}
					if(!in_array($parameterParts[1], array('s', 'i'))){
						throw new ScriptException("Incorrect data type on parameter '$parameter'");
					}
					$this->_possibleArguments[$parameterParts[0]] = true;
					$arguments[$parameterParts[0]] = array(
						'have-option' => true,
						'option-required' => false,
						'data-type' => $parameterParts[1]
					);
				} else {
					if (preg_match('/([a-zA-Z0-9]+)/', $parameter)) {
						$this->_possibleArguments[$parameter] = true;
						$arguments[$parameter] = array(
							'have-option' => false,
							'option-required' => false
						);
					} else {
						throw new ScriptException("Invalid parameter '$parameter'");
					}
				}
			}
		}

		$param = '';
		$paramName = '';
		$receivedParams = array();
		$numberArguments = count($_SERVER['argv']);

		for($i=1;$i<$numberArguments;$i++){
			$argv = $_SERVER['argv'][$i];
			if(preg_match('#^([\-]{1,2})([a-zA-Z0-9][a-zA-Z0-9\-]*)$#', $argv, $matches)){
				if(strlen($matches[1])==1){
					$param = substr($matches[2], 1);
					$paramName = substr($matches[2], 0, 1);
				} else {
					if(strlen($matches[2])<2){
						throw new ScriptException("Invalid script parameter '$argv'");
					}
					$paramName = $matches[2];
				}
				if(!isset($this->_possibleArguments[$paramName])){
					if(!isset($possibleAlias[$paramName])){
						throw new ScriptException("Unknow parameter '$paramName'");
					} else {
						$paramName = $possibleAlias[$paramName];
					}
				}
				if(isset($arguments[$paramName])){
					if($param!=''){
						$receivedParams[$paramName] = $param;
						$param = '';
						$paramName = '';
					}
					if($arguments[$paramName]['have-option']==false){
						$receivedParams[$paramName] = true;
					}
				}
			} else {
				$param = $argv;
				if($paramName!=''){
					if(isset($arguments[$paramName])){
						if($param==''){
							if($arguments[$paramName]['have-option']==true){
								throw new ScriptException("The parameter '$paramName' requires an option");
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
				throw new ScriptException("The parameter '$fieldRequired' is required for this script");
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
	public function getOption($option)
	{
		if (isset($this->_parameters[$option])) {
			if (func_num_args() > 1) {
				$params = func_get_args();
				unset($params[0]);
				$filter = new \Phalcon\Filter();
				return $filter->sanitize($this->_parameters[$option], $params);
			}
			return $this->_parameters[$option];
		} else {
			return null;
		}
	}

	/**
	 * Indicates whether the script was a particular option.
	 *
	 * @param	string $option
	 * @return	boolean
	 */
	public function isReceivedOption($option){
		return isset($this->_parameters[$option]);
	}

	/**
	 * Filters a value
	 *
	 * @access	protected
	 * @param	string $paramValue
	 * @return	mixed
	 */
	protected function filter($paramValue)
	{
		if (func_num_args() > 1) {
			$params = func_get_args();
			unset($params[0]);
			$filter = new \Phalcon\Filter();
			return $filter->sanitize($paramValue, $params);
		} else {
			throw new ScriptException('You must specify at least one filter to apply');
		}
		return $paramValue;
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
		if($isXTermColor){
			if(isset($_ENV['SHELL'])){
				foreach(array('bash', 'tcl') as $shell){
					if(preg_match('/'.$shell.'/', $_ENV['SHELL'])){
						$isSupportedShell = true;
					}
				}
			}
		}

		ScriptColor::setFlags($isSupportedShell && $isSupportedShell);

		$output = "";
		$output.= ScriptColor::colorize(get_class($exception).': ', ScriptColor::RED, ScriptColor::BOLD);
		$message = str_replace("\"", "\\\"", $exception->getMessage());
		$message.= ' ('.$exception->getCode().')';
		$output.= ScriptColor::colorize($message, ScriptColor::WHITE, ScriptColor::BOLD);
		$output.='\\n';

		$output.= Highlight::getString(file_get_contents($exception->getFile()), 'console', array(
			'firstLine' => ($exception->getLine()-3<0 ? $exception->getLine() : $exception->getLine()-3),
			'lastLine' => $exception->getLine()+3
		));

		$i = 1;
		$getcwd = getcwd();
		foreach($exception->getTrace() as $trace){
			$output.= ScriptColor::colorize('#'.$i, ScriptColor::WHITE, ScriptColor::UNDERLINE);
			$output.= ' ';
			if(isset($trace['file'])){
				$file = str_replace($getcwd, '', $trace['file']);
				$output.= ScriptColor::colorize($file.'\\n', ScriptColor::NORMAL);
			}
			$i++;
		}

		if($isSupportedShell){
			system('echo -e "'.$output.'"');
		} else {
			echo $output;
		}

	}

	public function getParameters()
	{
		return $this->_parameters;
	}

	/**
	 * Returns the command identifier
	 *
	 * @return string
	 */
	abstract public function getCommand();

	/**
	 * Prints the help for current command.
	 *
	 * @return void
	 */
	abstract public function getHelp();
}
