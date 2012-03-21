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

if(isset($_SERVER['phToolsPath'])){
	chdir($_SERVER['phToolsPath']);
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
			'name=s' 		=> "--name \t\t Controller Name",
			'directory=s'   => "--directory path Directory on which project will be created",
			'force'			=> "--force \t Force to rewrite controller [optional]",
			'help' 			=> "--help \t\t Show help"
		);

		$this->parseParameters($posibleParameters);

		if($this->isReceivedOption('help')){
			$this->showHelp($posibleParameters);
			return;
		}

		$this->checkRequired(array("name"));
		
		$modelBuilder = Builder::factory('Controller', array(
			'name' => $this->getOption('name'),
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
