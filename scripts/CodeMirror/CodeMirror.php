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

abstract class CodeMirror {

	public static function importResources(){
		echo Phalcon_Tag::javascriptInclude('javascript/codemirror/lib/codemirror.js');
		echo Phalcon_Tag::javascriptInclude('javascript/codemirror/mode/clike/clike.js');
		echo Phalcon_Tag::javascriptInclude('javascript/codemirror/mode/xml/xml.js');
		echo Phalcon_Tag::javascriptInclude('javascript/codemirror/mode/css/css.js');
		echo Phalcon_Tag::javascriptInclude('javascript/codemirror/mode/php/php.js');
		echo Phalcon_Tag::javascriptInclude('javascript/codemirror/lib/codephalcon.js');
		echo Phalcon_Tag::stylesheetLink('css/codemirror/codemirror.css');
		echo Phalcon_Tag::stylesheetLink('css/codemirror/codephalcon.css');
	}

	public static function install($path){

		//Install bootstrap
		$jsPath = $path.'public/javascript/codemirror';
		if(!file_exists($jsPath)){
			mkdir($jsPath, 0777, true);
			mkdir($jsPath.'/lib', 0777, true);
			file_put_contents($jsPath.'/index.html', '');
			copy('resources/codemirror/lib/codemirror.js', $jsPath.'/lib/codemirror.js');
			copy('resources/codemirror/lib/codephalcon.js', $jsPath.'/lib/codephalcon.js');

			mkdir($jsPath.'/mode/php', 0777, true);
			copy('resources/codemirror/mode/php/php.js', $jsPath.'/mode/php/php.js');
			file_put_contents($jsPath.'/mode/php/index.html', '');

			mkdir($jsPath.'/mode/css', 0777, true);
			copy('resources/codemirror/mode/css/css.js', $jsPath.'/mode/css/css.js');
			file_put_contents($jsPath.'/mode/css/index.html', '');

			mkdir($jsPath.'/mode/clike', 0777, true);
			copy('resources/codemirror/mode/clike/clike.js', $jsPath.'/mode/clike/clike.js');
			file_put_contents($jsPath.'/mode/clike/index.html', '');

			mkdir($jsPath.'/mode/xml', 0777, true);
			copy('resources/codemirror/mode/xml/xml.js', $jsPath.'/mode/xml/xml.js');
			file_put_contents($jsPath.'/mode/xml/index.html', '');
		}

		$cssPath = $path.'public/css/codemirror';
		if(!file_exists($cssPath)){
			mkdir($cssPath, 0777, true);
			file_put_contents($cssPath.'/index.html', '');
			copy('resources/codemirror/lib/codemirror.css', $cssPath.'/codemirror.css');
			copy('resources/codemirror/lib/codephalcon.css', $cssPath.'/codephalcon.css');
		}

	}
}