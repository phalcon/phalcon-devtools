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

require 'scripts/Migrations/Migrations.php';
require 'scripts/Version/Version.php';
require 'scripts/Model/Migration.php';
require 'scripts/Model/Migration/Profiler.php';

class MigrationsController extends ControllerBase {

	protected function _prepareVersions(){

		$migrationsDir = Phalcon_WebTools::getPath('app/migrations');

		if(!file_exists($migrationsDir)){
			mkdir($migrationsDir);
		}

		$folders = array();
		foreach(scandir($migrationsDir) as $item){
			if (is_file($item) || $item=='.' || $item=='..') {
				continue;
			}
			$folders[$item] = $item;
		}
		natsort($folders);
		$folders = array_reverse($folders);
		$foldersKeys = array_keys($folders);

		if(isset($foldersKeys[0])){
			$this->view->setVar('version', $foldersKeys[0]);
		} else {
			$this->view->setVar('version', 'None');
		}

	}

	public function indexAction(){

		$this->_prepareVersions();

		$tables = array('all' => 'All');
		$connection = $this->_getConnection();

		$result = $connection->query("SHOW TABLES");
		while($table = $connection->fetchArray($result)){
			$tables[$table[0]] = $table[0];
		}

		$this->view->setVar('tables', $tables);
	}

	/**
	 * Makes HTML view to Migration
	 */
	public function getMigration()	{

		if($this->request->isPost()){

			$tableName = $request->getPost('table-name', 'string');
			$version = $request->getPost('version', 'string');
			$force = $request->getPost('force', 'int');
			$exportData = '';

			try {

				Phalcon_Migrations::generate(array(
					'config' => $this->_settings,
					'directory' => Phalcon_WebTools::getPath(),
					'tableName' => $tableName,
					'exportData' => $exportData,
					'migrationsDir' => $migrationsDir,
					'originalVersion' => $version,
					'force' => $force
				));

				$html .= '<div class="alert alert-success">The migration was created successfully</div>';
			}
			catch(Phalcon_BuilderException $e){
				Phalcon_Flash::error($e->getMessage(), 'alert alert-error');
			}

		}

	}

	public function runAction(){

		if($this->request->isPost()){

			$version = '';
			$exportData = '';
			$force = $request->getPost('force', 'int');

			try {

				Phalcon_Migrations::run(array(
					'config' => $this->_settings,
					'directory' => Phalcon_WebTools::getPath(),
					'tableName' => 'all',
					'migrationsDir' => $migrationDir,
					'force' => $force
				));

				Phalcon_Flash::success("The migration was executed successfully", "alert alert-success");
			}
			catch(Phalcon_BuilderException $e){
				Phalcon_Flash::error($e->getMessage(), 'alert alert-error');
			}
		}

		$this->_prepareVersions();

	}



}