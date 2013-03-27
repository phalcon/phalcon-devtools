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

namespace Phalcon\Web;

use Phalcon\Tag;

/**
 * Phalcon\Web\CodeMirror
 *
 * This class installs code-mirror in the app
 */
abstract class CodeMirror
{

	public static function importResources()
	{
		echo Tag::javascriptInclude('js/codemirror/lib/codemirror.js');
		echo Tag::javascriptInclude('js/codemirror/mode/clike/clike.js');
		echo Tag::javascriptInclude('js/codemirror/mode/xml/xml.js');
		echo Tag::javascriptInclude('js/codemirror/mode/css/css.js');
		echo Tag::javascriptInclude('js/codemirror/mode/php/php.js');
		echo Tag::javascriptInclude('js/codemirror/lib/codephalcon.js');
		echo Tag::stylesheetLink('css/codemirror/codemirror.css');
		echo Tag::stylesheetLink('css/codemirror/codephalcon.css');
	}

	public static function install($path)
	{

		//Install bootstrap
		$jsPath = 'public/js/codemirror';
		if (!file_exists($jsPath)) {
			mkdir($jsPath, 0777, true);
			mkdir($jsPath.'/lib', 0777, true);
			file_put_contents($jsPath.'/index.html', '');
			copy($path.'resources/codemirror/lib/codemirror.js', $jsPath.'/lib/codemirror.js');
			copy($path.'resources/codemirror/lib/codephalcon.js', $jsPath.'/lib/codephalcon.js');

			mkdir($jsPath . '/mode/php', 0777, true);
			copy($path . 'resources/codemirror/mode/php/php.js', $jsPath.'/mode/php/php.js');
			file_put_contents($jsPath . '/mode/php/index.html', '');

			mkdir($jsPath . '/mode/css', 0777, true);
			copy($path . 'resources/codemirror/mode/css/css.js', $jsPath.'/mode/css/css.js');
			file_put_contents($jsPath . '/mode/css/index.html', '');

			mkdir($jsPath . '/mode/clike', 0777, true);
			copy($path . 'resources/codemirror/mode/clike/clike.js', $jsPath.'/mode/clike/clike.js');
			file_put_contents($jsPath . '/mode/clike/index.html', '');

			mkdir($jsPath . '/mode/xml', 0777, true);
			copy($path . 'resources/codemirror/mode/xml/xml.js', $jsPath.'/mode/xml/xml.js');
			file_put_contents($jsPath . '/mode/xml/index.html', '');
		}

		$cssPath = 'public/css/codemirror';
		if (!file_exists($cssPath)) {
			mkdir($cssPath, 0777, true);
			file_put_contents($cssPath.'/index.html', '');
			copy($path . 'resources/codemirror/lib/codemirror.css', $cssPath.'/codemirror.css');
			copy($path . 'resources/codemirror/lib/codephalcon.css', $cssPath.'/codephalcon.css');
		}

	}
}