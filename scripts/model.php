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

$pToolsPath = getenv("PTOOLSPATH");
if($pToolsPath){
	chdir($pToolsPath);
}

/**
 * CreateModel
 *
 * Create a model from command line
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 * @version 	$Id$
 */
class CreateModel extends \Phalcon\Script {

	public function run(){
		$posibleParameters = array(
			'schema=s' 		=> "--schema \t\tName of the schema. [optional]",
			'get-set' 	=> "--get-set \t\tAttributes will be protected and have setters/getters.",
			'doc' 	=> "--doc \t\t\tHelps to improve code completion on IDEs [optional]",
			'directory=s' => "--directory \t\tBase path on which project will be created",
			'force' 		=> "--force \t\tRewrite the model. [optional]",
			'trace' 		=> "--trace \t\tShows the trace of the framework in case of exception.",
		);

		$this->parseParameters($posibleParameters);

		$parameters = $this->getParameters();

		if (!isset($parameters[1]) || $parameters[1] == '?'){
			echo
				"------------------" . PHP_EOL .
				"|-- Example" . PHP_EOL .
				"|-- phalcon model User users --schema=my --get-set --doc --force --trace" . PHP_EOL .
				"|-----------------" . PHP_EOL .
				"|-- Usage " . PHP_EOL .
				"|-- phalcon model [className] [tableName] [options] " . PHP_EOL .
				"|-----------------" . PHP_EOL .
				"|-- Options:" . PHP_EOL .
				"------------------" . PHP_EOL . PHP_EOL;


			echo join(PHP_EOL, $posibleParameters) . PHP_EOL;
			return;
		}

		$name = $parameters[1];

		$className = Utils::camelize(isset($parameters[2]) ? $parameters[2] : $name);
		$fileName = Utils::uncamelize($className);

		$schema = $this->getOption('schema');

		$modelBuilder = Builder::factory('Model', array(
			'name' => $name,
			'schema' => $schema,
			'className' => $className,
			'fileName' => $fileName,
			'genSettersGetters' => $this->isReceivedOption('get-set'),
			'genDocMethods' => $this->isReceivedOption('doc'),
			'directory' => $this->getOption('directory'),
			'force' => $this->isReceivedOption('force')
		));

		$modelBuilder->build();
	}

}

try {
	$script = new CreateModel();
	$script->run();
}
catch(Phalcon\Exception $e){
	ScriptColor::lookSupportedShell();
	echo ScriptColor::colorize(get_class($e).' : '.$e->getMessage()."\n", ScriptColor::LIGHT_RED);
	if($script->getOption('trace')){
		echo $e->getTraceAsString()."\n";
	}
}
catch(Exception $e){
	echo 'Exception : '.$e->getMessage()."\n";
}
