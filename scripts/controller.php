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

require_once 'Script/Script.php';
require_once 'Script/Color/ScriptColor.php';
require_once 'Builder/Builder.php';

use Phalcon_Builder as Builder;

/**
 * CreateController
 *
 * Create a handler for the command line.
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 * @version 	$Id: create_controller.php,v 8a71037c1754 2011/12/13 09:12:19 eduar $
 */
class CreateController extends Phalcon_Script {

	public function __construct(){

		$posibleParameters = array(
			'directory=s'   => "--directory path Directory where the project will be created",
			'force'			=> "--force \t Force to rewrite controller [optional]",
		);

		$this->parseParameters($posibleParameters);
		
		$parameters = $this->getParameters();
		
		if (!isset($parameters[1]) || $parameters[1] == '?'){
			echo 
				"------------------" . PHP_EOL .
				"|-- Example" . PHP_EOL . 
				"|-- phalcon controller User --force" . PHP_EOL .
				"|-----------------" . PHP_EOL . 
				"|-- Usage " . PHP_EOL . 
				"|-- phalcon [controller name] [options]" . PHP_EOL .
				"|-----------------" . PHP_EOL . 
				"|-- Options:" . PHP_EOL . 
				"------------------" . PHP_EOL ;
			
			echo join(PHP_EOL, $posibleParameters) . PHP_EOL;
			return;
		}

		//$this->checkRequired(array("name"));

		$modelBuilder = Builder::factory('Controller', array(
			'name' => $parameters[1],
			'directory' => $this->getOption('directory'),
			'force' => $this->isReceivedOption('force')
		));

		$modelBuilder->build();
	}

}

try {
	$script = new CreateController();
}
catch(Phalcon_Exception $e){
	ScriptColor::lookSupportedShell();
	echo ScriptColor::colorize(get_class($e).' : '.$e->getMessage()."\n", ScriptColor::LIGHT_RED);
}
catch(Exception $e){
	echo "Exception : ".$e->getMessage()."\n";
}
