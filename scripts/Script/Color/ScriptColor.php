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
 * Allows to generate messages using colors on xterm, ddterm, linux, etc.
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class ScriptColor {

	/**
	 * Color by Default
	 *
	 */
	const NORMAL = 0;

	/**
	 * Red Color
	 *
	 */
	const RED = 1;

	/**
	 * Green Color
	 *
	 */
	const GREEN = 2;

	/**
	 * White Color
	 *
	 */
	const WHITE = 3;

	/**
	 * Black Color
	 *
	 */
	const BLACK = 4;

	/**
	 * Blue Color
	 *
	 */
	const BLUE = 5;

	/**
	 * Cyan Color
	 *
	 */
	const CYAN = 6;

	/**
	 * Magenta Color
	 *
	 */
	const MAGENTA = 7;

	/**
	 * Light Red Color
	 *
	 */
	const LIGHT_RED = 8;

	/**
	 * Bold Style
	 *
	 */
	const BOLD = 1;

	/**
	 * Underline style
	 *
	 */
	const UNDERLINE = 4;

	/**
	 * Blink effect
	 *
	 */
	const BLINK = 5;

	/**
	 * Whether console allows colors
	 *
	 * @var boolean
	 */
	private static $_isSupportedShell = false;

	/**
	 * Supported terminals
	 *
	 * @var string
	 */
	private static $_supportedShells = array(
		'xterm' => true,
		'xterm-256color' => true,
		'xterm-color' => true,
	);

	/**
	 * Sets component flags
	 *
	 * @param boolean $flags
	 */
	public static function setFlags($flags){
		self::$_isSupportedShell = $flags;
	}

	/**
	 * Identify if console supports colors
	 *
	 * @return boolean
	 */
	public static function lookSupportedShell(){
		self::$_isSupportedShell = false;
		if(isset($_ENV['TERM'])){
			if(isset(self::$_supportedShells[$_ENV['TERM']])){
				self::$_isSupportedShell = true;
			}
		} else {
			if(isset($_SERVER['TERM'])){
				if(isset(self::$_supportedShells[$_SERVER['TERM']])){
					self::$_isSupportedShell = true;
				}
			}
		}
		return self::$_isSupportedShell;
	}

	/**
	 * Returns a text coloured for console
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
