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

use Phalcon_Builder as Builder;
use Phalcon_BuilderException as BuilderException;

/**
 * ApplicationBuilderComponent
 *
 * Builder para construir aplicaciones
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 * @version 	$Id: Application.php,v 7a54c57f039b 2011/10/19 23:41:19 andres $
 */
class ApplicationBuilderComponent {

	/**
	 * Create .INI file by default of application
	 *
	 */
	private static function createINIFiles($path, $name){
		if(file_exists($path.'app/config/config.ini')==false){
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

	/**
	 * Create Bootstrap file by default of application
	 *
	 */
	private static function createBootstrapFile($path){
		if(file_exists($path.'public/index.php')==false){
			$code = "<?php".PHP_EOL.PHP_EOL.
				"try {".PHP_EOL.
				PHP_EOL.
				"\t"."\$front = Phalcon_Controller_Front::getInstance();".PHP_EOL.
				PHP_EOL.
				"\t"."\$config = new Phalcon_Config_Adapter_Ini(\"../app/config/config.ini\");".PHP_EOL.
 				"\t"."\$front->setConfig(\$config);".PHP_EOL.
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
		$modelBuilder = Builder::factory('Controller', array(
			'name' => 'index',
			'directory' => $path			
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

	}

	/**
	 * Create view files by default
	 *
	 */
	private static function createIndexViewFiles($path){
		$str = '<html>'.PHP_EOL.
				"\t".'<head>'.PHP_EOL.
				"\t\t".'<title>Phalcon PHP Framework</title>'.PHP_EOL.
				"\t".'</head>'.PHP_EOL.
				"\t".'<body>'.PHP_EOL.
				"\t\t".'<?php echo $this->getContent(); ?>'.PHP_EOL.
				"\t".'</body>'.PHP_EOL.
				'</html>';
		file_put_contents($path.'app/views/index.phtml', $str);

		$str = '<h1>Congratulations!</h1>'.PHP_EOL.'You\'re now flying with Phalcon.';
		file_put_contents($path.'app/views/index/index.phtml', $str);
	}

	public function __construct($options){
		$this->_options = $options;		
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
		@mkdir($path.'public/javascript');

		self::createINIFiles($path, $name);
		self::createBootstrapFile($path);
		self::createHtaccessFiles($path);
		self::createIndexViewFiles($path);
		self::createControllerFile($path);

	}


}