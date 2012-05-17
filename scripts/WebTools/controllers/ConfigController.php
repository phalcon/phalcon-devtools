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

class ConfigController extends ControllerBase {

	protected $_posibleConfig = array(
		'phalcon' => array(
			'controllersDir' => 'string',
			'modelsDir' => 'string',
			'viewsDir' => 'string',
			'baseUri' => 'string',
			'basePath' => 'string',
		),
		'database' => array(
			'adapter' => 'string',
			'host' => 'string',
			'name' => 'string',
			'username' => 'string',
			'password' => 'string',
		)
	);

	public function indexAction(){
		$this->view->setVar('posibleConfig', $this->_posibleConfig);
		$this->view->setVar('settings', $this->_settings);
	}

	public function saveAction(){


		if($this->request->isPost()){

			$newConfig = array();
			foreach($this->_posibleConfig as $section => $config){
				foreach($config as $name => $type){
					if(isset($_POST[$name])){
						$newConfig[$section][$name] = $this->request->getPost($name, $type);
					}
				}
			}

			$ini = '';
			foreach($newConfig as $section => $settings){
				$ini.='['.$section.']'.PHP_EOL;
				foreach($settings as $name => $value){
					$ini.=$name.' = '.$value.PHP_EOL;
				}
				$ini.=PHP_EOL;
			}

			$configPath = Phalcon_WebTools::getPath("app/config/config.ini");
			if(is_writable($configPath)){
				file_put_contents($configPath, $ini);
				$this->_readConfig();
				Phalcon_Flash::success('Configuration was successfully updated', 'alert alert-success');
			} else {
				Phalcon_Flash::error('Sorry, configuration file is not writable', 'alert alert-error');;
			}
		}

		return $this->_forward('config/index');
	}

}