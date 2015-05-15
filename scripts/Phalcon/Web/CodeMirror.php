<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2015 Phalcon Team (http://www.phalconphp.com)       |
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
  |          Serghei Iakovlev <sadhooklay@gmail.com>                       |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Web;

use Phalcon\Tag;

/**
 * CodeMirror Installer
 *
 * This class installs code-mirror in the app
 *
 * @package     Phalcon\Web
 * @copyright   Copyright (c) 2011-2015 Phalcon Team (team@phalconphp.com)
 * @license     New BSD License
 */
class CodeMirror implements InstallerInterface
{
    /**
     * Import CodeMirror resources
     *
     * @return void
     */
    public static function importResources()
    {
        echo Tag::stylesheetLink('css/codemirror/ambiance.css');
        echo Tag::stylesheetLink('css/codemirror/codemirror.css');
        echo Tag::javascriptInclude('js/codemirror/lib/codemirror.js');
        echo Tag::javascriptInclude('js/codemirror/addon/edit/matchbrackets.js');
        echo Tag::javascriptInclude('js/codemirror/addon/selection/active-line.js');
        echo Tag::javascriptInclude('js/codemirror/mode/clike/clike.js');
        echo Tag::javascriptInclude('js/codemirror/mode/htmlmixed/htmlmixed.js');
        echo Tag::javascriptInclude('js/codemirror/mode/xml/xml.js');
        echo Tag::javascriptInclude('js/codemirror/mode/css/css.js');
        echo Tag::javascriptInclude('js/codemirror/mode/php/php.js');
        echo Tag::javascriptInclude('js/codemirror/lib/codephalcon.js');
        echo Tag::stylesheetLink('css/codemirror/codephalcon.css');
    }

    /**
     * Install CodeMirror resources
     *
     * @param  string $path Project root path
     * @return $this
     */
    public function install($path)
    {
        // Set paths
        $codemirror = realpath(__DIR__ . '/../../../') . '/resources/codemirror';
        $js = $path . 'public/js/codemirror';
        $css = $path . 'public/css/codemirror';

        // Install bootstrap
        if (!is_dir($js)) {
            mkdir($js . '/lib', 0777, true);
            mkdir($js . '/addon/edit', 0777, true);
            mkdir($js . '/addon/selection', 0777, true);
            mkdir($js . '/mode/php', 0777, true);
            mkdir($js . '/mode/css', 0777);
            mkdir($js . '/mode/clike', 0777);
            mkdir($js . '/mode/xml', 0777);
            mkdir($js . '/mode/htmlmixed', 0777);
            touch($js . '/index.html');
            touch($js . '/lib/index.html');
            touch($js . '/addon/index.html');
            touch($js . '/addon/edit/index.html');
            touch($js . '/addon/selection/index.html');
            touch($js . '/mode/index.html');

            $libs = array('codemirror', 'codephalcon');
            $addons = array('edit/matchbrackets', 'selection/active-line');
            $modes = array('php', 'css', 'clike', 'xml', 'htmlmixed');

            foreach ($libs as $lib) {
                copy($codemirror . '/lib/' . $lib . '.js', $js . '/lib/' . $lib . '.js');
            }

            foreach ($modes as $mode) {
                copy($codemirror . '/mode/' . $mode . '/' . $mode . '.js', $js . '/mode/' . $mode . '/' . $mode . '.js');

                if (!file_exists($js . '/mode/' . $mode . '/index.html')) {
                    touch($js . '/mode/' . $mode . '/index.html');
                }
            }

            foreach ($addons as $addon) {
                copy($codemirror . '/addon/' . $addon . '.js', $js . '/addon/' . $addon . '.js');
            }
        }

        if (!file_exists($css)) {
            mkdir($css, 0777, true);
            touch($css . '/index.html');
            copy($codemirror . '/lib/codemirror.css', $css . '/codemirror.css');
            copy($codemirror . '/lib/codephalcon.css', $css . '/codephalcon.css');
            copy($codemirror . '/theme/ambiance.css', $css . '/ambiance.css');
        }

        return $this;
    }

    /**
     * Uninstall CodeMirror resources
     *
     * @param  string $path Project root path
     * @return $this
     */
    public function uninstall($path)
    {
        $js  = $path . 'public/js';
        $css = $path . 'public/css';

        $installed = array(
            // Files:
            $js . '/codemirror/addon/edit/matchbrackets.js',
            $js . '/codemirror/addon/edit/index.html',
            $js . '/codemirror/addon/selection/index.html',
            $js . '/codemirror/addon/selection/active-line.js',
            $js . '/codemirror/addon/index.html',
            $js . '/codemirror/lib/codemirror.js',
            $js . '/codemirror/lib/codephalcon.js',
            $js . '/codemirror/lib/index.html',
            $js . '/codemirror/mode/clike/clike.js',
            $js . '/codemirror/mode/clike/index.html',
            $js . '/codemirror/mode/css/css.js',
            $js . '/codemirror/mode/css/index.html',
            $js . '/codemirror/mode/php/php.js',
            $js . '/codemirror/mode/php/index.html',
            $js . '/codemirror/mode/htmlmixed/htmlmixed.js',
            $js . '/codemirror/mode/htmlmixed/index.html',
            $js . '/codemirror/mode/xml/xml.js',
            $js . '/codemirror/mode/xml/index.html',
            $js . '/codemirror/mode/index.html',
            $js . '/codemirror/index.html',
            $css . '/codemirror/ambiance.css',
            $css . '/codemirror/codemirror.css',
            $css . '/codemirror/codephalcon.css',
            $css . '/codemirror/index.html',

            // Sub-directories:
            $js . '/codemirror/mode/clike',
            $js . '/codemirror/mode/css',
            $js . '/codemirror/mode/php',
            $js . '/codemirror/mode/xml',
            $js . '/codemirror/mode/htmlmixed',
            $js . '/codemirror/mode',
            $js . '/codemirror/lib',
            $js . '/codemirror/addon/edit',
            $js . '/codemirror/addon/selection',
            $js . '/codemirror/addon',
            $js . '/codemirror',
            $css . '/codemirror',

            // Directories:
            $js,
            $css
        );

        foreach ($installed as $file) {
            if (is_file($file)) {
                unlink($file);
            } elseif (is_dir($file)) {
                // Check if other files were not added
                if (count(glob($file . '/*')) === 0) {
                    rmdir($file);
                }
            }
        }

        return $this;
    }
}
