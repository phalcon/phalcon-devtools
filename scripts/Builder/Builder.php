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

require_once 'BuilderException.php';

use Phalcon_BuilderException as BuilderException;
use Phalcon_Builder as Builder;
use Phalcon_Utils as Utils;

/**
 * Builder
 *
 * Loads components to generate code
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class Phalcon_Builder {

	/**
	 * Factories a builder component
	 *
	 * @param	string $component
	 * @param	array $options
	 * @return	Object
	 */
	public static function factory($component, $options=array()){
		$className = $component.'BuilderComponent';
		if(!class_exists($className, false)){
			$basePath = '';
			if(isset($options['PTOOLSPATH']) && $options['PTOOLSPATH']){
				$basePath = $options['PTOOLSPATH'];
			}
			$path = $basePath.'scripts/Builder/Components/'.$component.'.php';
			if(file_exists($path)){
				require_once $path;
			} else {
				throw new Phalcon_BuilderException('The builder component "'.$component.'" does not exist');
			}
		}
		$componentObject = new $className($options);
		return $componentObject;
	}

}
