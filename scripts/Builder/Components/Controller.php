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
class ControllerBuilderComponent {

	/**
	 * Opciones del ModelBuilder
	 *
	 * @var array
	 */
	private $_options = array();

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
		if(isset($this->_options['PROJECTPATH'])){
			if($this->_options['PROJECTPATH']){
				$path = $this->_options['PROJECTPATH'].'/../';
			}
		}
		//die($path.'.phalcon');
		if(!file_exists($path.'.phalcon')){
			throw new BuilderException("This command should be invoked inside a phalcon project PROJECTPATH");
		}
		$name = $this->_options['name'];
		if(!$name){
			throw new BuilderException("The Controller name is empty");
		}
		$controllersDir = 'app/controllers/';
		$controllerPath = $path.$controllersDir.Utils::camelize($name)."Controller.php";
		$code = "<?php\n\nclass ".Utils::camelize($name)."Controller extends Phalcon_Controller {\n\n\tpublic function indexAction(){\n\n\t}\n\n}\n\n";
		if(!file_exists($controllerPath) || $this->_options['force']==true){
			file_put_contents($controllerPath, $code);
		} else {
	 		throw new BuilderException("The Controller '$name' already exists");
		}

	}

}