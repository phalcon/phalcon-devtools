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

namespace Phalcon\Commands\Builtin;

use Phalcon\Text;
use Phalcon\Builder;
use Phalcon\Script\Color;
use Phalcon\Commands\Command;
use Phalcon\Commands\CommandInterface;

/**
 * AllModels
 *
 * Create all models from a database
 *
 * @category 	Phalcon
 * @package 	Commands
 * @subpackage  Builtin
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class AllModels extends Command implements CommandInterface
{

	protected $_posibleParameters = array(
		'config=s' 			=> "Configuration file  ",
		'models=s' 			=> "Models directory ",
		'force'				=> "Force script to rewrite all the models.  ",
		'get-set' 			=> "Attributes will be protected and have setters/getters.  ",
		'doc' 				=> "Helps to improve code completion on IDEs  ",
		'relations' 		=> "Possible relations defined according to convention.  ",
		'fk' 				=> "Define any virtual foreign keys.  ",
		'validations' 		=> "Define possible domain validation according to conventions.  ",
		'directory=s' 		=> "Base path on which project will be created",
	);

	public function run()
	{

		$this->parseParameters($this->_posibleParameters);

		$parameters = $this->getParameters();

		if (!isset($parameters[1]) || $parameters[1] == '?') {
			$this->getHelp();
			return;
		}

		$path = '';
		if ($this->isReceivedOption('directory')) {
			$path = $this->getOption('directory').'/';
		}

		$config = null;
		if (!$this->isReceivedOption('models')) {

			$fileType = file_exists($path."app/config/config.ini") ? "ini" : "php";

			if ($this->isReceivedOption('config')){
				$configPath = $path.$this->getOption('config')."/config.".$fileType;
			} else {
				$configPath = $path."app/config/config." . $fileType;
			}

			if ($fileType == 'ini'){
				$config = new \Phalcon\Config\Adapter\Ini($configPath);
			} else {
				include $configPath;
			}

			if (file_exists($path.'public')) {
				$modelsDir = 'public/'.$config->phalcon->modelsDir;
			} else {
				$modelsDir = $config->phalcon->modelsDir;
			}
		} else {
			$modelsDir = $this->getOption('models');
		}

		$schema = $this->getOption('schema');
		$forceProcess = $this->isReceivedOption('force');
		$defineRelations = $this->isReceivedOption('relations');
		$defineForeignKeys = $this->isReceivedOption('fk');
		$genSettersGetters = $this->isReceivedOption('get-set');
		$genDocMethods = $this->isReceivedOption('doc');

		$modelBuilder = Builder::factory('AllModels', array(
			'force' => $forceProcess,
			'config' => $config,
			'schema' => $schema,
			'directory' => $this->getOption('directory'),
			'foreignKeys' => $defineForeignKeys,
			'defineRelations' => $defineRelations,
			'genSettersGetters' => $genSettersGetters,
			'genDocMethods' => $genDocMethods
		));

		$modelBuilder->build();
	}

	/**
	 * Returns the commands provided by the command
	 *
	 * @return array
	 */
	public function getCommands()
	{
		return array('all-models', 'create-all-models');
	}

	/**
	 * Prints the help for current command.
	 *
	 * @return void
	 */
	public function getHelp()
	{

		echo "------------------" . PHP_EOL .
			"|-- Example" . PHP_EOL .
			"|-- phalcon all-models --schema=my --get-set --doc --relations --trace" . PHP_EOL .
			"|-----------------" . PHP_EOL .
			"|-- Usage ". PHP_EOL .
			"|-- phalcon all-models [options]" . PHP_EOL .
			"|-----------------" . PHP_EOL .
			"|-- Options:". PHP_EOL .
			"------------------" . PHP_EOL;

	}

}

