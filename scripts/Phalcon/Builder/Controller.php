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

namespace Phalcon\Builder;

use Phalcon\Builder\Component;
use Phalcon\Builder\Exception as BuilderException;
use Phalcon\Script\Color;
use Phalcon\Text as Utils;

/**
 * \Phalcon\Builder\Controller
 *
 * Builder to generate controller
 *
 * @category 	Phalcon
 * @package 	Builder
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 * @version 	$Id: Model.php,v a434b34d7989 2011/10/26 22:23:04 andres $
 */
class Controller extends Component {

	/**
	 * Class constructor
	 *
	 * @param $options
	 *
	 * @return \Phalcon\Builder\Controller
	 * @throws \Phalcon\Builder\Exception
	 */
	public function __construct($options) {
		if (!isset($options['name'])) {
			throw new BuilderException("Please, specify the controller name");
		}

		if(!isset($options['force'])){
			$options['force'] = false;
		}
		$this->_options = $options;
	}

	/**
	 * @return string
	 * @throws \Phalcon\Builder\Exception
	 */
	public function build() {
		$path = '';
		if (isset($this->_options['directory'])) {
			if($this->_options['directory']){
				$path = $this->_options['directory'] . '/';
			}
		}

		if (isset($this->_options['baseClass'])) {
			$baseClass = $this->_options['baseClass'];
		} else {
			$baseClass = '\Phalcon\Mvc\Controller';
		}

		if (!file_exists($path . '.phalcon')) {
			throw new BuilderException("This command should be invoked inside a Phalcon project directory");
		}

		if (!isset($this->_options['controllersDir'])) {
			$config = $this->_getConfig($path);
			if(!isset($config->application->controllersDir)){
				throw new BuilderException("Builder don't know the controllers directory");
			}
			$controllersDir = $config->application->controllersDir;
		} else {
			$controllersDir = $this->_options['controllersDir'];
		}

		if ($this->isAbsolutePath($controllersDir) == false) {
			$controllerPath = $path . "public/" . $controllersDir;
		} else {
			$controllerPath = $controllersDir;
		}

		$name = $this->_options['name'];
		$className = Utils::camelize($name);

		$controllerPath .= $className . "Controller.php";

		$code = "<?php\n\nclass ".$className."Controller extends ".$baseClass." {\n\n\tpublic function indexAction(){\n\n\t}\n\n}\n\n";
		$code = str_replace("\t", "    ", $code);

		if (!file_exists($controllerPath) || $this->_options['force'] == true) {
			file_put_contents($controllerPath, $code);
		} else {
	 		throw new BuilderException("The Controller '$name' already exists");
		}

		print Color::success('Controller "' . $name . '" was successfully created.') . PHP_EOL;

		return $className . 'Controller.php';

	}

}