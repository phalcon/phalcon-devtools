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

use Phalcon\Tag;
use Phalcon\Web\Tools;
use Phalcon\Builder\BuilderException;

class ScaffoldController extends ControllerBase
{

	public function indexAction()
	{

		$config = Tools::getConfig();
		$connection = Tools::getConnection();

		$tables = array();
		$result = $connection->query("SHOW TABLES");
		$result->setFetchMode(Phalcon\Db::FETCH_NUM);
		while($table = $result->fetchArray($result)){
			$tables[$table[0]] = $table[0];
		}

		$this->view->setVar('tables', $tables);
		$this->view->setVar('databaseName', $config->database->name);
	}

	/**
	 * Generate Scaffold
	 */
	public function generateAction()
	{

		if ($this->request->isPost()) {

			$schema = $this->request->getPost('schema', 'string');
			$tableName = $this->request->getPost('tableName', 'string');
			$version = $this->request->getPost('version', 'string');
			$force = $this->request->getPost('force', 'int');
			$genSettersGetters = $this->request->getPost('genSettersGetters', 'int');

			try {

				$scaffoldBuilder = new \Phalcon\Builder\Scaffold(array(
					'name' => $tableName,
					'schema' => $schema,
					'force'	=> $force,
					'genSettersGetters' => $genSettersGetters,
					'directory' => null
				));

				$scaffoldBuilder->build();

				$this->flash->success('Scaffold for table "'.$tableName.'" was generated successfully');

			}
			catch(BuilderException $e){
				$this->flash->error($e->getMessage());
			}

		}

		return $this->dispatcher->forward(array(
			'controller' => 'scaffold',
			'action' => 'index'
		));
	}

}