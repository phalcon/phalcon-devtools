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

require 'scripts/Builder/Builder.php';
require 'scripts/WebTools/controllers/ControllerBase.php';

/**
 * Phalcon_WebTools
 *
 * Allows to use Phalcon Developer Tools with a web interface
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class Phalcon_WebTools {

	private static $_path;

	private static $_options = array(
		'index' => array(
			'caption' => 'Home',
			'options' => array(
				'index' => array(
					'caption' => 'Welcome'
				)
			)
		),
		'controllers' => array(
			'caption' => 'Controllers',
			'options' => array(
				'index' => array(
					'caption' => 'Generate',
				),
				'list' => array(
					'caption' => 'List',
				)
			)
		),
		'models' => array(
			'caption' => 'Models',
			'options' => array(
				'index' => array(
					'caption' => 'Generate'
				),
				'list' => array(
					'caption' => 'List',
				)
			)
		),
		'scaffold' => array(
			'caption' => 'Scaffold',
			'options' => array(
				'index' => array(
					'caption' => 'Generate'
				)
			)
		),
		'migrations' => array(
			'caption' => 'Migrations',
			'options' => array(
				'index' => array(
					'caption' => 'Generate'
				),
				'run' => array(
					'caption' => 'Run'
				)
			)
		),
		'config' => array(
			'caption' => 'Configuration',
			'options' => array(
				'index' => array(
					'caption' => 'Edit'
				)
			)
		),
	);

	public static function getNavMenu($controllerName){
		$uri = Phalcon_Utils::getUrl('');
		foreach(self::$_options as $controller => $option){
			if($controllerName==$controller){
				echo '<li class="active">';
			} else {
				echo '<li>';
			}
			echo '<a href="'.$uri.'webtools.php?_url='.$controller.'">'.$option['caption'].'</a></li>'.PHP_EOL;
		}
	}

	public static function getMenu($controllerName, $actionName){
		$uri = Phalcon_Utils::getUrl('');
		foreach(self::$_options[$controllerName]['options'] as $action => $option){
			if($actionName==$action){
				echo '<li class="active">';
			} else {
				echo '<li>';
			}
			echo '<a href="'.$uri.'webtools.php?_url='.$controllerName.'/'.$action.'">'.$option['caption'].'</a></li>'.PHP_EOL;
		}
	}

	public static function getPath($path=''){
		if($path){
			return self::$_path.'/'.$path;
		} else {
			return self::$_path;
		}
	}

	public static function main($path){

		self::$_path = $path;

		try {
			$front = Phalcon_Controller_Front::getInstance();

			$front->setBasePath('./');
			$front->setControllersDir('scripts/WebTools/controllers/');
			$front->setViewsDir('scripts/WebTools/views/');

			echo $front->dispatchLoop()->getContent();
		}
		catch(Phalcon_Exception $e){
			echo get_class($e), ': ', $e->getMessage();
		}
	}

}
