<html>
	<head>
		<title>Phalcon PHP Framework - Web DevTools.</title>
		<link rel="stylesheet" type="text/css" href="public/css/bootstrap/bootstrap.min.css">
	</head>
	<body>
		<div class="container-fluid">
		    <div class="row-fluid">
			    <div class="span2">
			    	<!--Sidebar content-->
			    	<div style="padding: 8px 0;" class="well">
					    <ul class="nav nav-list">
					      <li class="active"><a href="?"><i class="icon-home icon-white"></i> Home</a></li>
					      <li><a href="?action=C"><i class="icon-list-alt"></i> Controllers</a></li>
					      <li><a href="?action=M"><i class="icon-list"></i> Models</a></li>
					      <li><a href="?action=S"><i class="icon-lock"></i> Scaffold</a></li>
					      <li><a href="?action=E"><i class="icon-info-sign"></i> Config</a></li>
					    </ul>
					</div>
			    </div>
			    <div class="span9 well">
			    	<!--Body content-->
			    	<?php 
			    		if(!isset($_GET['action'])){ 
			    	?>
			    	<h1>Welcome to Web Developer Tools</h1>
			    	<p>Application to use Phalcon Developer Tools by web server.</p>
			    	<?php } else { 
			    			$WebDeveloperTools = new WebDeveloperTools();
			    			switch ($_GET['action']) {

			    				/*Controllers*/
			    				case 'C':
			    					echo $WebDeveloperTools->getControllers();
			    					break;
			    				case 'saveC':
			    					echo $WebDeveloperTools->saveC();
			    					break;

			    				/*Models*/		
			    				case 'M':
			    					echo $WebDeveloperTools->getModels();
			    					break;
			    				case 'saveM':
			    					echo $WebDeveloperTools->saveM();
			    					break;
			    				
			    				case 'S':
			    					echo $WebDeveloperTools->getScaffold();
			    					break;
			    				
			    				case 'E':
			    					echo $WebDeveloperTools->getConfig();
			    					break;
			    				
			    				default:
			    					break;
			    			}
			    	?>

			    	<?php }	?>
			    </div>
		    </div>
	    </div>
	    <script type="text/javascript" href="public/js/bootstrap/bootstrap.min.js"></script>
	</body>
</html>

<?php

require_once 'config.php';
$PTOOLSPATH = $settings['webtools']['PTOOLSPATH'];
require_once $PTOOLSPATH.'scripts/Script/Script.php';
require_once $PTOOLSPATH.'scripts/Script/Color/ScriptColor.php';
require_once $PTOOLSPATH.'scripts/Builder/Builder.php';

use Phalcon_Builder as Builder;

class WebDeveloperTools {


	private $_settings;

	/**
	* Load the default config in the project
	*/
	public function __construct(){
		
		$this->_settings = new Phalcon_Config_Adapter_Ini("../app/config/config.ini");
		$this->_settings->webdevtools = $webDevToolsConfig->webdevtools;
		$projectPath = $this->_settings->webdevtools->PROJECTPATH = $settings['webtools']['PROJECTPATH'];
		$devToolsPath = $webDevToolsConfig->PTOOLSPATH = $settings['webtools']['PTOOLSPATH'];

		putenv('PROJECTPATH='.$projectPath);
		putenv('PTOOLSPATH='.$devToolsPath);

	}

	/**
	* Start connection to DB by config.ini
	*/
	public function getConnection(){
		try {
			$connection = Phalcon_Db::factory($this->_settings->database->adapter, $this->_settings->database, true);				
			$connection->setFetchMode(Phalcon_Db::DB_NUM);

			return $connection;
		}
		catch(Phalcon_Db_Exception $e){
			echo $e->getMessage(), PHP_EOL;
		}
	}
	
	/**
	* Check remote address ip to block remote changes 
	*/
	public function checkIp(){
		if(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR']=='127.0.0.1'){
			return false;
		} else {
			die('WebDeveloperTools is only to local machine!');
		}
	}

	/**
	* Make HTML view to Controllers
	*/
	public function getControllers()	{
		self::checkIp();

		$html = '<div class="span9">
			<h1>Web Developer Tools Controllers Administration</h1>
			<br/>
			<form method="POST" class="forma-horizontal" action="?action=saveC">
				<fieldset>
				<div class="control-group">
					<label class="control-label" for="name">Table name</label>
					<div class="controls">
						'.Phalcon_Tag::textField(array('name','class'=>'input-xlarge', 'placeholder'=>'Table name ...','style'=>'height:30px;')).'
					</div>
				</div>
				<label class="checkbox">
					<input type="checkbox" name="force" value="1"> Force
				</label>
				<div class="form-sactions" align="right">
		        	<button class="btn btn-primary" type="submit">Save changes</button>
		        	<input class="btn" type="reset" value="Cancel"/>
		        </div>
		        </fieldset>
			</form>
		</div>';

		return $html;
	}

	public function saveC(){
		$request = Phalcon_Request::getInstance();
		$html = '';

		$name = $request->getPost('name');
		$force = $request->getPost('force');
		$PTOOLSPATH = $this->_settings->webdevtools->PTOOLSPATH;
		$PROJECTPATH = $this->_settings->webdevtools->PROJECTPATH;
		require_once $PTOOLSPATH.'scripts/Script/Script.php';
		require_once $PTOOLSPATH.'scripts/Script/Color/ScriptColor.php';
		require_once $PTOOLSPATH.'scripts/Builder/Builder.php';

		try{
			$modelBuilder = Phalcon_Builder::factory('Controller', array(
				'name' => $name, 'PTOOLSPATH'=>$PTOOLSPATH, 'PROJECTPATH'=>$PROJECTPATH, 'force'=>$force
			));
			
			if($modelBuilder){
				$html = $modelBuilder->build();
			}
			$html = '<div class="alert alert-success">The controller "'.$name.'" was created success</div>';
			$html .= $this->getControllers();
		}catch(Phalcon_BuilderException $e){
			$html = '<div class="alert alert-error">'.$e->getMessage().'</div>';
			$html .= $this->getControllers();
		}

		return $html;
	}

	/**
	* Make HTML view to Models
	*/
	public function getModels()	{
		self::checkIp();

		$connection = $this->getConnection();
		
		$tables = array();
		$result = $connection->query("SHOW TABLES");
		while($table = $connection->fetchArray($result)){
			$tables[$table[0]]=$table[0];
		}
		
		$html = '<div class="span9">
			<h1>Web Developer Tools Models Administration</h1>
			<br/>
			<form method="POST" class="forma-horizontal" action="?action=saveM">
				<table class="table table-striped table-bordered table-condensed">
					<tr>
						<td><b>Schema</b></td>
						<td><i>'.$this->_settings->database->name.'</i></td>
					</tr>
					<!--<tr>
						<td><b>All models</b></td>
						<td><i><input type="checkbox" name="allModels" value="1" /></i></td>
					</tr>-->
					<tr>
						<td><b>Table name</b></td>
						<td><i>'.Phalcon_Tag::selectStatic('table-name', $tables).'</i></td>
					</tr>
					<tr>
						<td><b>Add setters and getters</b></td>
						<td><i><input type="checkbox" name="gen-setters-getters" checked="checked" value="1"/></i></td>
					</tr>
					<tr>
						<td><b>Force</b></td>
						<td><i><input type="checkbox" name="force" value="1"/></i></td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="form-actions" align="right">
					        	<button class="btn btn-primary" type="submit">Save changes</button>
					        	<button class="btn">Cancel</button>
					        </div>
						</td>
					</tr>
				</table>
			</form>
		</div>';

		return $html;
	}

	public function saveM(){
		$request = Phalcon_Request::getInstance();
		$html = '';

		$genSettersGetters = $request->getPost('gen-setters-getters', 'int');
		$tableName = $request->getPost('table-name');
		$force = $request->getPost('force', 'int');

		$PTOOLSPATH = $this->_settings->webdevtools->PTOOLSPATH;
		$PROJECTPATH = $this->_settings->webdevtools->PROJECTPATH;
		require_once $PTOOLSPATH.'scripts/Script/Script.php';
		require_once $PTOOLSPATH.'scripts/Script/Color/ScriptColor.php';
		require_once $PTOOLSPATH.'scripts/Builder/Builder.php';

		try{
			$modelBuilder = Phalcon_Builder::factory('Model', array(
				'name' => $tableName, 'genSettersGetters' => $genSettersGetters, 
				'PTOOLSPATH' => $PTOOLSPATH, 'PROJECTPATH' => $PROJECTPATH, 'force' => $force
			));
			
			if($modelBuilder){
				$html = $modelBuilder->build();
			}
			$html = '<div class="alert alert-success">The model "'.$tableName.'" was created success</div>';
			$html .= $this->getModels();
		}catch(Phalcon_BuilderException $e){
			$html = '<div class="alert alert-error">'.$e->getMessage().'</div>';
			$html .= $this->getModels();
		}

		return $html;
	}	

	/**
	* Make HTML view to Scaffold
	*/
	public function getScaffold()	{
		self::checkIp();

		$connection = $this->getConnection();
		
		$tables = array();
		$result = $connection->query("SHOW TABLES");
		while($table = $connection->fetchArray($result)){
			$tables[$table[0]]=$table[0];
		}
		
		$html = '<div class="span9">
			<h1>Web Developer Tools Scaffold Administration</h1>
			<br/>
			<form class="forma-horizontal" action="?action=saveS">
				<table class="table table-striped table-bordered table-condensed">
					<tr>
						<td><b>Schema</b></td>
						<td><i>'.$this->_settings->database->name.'</i></td>
					</tr>
					<tr>
						<td><b>Table name</b></td>
						<td><i>'.Phalcon_Tag::selectStatic('table-name', $tables).'</i></td>
					</tr>
					<tr>
						<td><b>Force</b></td>
						<td><i><input type="checkbox" name="force" /></i></td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="form-actions" align="right">
					        	<button class="btn btn-primary" type="submit">Save changes</button>
					        	<button class="btn">Cancel</button>
					        </div>
						</td>
					</tr>
				</table>
			</form>
		</div>';

		return $html;
	}

	public function getConfig()	{
		self::checkIp();
		$phalconToolsPath = getenv("PTOOLSPATH");
		//var_dump($phalconToolsPath);
		$html = '<div class="span7">
			<h1>Web Developer Tools Configuration</h1>
			<br/>
			<table class="table table-striped table-bordered table-condensed">
				<tr>
					<td><b>Adapter</b></td>
					<td><i>'.$this->_settings->database->adapter.'</i></td>
				</tr>
				<tr>
					<td><b>Database</b></td>
					<td><i>'.$this->_settings->database->name.'</i></td>
				</tr>
				<tr>
					<td><b>Controllers path</b></td>
					<td><i>'.$this->_settings->phalcon->controllersDir.'</i></td>
				</tr>
				<tr>
					<td><b>Models path</b></td>
					<td><i>'.$this->_settings->phalcon->modelsDir.'</i></td>
				</tr>
				<tr>
					<td><b>View path</b></td>
					<td><i>'.$this->_settings->phalcon->viewsDir.'</i></td>
				</tr>
			</table>
		</div>';

		return $html;
	}

}
?>