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

class ControllersController extends ControllerBase {

	public function indexAction(){

	}

	/**
	 * Generate controller
	 */
	public function createAction(){

		if($this->request->isPost()){

			$name = $this->request->getPost('name', 'string');
			$force = $this->request->getPost('force', 'int');

			try {

				$modelBuilder = Phalcon_Builder::factory('Controller', array(
					'name' 		=> $name,
					'directory'	=> Phalcon_WebTools::getPath(),
					'force' 	=> $force
				));

				$fileName = $modelBuilder->build();

				Phalcon_Flash::success('The controller "'.$fileName.'" was created successfully', 'alert alert-success');

				return $this->_forward('controllers/edit/'.$fileName);

			}
			catch(Phalcon_BuilderException $e){
				Phalcon_Flash::error($e->getMessage(), 'alert alert-error');
			}

		}

		return $this->_forward('controllers/index');

	}

	public function listAction(){
		$this->view->setVar('controllersDir', Phalcon_WebTools::getPath('public/'.$this->_settings->phalcon->controllersDir));
	}

	public function editAction($fileName){

		$fileName = str_replace('..', '', $fileName);

		$controllersDir = Phalcon_WebTools::getPath('public/'.$this->_settings->phalcon->controllersDir);
		if(!file_exists($controllersDir.'/'.$fileName)){
			Phalcon_Flash::error('Controller could not be found', 'alert alert-error');
			return $this->_forward('controllers/list');
		}

		Phalcon_Tag::setDefault('code', file_get_contents($controllersDir.'/'.$fileName));
		Phalcon_Tag::setDefault('name', $fileName);
		$this->view->setVar('name', $fileName);

	}

	public function saveAction(){

		if($this->request->isPost()){

			$fileName = $this->request->getPost('name', 'string');

			$fileName = str_replace('..', '', $fileName);

			$controllersDir = Phalcon_WebTools::getPath('public/'.$this->_settings->phalcon->controllersDir);
			if(!file_exists($controllersDir.'/'.$fileName)){
				Phalcon_Flash::error('Controller could not be found', 'alert alert-error');
				return $this->_forward('controllers/list');
			}

			if(!is_writable($controllersDir.'/'.$fileName)){
				Phalcon_Flash::error('Controller file does not have write access', 'alert alert-error');
				return $this->_forward('controllers/list');
			}

			file_put_contents($controllersDir.'/'.$fileName, $this->request->getPost('code'));

			Phalcon_Flash::success('The controller "'.$fileName.'" was saved successfully', 'alert alert-success');

		}

		return $this->_forward('controllers/list');

	}


}