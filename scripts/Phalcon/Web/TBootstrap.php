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

abstract class TBootstrap
{

	public static function install($path)
	{
		// Set paths
		$bootstrap = realpath(__DIR__ . '/../../../') . '/resources/bootstrap';
		$js = $path . 'public/js/bootstrap';
		$css = $path . 'public/css/bootstrap';
		$img = $path . 'public/img/bootstrap';

		//Install bootstrap
		if ( ! file_exists($js)) {
			mkdir($js, 0777, true);
			file_put_contents($js . '/index.html', "");
			copy($bootstrap . '/js/bootstrap.min.js', $js . '/bootstrap.min.js');
		}

		if ( ! file_exists($css)) {
			mkdir($css, 0777, true);
			file_put_contents($css . '/index.html', "");
			copy($bootstrap . '/css/bootstrap.min.css', $css . '/bootstrap.min.css');
		}

		if ( ! file_exists($img)) {
			mkdir($img, 0777, true);
			file_put_contents($img . '/index.html', "");
			copy($bootstrap . '/img/glyphicons-halflings.png', $img . '/glyphicons-halflings.png');
		}
	}
}