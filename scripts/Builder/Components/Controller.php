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

use Phalcon_BuilderException as BuilderException;
use Phalcon_Utils as Utils;

/**
 * ControllerBuilderComponent
 *
 * Builder to generate controller
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 * @version 	$Id: Model.php,v a434b34d7989 2011/10/26 22:23:04 andres $
 */
class ControllerBuilderComponent extends Phalcon_BuilderComponent {

	/**
	 * Opciones del ModelBuilder
	 *
	 * @var array
	 */
	public function __construct($options){
		if(!isset($options['name'])){
			throw new BuilderException("Please, specify the controller name");
		}
		if(!isset($options['force'])){
			$options['force'] = false;
		}
		$this->_options = $options;
	}

	public function build(){

		$path = '';
		if(isset($this->_options['directory'])){
			if($this->_options['directory']){
				$path = $this->_options['directory'].'/';
			}
		}

		if(isset($this->_options['baseClass'])){
			$baseClass = $this->_options['baseClass'];
		} else {
			$baseClass = 'Phalcon_Controller';
		}

		if(!file_exists($path.'.phalcon')){
			throw new BuilderException("This command should be invoked inside a Phalcon project directory");
		}

		$config = $this->_getConfig($path);
		$controllersDir = $config->phalcon->controllersDir;

		$name = $this->_options['name'];
		$className = Utils::camelize($name);
		$controllerPath = $path."public/".$controllersDir.$className."Controller.php";
		$code = "<?php\n\nclass ".$className."Controller extends ".$baseClass." {\n\n\tpublic function indexAction(){\n\n\t}\n\n}\n\n";
		if(!file_exists($controllerPath) || $this->_options['force']==true){
			file_put_contents($controllerPath, $code);
		} else {
	 		throw new BuilderException("The Controller '$name' already exists");
		}

		return $className.'Controller.php';

	}

}