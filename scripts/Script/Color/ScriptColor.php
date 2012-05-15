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

/**
 * ScriptColor
 *
 * Permite generar colores en una consola xterm, ddterm, linux, etc.
 *
  @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class ScriptColor {

	/**
	 * Color por defecto de la consola
	 *
	 */
	const NORMAL = 0;

	/**
	 * Color Rojo
	 *
	 */
	const RED = 1;

	/**
	 * Color Verde
	 *
	 */
	const GREEN = 2;

	/**
	 * Color Blanco
	 *
	 */
	const WHITE = 3;

	/**
	 * Color Negro
	 *
	 */
	const BLACK = 4;

	/**
	 * Color Azul
	 *
	 */
	const BLUE = 5;

	/**
	 * Color Cyan
	 *
	 */
	const CYAN = 6;

	/**
	 * Color Magenta
	 *
	 */
	const MAGENTA = 7;

	/**
	 * Color Rojo Claro
	 *
	 */
	const LIGHT_RED = 8;

	/**
	 * Fuente en negrita
	 *
	 */
	const BOLD = 1;

	/**
	 * Fuente subrayada
	 *
	 */
	const UNDERLINE = 4;

	/**
	 * Fuente con parpadeo
	 *
	 */
	const BLINK = 5;

	/**
	 * Indica si la consola permite salida de colores
	 *
	 * @var boolean
	 */
	private static $_isSupportedShell = false;

	/**
	 * Nombres de las terminales soportadas
	 *
	 * @var string
	 */
	private static $_supportedShells = array(
		'xterm-256color' => true,
		'xterm-color' => true,
	);

	/**
	 * Establece las banderas de ScriptColor
	 *
	 * @param boolean $flags
	 */
	public static function setFlags($flags){
		self::$_isSupportedShell = $flags;
	}

	/**
	 * Identifica si la terminal actual soporta colores
	 *
	 * @return boolean
	 */
	public static function lookSupportedShell(){
		if(isset($_ENV['TERM'])){
			if(isset(self::$_supportedShells[$_ENV['TERM']])){
				self::$_isSupportedShell = true;
			} else {
				self::$_isSupportedShell = false;
			}
		}
		return self::$_isSupportedShell;
	}

	/**
	 * Devuelve un texto coloreado
	 *
	 * @param string $text
	 * @param int $color
	 * @param int $style
	 */
	public static function colorize($text, $color=ScriptColor::NORMAL, $style=ScriptColor::NORMAL){
		if(self::$_isSupportedShell==true){
			$escapeColor = "\033[".$style;
			switch($color){
				case ScriptColor::NORMAL:
					$escapeColor.= '38m';
					break;
				case ScriptColor::RED:
					$escapeColor.= '31m';
					break;
				case ScriptColor::LIGHT_RED:
					$escapeColor.= '1;31m';
					break;
				case ScriptColor::GREEN:
					$escapeColor.= '32m';
					break;
				case ScriptColor::WHITE:
					$escapeColor.= '37m';
					break;
				case ScriptColor::BLACK:
					$escapeColor.= '30m';
					break;
				case ScriptColor::BLUE:
					$escapeColor.= '34m';
					break;
				case ScriptColor::CYAN:
					$escapeColor.= '36m';
					break;
				case ScriptColor::MAGENTA:
					$escapeColor.= '35m';
					break;
			}
			return $escapeColor.$text."\033[0m";
		} else {
			return $text;
		}
	}

}
