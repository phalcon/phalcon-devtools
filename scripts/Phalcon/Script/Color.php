<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (https://www.phalconphp.com)      |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Script;

/**
 * \Phalcon\Script\Color
 *
 * Allows to generate messages using colors on xterm, ddterm, linux, etc.
 *
 * @package Phalcon\Script
 */
final class Color
{
    const FG_BLACK = 1;
    const FG_DARK_GRAY = 2;
    const FG_BLUE = 3;
    const FG_LIGHT_BLUE = 4;
    const FG_GREEN = 5;
    const FG_LIGHT_GREEN = 6;
    const FG_CYAN = 7;
    const FG_LIGHT_CYAN = 8;
    const FG_RED = 9;
    const FG_LIGHT_RED = 10;
    const FG_PURPLE = 11;
    const FG_LIGHT_PURPLE = 12;
    const FG_BROWN = 13;
    const FG_YELLOW = 14;
    const FG_LIGHT_GRAY = 15;
    const FG_WHITE = 16;

    const BG_BLACK = 1;
    const BG_RED = 2;
    const BG_GREEN = 3;
    const BG_YELLOW = 4;
    const BG_BLUE = 5;
    const BG_MAGENTA = 6;
    const BG_CYAN = 7;
    const BG_LIGHT_GRAY = 8;

    const AT_NORMAL = 1;
    const AT_BOLD = 2;
    const AT_ITALIC = 3;
    const AT_UNDERLINE = 4;
    const AT_BLINK = 5;
    const AT_OUTLINE = 6;
    const AT_REVERSE = 7;
    const AT_NONDISP = 8;
    const AT_STRIKE = 9;

    /**
     * @var array Map of supported foreground colors
     */
    private static $fg = array(
        self::FG_BLACK        => '0;30',
        self::FG_DARK_GRAY    => '1;30',
        self::FG_RED          => '0;31',
        self::FG_LIGHT_RED    => '1;31',
        self::FG_GREEN        => '0;32',
        self::FG_LIGHT_GREEN  => '1;32',
        self::FG_BROWN        => '0;33',
        self::FG_YELLOW       => '1;33',
        self::FG_BLUE         => '0;34',
        self::FG_LIGHT_BLUE   => '1;34',
        self::FG_PURPLE       => '0;35',
        self::FG_LIGHT_PURPLE => '1;35',
        self::FG_CYAN         => '0;36',
        self::FG_LIGHT_CYAN   => '1;36',
        self::FG_LIGHT_GRAY   => '0;37',
        self::FG_WHITE        => '1;37',
    );

    /**
     * @var array Map of supported background colors
     */
    private static $bg = array(
        self::BG_BLACK      => '40',
        self::BG_RED        => '41',
        self::BG_GREEN      => '42',
        self::BG_YELLOW     => '43',
        self::BG_BLUE       => '44',
        self::BG_MAGENTA    => '45',
        self::BG_CYAN       => '46',
        self::BG_LIGHT_GRAY => '47',
    );

    /**
     * @var array Map of supported attributes
     */
    private static $at = array(
        self::AT_NORMAL    => '0',
        self::AT_BOLD      => '1',
        self::AT_ITALIC    => '3',
        self::AT_UNDERLINE => '4',
        self::AT_BLINK     => '5',
        self::AT_OUTLINE   => '6',
        self::AT_REVERSE   => '7',
        self::AT_NONDISP   => '8',
        self::AT_STRIKE    => '9',
    );

    /**
     * Identify if console supports colors
     *
     * @return boolean
     */
    public static function isSupportedShell()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            return false !== getenv('ANSICON') || 'ON' === getenv('ConEmuANSI') || 'xterm' === getenv('TERM');
        }

        return defined('STDOUT') && function_exists('posix_isatty') && posix_isatty(STDOUT);
    }

    /**
     * Colorizes the string using provided colors.
     *
     * @static
     * @param string $string
     * @param null|integer $fg
     * @param null|integer $at
     * @param null|integer $bg
     *
     * @return string
     */
    public static function colorize($string, $fg = null, $at = null, $bg = null)
    {
        // Shell not supported, exit early
        if (!static::isSupportedShell()) {
            return $string;
        }

        $colored = '';

        // Check if given foreground color is supported
        if (isset(static::$fg[$fg])) {
            $colored .= "\033[" . static::$fg[$fg] . "m";
        }

        // Check if given background color is supported
        if (isset(static::$bg[$bg])) {
            $colored .= "\033[" . static::$bg[$bg] . "m";
        }

        // Check if given attribute is supported
        if (isset(static::$at[$at])) {
            $colored .= "\033[" . static::$at[$at] . "m";
        }

        // Add string and end coloring
        $colored .=  $string . "\033[0m";

        return $colored;
    }

    public static function head($msg)
    {
        return static::colorize($msg, Color::FG_BROWN);
    }

    /**
     * Color style for error messages.
     *
     * @static
     * @param string $msg
     * @return string
     */
    public static function error($msg)
    {
        $msg = 'Error: ' . $msg;
        $space = strlen($msg) + 4;
        $out  = static::colorize(str_pad(' ', $space), Color::FG_WHITE, Color::AT_BOLD, Color::BG_RED) . PHP_EOL;
        $out .= static::colorize('  ' . $msg . '  ', Color::FG_WHITE, Color::AT_BOLD, Color::BG_RED) . PHP_EOL;
        $out .= static::colorize(str_pad(' ', $space), Color::FG_WHITE, Color::AT_BOLD, Color::BG_RED) . PHP_EOL;

        return $out;
    }

    /**
     * Color style for success messages.
     *
     * @static
     * @param string $msg
     * @return string
     */
    public static function success($msg)
    {
        $msg = 'Success: ' . $msg;
        $space = strlen($msg) + 4;
        $out  = static::colorize(str_pad(' ', $space), Color::FG_WHITE, Color::AT_BOLD, Color::BG_GREEN) . PHP_EOL;
        $out .= static::colorize('  ' . $msg . '  ', Color::FG_WHITE, Color::AT_BOLD, Color::BG_GREEN) . PHP_EOL;
        $out .= static::colorize(str_pad(' ', $space), Color::FG_WHITE, Color::AT_BOLD, Color::BG_GREEN) . PHP_EOL;

        return $out;
    }

    /**
     * Color style for info messages.
     *
     * @static
     * @param string $msg
     * @return string
     */
    public static function info($msg)
    {
        $msg = 'Info: ' . $msg;
        $space = strlen($msg) + 4;
        $out  = static::colorize(str_pad(' ', $space), Color::FG_WHITE, Color::AT_BOLD, Color::BG_BLUE) . PHP_EOL;
        $out .= static::colorize('  ' . $msg . '  ', Color::FG_WHITE, Color::AT_BOLD, Color::BG_BLUE) . PHP_EOL;
        $out .= static::colorize(str_pad(' ', $space), Color::FG_WHITE, Color::AT_BOLD, Color::BG_BLUE) . PHP_EOL;

        return $out;
    }
}
