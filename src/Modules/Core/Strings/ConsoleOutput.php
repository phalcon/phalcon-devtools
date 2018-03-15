<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-present Phalcon Team (https://www.phalconphp.com)   |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>             |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Devtools\Modules\Core\Strings;

/**
 * Phalcon\Devtools\Modules\Core\Strings\ConsoleOutput
 *
 * Allows to generate messages using colors on xterm, ddterm, linux, etc.
 *
 * @package Phalcon\Devtools\Modules\Core\Strings
 * @codeCoverageIgnoreStart
 */
class ConsoleOutput
{
    /**
     * @var array Map of supported foreground colors
     */
    protected $foregroundColor = [
        'fg_black'        => '0;30',
        'fg_dark_gray'    => '1;30',
        'fg_red'          => '0;31',
        'fg_light_red'    => '1;31',
        'fg_green'        => '0;32',
        'fg_light_green'  => '1;32',
        'fg_brown'        => '0;33',
        'fg_yellow'       => '1;33',
        'fg_blue'         => '0;34',
        'fg_light_blue'   => '1;34',
        'fg_purple'       => '0;35',
        'fg_light_purple' => '1;35',
        'fg_cyan'         => '0;36',
        'fg_light_cyan'   => '1;36',
        'fg_light_gray'   => '0;37',
        'fg_white'        => '1;37',
    ];

    /**
     * @var array Map of supported attributes
     */
    protected $supportedAttributes = [
        'at_normal'    => '0',
        'at_bold'      => '1',
        'at_italic'    => '3',
        'at_underline' => '4',
        'at_blink'     => '5',
        'at_outline'   => '6',
        'at_reverse'   => '7',
        'at_nondisp'   => '8',
        'at_strike'    => '9',
    ];

    /**
     * @var array Map of supported background colors
     */
    protected $backgroundColor = [
        'bg_black'      => '40',
        'bg_red'        => '41',
        'bg_green'      => '42',
        'bg_yellow'     => '43',
        'bg_blue'       => '44',
        'bg_magenta'    => '45',
        'bg_cyan'       => '46',
        'bg_light_gray' => '47',
    ];

    /**
     * @param string $message
     * @return string
     */
    public function headMessage(string $message)
    {
        return $this->colorizeString($message, [$this->foregroundColor['fg_brown']]);
    }

    /**
     * Color style for error messages.
     *
     * @param string $message
     * @return string
     */
    public function errorMessage(string $message)
    {
        $message = 'Error: ' . $message;
        $params = $this->getColorizeParams(['bg' => $this->backgroundColor['bg_red']]);

        return $this->getColorizedMessageWithParams($message, $params);
    }

    /**
     * Color style for success messages.
     *
     * @param string $message
     * @return string
     */
    public function successMessage(string $message)
    {
        $message = 'Success: ' . $message;
        $params = $this->getColorizeParams(['bg' => $this->backgroundColor['bg_green']]);

        return $this->getColorizedMessageWithParams($message, $params);
    }

    /**
     * Color style for info messages.
     *
     * @param string $message
     * @return string
     */
    public function infoMessage(string $message)
    {
        $message = 'Info: ' . $message;
        $params = $this->getColorizeParams(['bg' => $this->backgroundColor['bg_blue']]);

        return $this->getColorizedMessageWithParams($message, $params);
    }

    /**
     * @param string $string
     * @param array $params
     *
     * @return string
     */
    protected function colorizeString(string $string, array $params = [])
    {
        if (!$this->isSupportedShell()) {
            return $string;
        }

        $coloredString = '';

        foreach ($params as $color) {
            if (isset($color)) {
                $coloredString .= $this->addColor($color);
            }
        }

        $coloredString .= $string . "\033[0m";

        return $coloredString;
    }

    /**
     * Identify if console supports colors
     *
     * @return boolean
     */
    protected function isSupportedShell()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            return false !== getenv('ANSICON') || 'ON' === getenv('ConEmuANSI') || 'xterm' === getenv('TERM');
        }

        return defined('STDOUT') && function_exists('posix_isatty') && posix_isatty(STDOUT);
    }

    /**
     * Color style for current type.
     *
     * @param string $color
     * @return string
     */
    protected function addColor(string $color)
    {
        return "\033[" . $color . "m";
    }

    /**
     * @param array $params
     * @return array
     */
    protected function getColorizeParams(array $params = [])
    {
        $defaultParams = [
            'fg' => $this->foregroundColor['fg_white'],
            'at' => $this->supportedAttributes['at_bold'],
        ];

        return array_merge($defaultParams, $params);
    }

    /**
     * @return string
     */
    protected function getColorizedMessageWithParams(string $message, array $params)
    {
        $space = strlen($message) + 4;

        $outputString = $this->colorizeString(str_pad(' ', $space), $params) . PHP_EOL;
        $outputString .= $this->colorizeString('  ' . $message . '  ', $params) . PHP_EOL;
        $outputString .= $this->colorizeString(str_pad(' ', $space), $params) . PHP_EOL;

        return $outputString;
    }
}
/**
 * @codeCoverageIgnoreEnd
 */
