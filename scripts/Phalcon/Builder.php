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

namespace Phalcon;

use \Phalcon\Builder\Exception as BuilderException;

/**
 * Builder
 *
 * Loads components to generate code
 *
 * @category 	Phalcon
 * @package 	Builder
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class Builder {

	/**
	 * Factories a builder component
	 *
	 * @static
	 * @param	string $component
	 * @param	array $options
	 * @return	\Phalcon\Builder\Component
	 * @throws  \Phalcon\Builder\Exception
	 */
	public static function factory($component, $options=array()) {
		// TODO Check why autoloader is not loading the classes
//		if (!in_array($component, get_declared_classes())) {
//			throw new BuilderException('The builder component "'.$component.'" does not exist');
//		}

		return new $component($options);
	}

}
