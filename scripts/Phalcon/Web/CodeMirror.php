<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Framework                                                      |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2014 Phalcon Team (http://www.phalconphp.com)       |
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
		// Set paths
		$codemirror = realpath(__DIR__ . '/../../../') . '/resources/codemirror';
		$js = $path . 'public/js/codemirror';
		$css = $path . 'public/css/codemirror';

		// Install bootstrap
		if ( ! is_dir($js)) {
			mkdir($js . '/lib', 0777, true);
			mkdir($js . '/mode/php', 0777, true);
			mkdir($js . '/mode/css', 0777);
			mkdir($js . '/mode/clike', 0777);
			mkdir($js . '/mode/xml', 0777);

			touch($js . '/index.html');
            touch($js . '/lib/index.html');
            touch($js . '/mode/index.html');

			$libs = array('codemirror', 'codephalcon');
			$modes = array('php', 'css', 'clike', 'xml');

			foreach ($libs as $lib) {
				copy($codemirror . '/lib/' . $lib . '.js', $js . '/lib/' . $lib . '.js');
			}

			foreach ($modes as $mode) {
				copy($codemirror . '/mode/' . $mode . '/' . $mode . '.js', $js . '/mode/' . $mode . '/' . $mode . '.js');

				if ( ! file_exists($js . '/mode/' . $mode . '/index.html'))
                    touch($js . '/mode/' . $mode . '/index.html');
			}
		}

		if ( ! file_exists($css)) {
			mkdir($css, 0777, true);
            touch($css . '/index.html');
			copy($codemirror . '/lib/codemirror.css', $css . '/codemirror.css');
			copy($codemirror . '/lib/codephalcon.css', $css . '/codephalcon.css');
		}
	}
}
