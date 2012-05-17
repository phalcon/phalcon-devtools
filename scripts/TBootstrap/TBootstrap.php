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

abstract class TBootstrap {

	public static function install($path){

		//Install bootstrap
		$jsPath = $path.'public/javascript/bootstrap';
		if(!file_exists($jsPath)){
			mkdir($jsPath, 0777, true);
			file_put_contents($jsPath.'/index.html', '');
			copy('resources/bootstrap/js/bootstrap.min.js', $jsPath.'/bootstrap.min.js');
		}

		$cssPath = $path.'public/css/bootstrap';
		if(!file_exists($cssPath)){
			mkdir($cssPath, 0777, true);
			file_put_contents($cssPath.'/index.html', '');
			copy('resources/bootstrap/css/bootstrap.min.css', $cssPath.'/bootstrap.min.css');
		}


		$imgPath = $path.'public/img/bootstrap';
		if(!file_exists($imgPath)){
			mkdir($imgPath, 0777, true);
			file_put_contents($imgPath.'/index.html', '');
			copy('resources/bootstrap/img/glyphicons-halflings.png', $imgPath.'/glyphicons-halflings.png');
		}

	}
}