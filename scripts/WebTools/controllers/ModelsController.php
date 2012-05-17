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
			$tableName = $this->request->getPost('table-name');
			$genSettersGetters = $this->request->getPost('gen-setters-getters', 'int');
			$foreignKeys = $this->request->getPost('foreign-keys', 'int');
			$defineRelations = $this->request->getPost('define-relations', 'int');

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

				$html = $modelBuilder->build();

				if($tableName=='all'){
					Phalcon_Flash::success('The all models was created successfully', 'alert alert-success');
				} else {
					Phalcon_Flash::success('The model "'.$tableName.'" was created successfully', 'alert alert-success');	
				}
				
			}
			catch(Phalcon_BuilderException $e){
				Phalcon_Flash::error($e->getMessage(), 'alert alert-error');
			}

		}

		return $this->_forward('models/index');

	}

}