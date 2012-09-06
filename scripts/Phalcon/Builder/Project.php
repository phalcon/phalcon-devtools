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

use Phalcon\Builder;
use Phalcon\Builder\Component;
use Phalcon\Builder\Exception as BuilderException;
use Phalcon\Script\Color;

/**
 * ProjectBuilderComponent
 *
 * Builder to create application skeletons
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 * @version 	$Id: Application.php,v 7a54c57f039b 2011/10/19 23:41:19 andres $
 */
class Project extends Component {

	/**
	 * Creates a default configuration file with INI format
	 *
	 */
	private static function createINIConfig($path, $name) {
		if (file_exists($path.'app/config/config.ini') == false) {
			$str =	'[database]'.PHP_EOL.
			'adapter = Mysql'.PHP_EOL.
			'host = "127.0.0.1"'.PHP_EOL.
			'username = "root"'.PHP_EOL.
			'password = ""'.PHP_EOL.
			'name = "test_db"'.PHP_EOL.
			''.PHP_EOL.
			'[phalcon]'.PHP_EOL.
			'controllersDir = "../app/controllers/"'.PHP_EOL.
			'modelsDir = "../app/models/"'.PHP_EOL.
			'viewsDir = "../app/views/"'.PHP_EOL.
			'baseUri = "/'.$name.'/"'.PHP_EOL;
			file_put_contents($path.'app/config/config.ini', $str);
		}
	}

	private static function createPHPConfig($path, $name){
		if (file_exists($path.'app/config/config.php') == false) {
			$str =	"<?php".PHP_EOL.
			"".PHP_EOL.
			"\$config = new \\Phalcon\\Config(array(".PHP_EOL.
			"	'database' => array(".PHP_EOL.
			"		'adapter' => 'Mysql',".PHP_EOL.
			"		'host' => 'localhost',".PHP_EOL.
			"		'username' => 'phalcon',".PHP_EOL.
			"		'password' => 'secret',".PHP_EOL.
			"		'name' => 'php_site'".PHP_EOL.
			"	),".PHP_EOL.
			"	'phalcon' => array(".PHP_EOL.
			"		'controllersDir' => '../app/controllers/',".PHP_EOL.
			"		'modelsDir' => '../app/models/',".PHP_EOL.
			"		'viewsDir' => '../app/views/',".PHP_EOL.
			"		'baseUri' => '/".$name."/'".PHP_EOL.
			"	),".PHP_EOL.			
			"));".PHP_EOL;
			file_put_contents($path.'app/config/config.php', $str);
		}
	}

	/**
	 * Create ControllerBase
	 *
	 */
	private static function createControllerBase($path){
		$file = $path.'app/controllers/ControllerBase.php';
		if(file_exists($file)==false){
			$code = "<?php".PHP_EOL.PHP_EOL.
			"class ControllerBase extends Phalcon_Controller {".PHP_EOL.PHP_EOL."}".PHP_EOL;
			file_put_contents($file, $code);
		}
	}

	/**
	 * Create Bootstrap file by default of application
	 *
	 */
	private static function createBootstrapFile($path, $useIniConfig){
		if(file_exists($path.'public/index.php')==false){
			$code = "<?php".PHP_EOL.PHP_EOL.
			"error_reporting(E_ALL);".PHP_EOL.PHP_EOL.
			"try {".PHP_EOL.
			PHP_EOL.
			"\t"."require \"../app/controllers/ControllerBase.php\";".PHP_EOL;
			if(!$useIniConfig){
				$code.="\t"."require \"../app/config/config.php\";".PHP_EOL;
			}
			$code.=PHP_EOL.
			"\t"."\$front = Phalcon_Controller_Front::getInstance();".PHP_EOL.
			PHP_EOL;
			if($useIniConfig){
				$code.="\t"."\$config = new Phalcon_Config_Adapter_Ini(\"../app/config/config.ini\");".PHP_EOL;
			} 
 			$code.="\t"."\$front->setConfig(\$config);".PHP_EOL.
 			PHP_EOL.
			"\t"."echo \$front->dispatchLoop()->getContent();".PHP_EOL.
			"}".PHP_EOL.
			"catch(Phalcon_Exception \$e){".PHP_EOL.
			"\t"."echo \"PhalconException: \", \$e->getMessage();".PHP_EOL.
			"}";
			file_put_contents($path.'public/index.php', $code);	
		}
	}

	/**
	 * Create indexController file
	 *
	 */
	private static function createControllerFile($path){
		$modelBuilder = Builder::factory('\\Phalcon\\Builder\\Controller', array(
			'name' => 'index',
			'directory' => $path,
			'baseClass' => 'ControllerBase'
		));
		$modelBuilder->build();
	}

	/**
	 * Create .htaccess files by default of application
	 *
	 */
	private static function createHtaccessFiles($path){

		if(file_exists($path.'.htaccess')==false){
			$code = '<IfModule mod_rewrite.c>'.PHP_EOL.
				"\t".'RewriteEngine on'.PHP_EOL.
				"\t".'RewriteRule  ^$ public/    [L]'.PHP_EOL.
				"\t".'RewriteRule  (.*) public/$1 [L]'.PHP_EOL.
				'</IfModule>';
			file_put_contents($path.'.htaccess', $code);
		}

		if(file_exists($path.'public/.htaccess')==false){
			$code = 'AddDefaultCharset UTF-8'.PHP_EOL.
				'<IfModule mod_rewrite.c>'.PHP_EOL.
				"\t".'RewriteEngine On'.PHP_EOL.
				"\t".'RewriteCond %{REQUEST_FILENAME} !-d'.PHP_EOL.
				"\t".'RewriteCond %{REQUEST_FILENAME} !-f'.PHP_EOL.
				"\t".'RewriteRule ^(.*)$ index.php?_url=$1 [QSA,L]'.PHP_EOL.
				'</IfModule>';
			file_put_contents($path.'public/.htaccess', $code);
		}

		if(file_exists($path.'index.html')==false){
			$code = '<html><body><h1>Mod-Rewrite is not enabled</h1><p>Please enable rewrite module on your web server to continue</body></html>';
			file_put_contents($path.'index.html', $code);
		}

	}

	/**
	 * Create view files by default
	 *
	 */
	private static function createIndexViewFiles($path){

		$file = $path.'app/views/index.phtml';
		if(!file_exists($file)){
			$str = '<!DOCTYPE html>'.PHP_EOL.
			'<html>'.PHP_EOL.
			"\t".'<head>'.PHP_EOL.
			"\t\t".'<title>Phalcon PHP Framework</title>'.PHP_EOL.
			"\t".'</head>'.PHP_EOL.
			"\t".'<body>'.PHP_EOL.
			"\t\t".'<?php echo $this->getContent(); ?>'.PHP_EOL.
			"\t".'</body>'.PHP_EOL.
			'</html>';
			file_put_contents($file, $str);
		}

		$file = $path.'app/views/index/index.phtml';
		if(!file_exists($file)){
			$str = '<h1>Congratulations!</h1>'.PHP_EOL.'You\'re now flying with Phalcon.';
			file_put_contents($file, $str);
		}
	}

	public function build(){

		$path = '';
		if(isset($this->_options['directory'])){
			if($this->_options['directory']){
				$path = $this->_options['directory'].'/';
			}
		}

		$name = null;
		if(isset($this->_options['name'])){
			if($this->_options['name']){
				$name = $this->_options['name'];
				$path .= $this->_options['name'].'/';
				@mkdir($path);
			}
		}

		if(!is_writable($path)){
			throw new BuilderException("Directory ".$path." is not writable");
		}

		@mkdir($path.'app');

		@mkdir($path.'app/logs');
		@mkdir($path.'app/views');
		@mkdir($path.'app/config');
		@mkdir($path.'app/models');
		@mkdir($path.'app/controllers');
		@mkdir($path.'app/views/index');
		@mkdir($path.'app/views/layouts');

		@mkdir($path.'public');
		@mkdir($path.'public/img');
		@mkdir($path.'public/css');
		@mkdir($path.'public/temp');
		@mkdir($path.'public/files');
		@mkdir($path.'public/js');

		@mkdir($path.'.phalcon');

		if(isset($this->_options['useIniConfig'])){
			$useIniConfig = $this->_options['useIniConfig'];
		} else {
			$useIniConfig = false;
		}

		if($useIniConfig){
			self::createINIConfig($path, $name);
		} else {
			self::createPHPConfig($path, $name);
		}
		self::createBootstrapFile($path, $useIniConfig);

		self::createHtaccessFiles($path);		
		self::createControllerBase($path);
		self::createIndexViewFiles($path);
		self::createControllerFile($path);

		if(isset($this->_options['enableWebTools']) && $this->_options['enableWebTools']){
			// TODO implement
			// Phalcon_WebTools::install($path);
		}

		print Color::success('Project ' . $this->_options['name'] . ' was successfully created.') . PHP_EOL;

	}


}