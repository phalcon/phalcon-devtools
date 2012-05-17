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

	public function indexAction(){

		$migrationsDir = Phalcon_WebTools::getPath('app/migrations');

		if(!file_exists($migrationsDir)){
			mkdir($migrationsDir);
		}

		$request = Phalcon_Request::getInstance();

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

		$tables = array('all' => 'All');
		$connection = $this->_getConnection();

		$result = $connection->query("SHOW TABLES");
		while($table = $connection->fetchArray($result)){
			$tables[$table[0]] = $table[0];
		}

		$this->view->setVar('tables', $tables);
		if(isset($foldersKeys[0])){
			$this->view->setVar('version', $foldersKeys[0]);
		} else {
			$this->view->setVar('version', 'None');
		}

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
					'directory' => $this->_path,
					'tableName' => $tableName,
					'exportData' => $exportData,
					'migrationsDir' => $migrationsDir,
					'originalVersion' => $version,
					'force' => $force
				));

				$html .= '<div class="alert alert-success">The migration was created successfully</div>';
			}
			catch(Phalcon_BuilderException $e){
				$html .= '<div class="alert alert-error">'.$e->getMessage().'</div>';
			}

		}

		if(!$request->getQuery('subAction')){

			if(!isset($foldersKeys[0])){
				$version = 'None';
			} else {
				$version = $foldersKeys[0];
			}

			$html .= '';
		} else {

			$html .= '<div class="span9">
				<p><h1>Run  Migration</h1></p>
				<form method="post" class="forma-horizontal" action="'.$this->_uri.'/webtools.php?action=migration&subAction=run">
					<table class="table table-striped table-bordered table-condensed">
						<tr>
							<td><b>Current Version</b></td>
							<td><i>'.$foldersKeys[0].'</i></td>
						</tr>
						<tr>
							<td colspan="2">
								<div align="right">
									<input type="submit" class="btn btn-primary" value="Generate"/>
								</div>
							</td>
						</tr>
					</table>
				</form>';
		}

		$html .= '</div>';

		return $html;
	}

	public function prepareRun(){

	}

	public function runAction(){

		$version = '';
		$force = $request->getPost('force', 'int');
		$exportData = '';

		try {

						ob_start();
						$migrationOut = Phalcon_Migrations::run(array(
							'config' => $this->_settings,
							'directory' => $this->_path,
							'tableName' => 'all',
							'migrationsDir' => $migrationDir,
							'force' => $force
						));
						$html = nl2br(ob_get_contents());
						ob_end_clean();

						$_GET['subAction'] = 'run';
						if(!$version){
							$version = $foldersKeys[0];
						}

						$html .= '<div class="alert alert-success">The migration "'.$version.'" was executed successfully</div>';
					}
					catch(Phalcon_BuilderException $e){
						$html .= '<div class="alert alert-error">'.$e->getMessage().'</div>';
					}
	}

}