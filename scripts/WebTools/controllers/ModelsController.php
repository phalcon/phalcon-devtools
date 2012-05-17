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

class ModelsController extends ControllerBase {

	public function indexAction(){

		$connection = $this->_getConnection();

		$tables = array('all' => 'All');
		$result = $connection->query("SHOW TABLES");
		while($table = $connection->fetchArray($result)){
			$tables[$table[0]] = $table[0];
		}

		$this->view->setVar('tables', $tables);
		$this->view->setVar('databaseName', $this->_settings->database->name);

	}

	/**
	 * Generate models
	 */
	public function createAction(){

		if($this->request->isPost()){

			$force = $this->request->getPost('force', 'int');
			$schema = $this->request->getPost('schema');
			$tableName = $this->request->getPost('tableName');
			$genSettersGetters = $this->request->getPost('genSettersGetters', 'int');
			$foreignKeys = $this->request->getPost('foreignKeys', 'int');
			$defineRelations = $this->request->getPost('defineRelations', 'int');

			var_dump($defineRelations);

			try {

				$component = 'Model';
				if($tableName=='all'){
					$component = 'AllModels';
				}

				$modelBuilder = Phalcon_Builder::factory($component, array(
					'name' 					=> $tableName,
					'force' 				=> $force,
					'modelsDir' 			=> $this->_settings->phalcon->modelsDir,
					'directory' 			=> Phalcon_WebTools::getPath(),
					'foreignKeys' 			=> $foreignKeys,
					'defineRelations' 		=> $defineRelations,
					'genSettersGetters' 	=> $genSettersGetters

				));

				$modelBuilder->build();

				if($tableName=='all'){
					Phalcon_Flash::success('Models were created successfully', 'alert alert-success');
				} else {
					Phalcon_Flash::success('Model "'.$tableName.'" was created successfully', 'alert alert-success');
				}

			}
			catch(Phalcon_BuilderException $e){
				Phalcon_Flash::error($e->getMessage(), 'alert alert-error');
			}

		}

		return $this->_forward('models/index');

	}

	public function listAction(){
		$this->view->setVar('modelsDir', Phalcon_WebTools::getPath('public/'.$this->_settings->phalcon->modelsDir));
	}

	public function editAction($fileName){

		$fileName = str_replace('..', '', $fileName);

		$modelsDir = Phalcon_WebTools::getPath('public/'.$this->_settings->phalcon->modelsDir);
		if(!file_exists($modelsDir.'/'.$fileName)){
			Phalcon_Flash::error('MOdel could not be found', 'alert alert-error');
			return $this->_forward('models/list');
		}

		Phalcon_Tag::setDefault('code', file_get_contents($modelsDir.'/'.$fileName));
		Phalcon_Tag::setDefault('name', $fileName);
		$this->view->setVar('name', $fileName);

	}

	public function saveAction(){

		if($this->request->isPost()){

			$fileName = $this->request->getPost('name', 'string');

			$fileName = str_replace('..', '', $fileName);

			$modelsDir = Phalcon_WebTools::getPath('public/'.$this->_settings->phalcon->modelsDir);
			if(!file_exists($modelsDir.'/'.$fileName)){
				Phalcon_Flash::error('model could not be found', 'alert alert-error');
				return $this->_forward('models/list');
			}

			if(!is_writable($modelsDir.'/'.$fileName)){
				Phalcon_Flash::error('model file does not have write access', 'alert alert-error');
				return $this->_forward('models/list');
			}

			file_put_contents($modelsDir.'/'.$fileName, $this->request->getPost('code'));

			Phalcon_Flash::success('The model "'.$fileName.'" was saved successfully', 'alert alert-success');

		}

		return $this->_forward('models/list');

	}

}