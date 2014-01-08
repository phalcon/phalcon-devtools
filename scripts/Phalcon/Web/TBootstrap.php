<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
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

/**
 * Phalcon\Web\TBootstrap
 *
 * Install/Uninstall Twitter Bootstrap resources
 */
class TBootstrap
{
    /**
     * Install Twitter Bootstrap resources
     *
     * @param  string $path
     * @return void
     */
    public static function install($path)
    {
        // Set paths
        $bootstrapRoot = realpath(__DIR__ . '/../../../') . '/resources/bootstrap';
        $jqueryRoot    = realpath(__DIR__ . '/../../../') . '/resources/jquery';

        $jsBootstrapDir = $path . 'public/js/bootstrap';
        $jsJqueryDir    = $path . 'public/js/jquery';

        $css = $path . 'public/css/bootstrap';
        $img = $path . 'public/img/bootstrap';

        // Install bootstrap
        if ( ! is_dir($jsBootstrapDir) ) {
            mkdir($jsBootstrapDir , 0777 , true);
            touch($jsBootstrapDir . '/index.html');
            copy($bootstrapRoot . '/js/bootstrap.min.js' , $jsBootstrapDir . '/bootstrap.min.js');
        }

        if ( ! is_dir($css) ) {
            mkdir($css , 0777 , true);
            touch($css . '/index.html');
            copy($bootstrapRoot . '/css/bootstrap.min.css' , $css . '/bootstrap.min.css');
            copy($bootstrapRoot . '/css/bootstrap-responsive.min.css' , $css . '/bootstrap-responsive.min.css');
        }

        if ( ! is_dir($img) ) {
            mkdir($img , 0777 , true);
            touch($img . '/index.html');
            copy($bootstrapRoot . '/img/glyphicons-halflings.png' , $img . '/glyphicons-halflings.png');
        }

        // Install jQuery
        if ( ! is_dir($jsJqueryDir) ) {
            mkdir($jsJqueryDir , 0777 , true);
            touch($jsJqueryDir . '/index.html');
            copy($jqueryRoot . '/jquery.min.js' , $jsJqueryDir . '/jquery.min.js');
        }
    }

    /**
     * Remove Twitter Bootstrap resources
     *
     * @param  string $path
     * @return void
     */
    public static function uninstall($path)
    {
        $js  = $path . 'public/js';
        $css = $path . 'public/css';
        $img = $path . 'public/img';

        $installed = array(

            // Files:
            $js . '/bootstrap/bootstrap.min.js',
            $js . '/bootstrap/index.html',
            $js . '/jquery/jquery.min.js',
            $js . '/jquery/index.html',
            $css . '/bootstrap/bootstrap.min.css',
            $css . '/bootstrap/bootstrap-responsive.min.css',
            $css . '/bootstrap/index.html',
            $img . '/bootstrap/glyphicons-halflings.png',
            $img . '/bootstrap/index.html',

            // Sub-directories:
            $js . '/bootstrap',
            $js . '/jquery',
            $css . '/bootstrap',
            $img . '/bootstrap',

            // Directories:
            $js,
            $css,
            $img
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
    }
}
