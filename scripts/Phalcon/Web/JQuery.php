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
  | Authors: Serghei Iakovlev <sadhooklay@gmail.com>                       |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Web;

/**
 * CodeMirror Installer
 *
 * This class installs code-mirror in the app
 *
 * @package     Phalcon\Web
 * @copyright   Copyright (c) 2011-2015 Phalcon Team (team@phalconphp.com)
 * @license     New BSD License
 */
class JQuery implements InstallerInterface
{
    /**
     * Install JQuery resources
     *
     * @param  string $path Project root path
     * @return $this
     */
    public function install($path)
    {
        // Set paths
        $jqueryRoot  = realpath(__DIR__ . '/../../../') . '/resources/jquery';
        $jsJqueryDir = $path . 'public/js/jquery';

        if (!is_dir($jsJqueryDir)) {
            mkdir($jsJqueryDir, 0777, true);
            touch($jsJqueryDir . '/index.html');
            copy($jqueryRoot . '/jquery-2.1.4.min.js', $jsJqueryDir . '/jquery-2.1.4.min.js');
            copy($jqueryRoot . '/jquery-2.1.4.min.map', $jsJqueryDir . '/jquery-2.1.4.min.map');
        }

        return $this;
    }

    /**
     * Uninstall JQuery resources
     *
     * @param  string $path Project root path
     * @return $this
     */
    public function uninstall($path)
    {
        $js  = $path . 'public/js';

        $installed = array(
            // Files:
            $js . '/jquery/jquery-2.1.4.min.map',
            $js . '/jquery/jquery-2.1.4.min.js',
            $js . '/jquery/index.html',

            // Sub-directories:
            $js . '/jquery',

            // Directories:
            $js,
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
