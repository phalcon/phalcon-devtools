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

/**
 * Bootstrap Installer
 *
 * Install/Uninstall Twitter Bootstrap resources
 *
 * @package     Phalcon\Web
 * @copyright   Copyright (c) 2011-2015 Phalcon Team (team@phalconphp.com)
 * @license     New BSD License
 */
class Bootstrap implements InstallerInterface
{
    /**
     * Install Twitter Bootstrap resources
     *
     * @param  string $path Project root path
     * @return $this
     */
    public function install($path)
    {
        // Set paths
        $bootstrapRoot = realpath(__DIR__ . '/../../../') . '/resources/bootstrap';
        $js = $path . 'public/js/bootstrap';
        $css = $path . 'public/css/bootstrap';
        $fonts = $path . 'public/fonts/bootstrap';

        // Install bootstrap
        if (!is_dir($js)) {
            mkdir($js, 0777, true);
            touch($js . '/index.html');
            copy($bootstrapRoot . '/js/bootstrap.min.js', $js . '/bootstrap.min.js');
        }

        if (!is_dir($css)) {
            mkdir($css, 0777, true);
            touch($css . '/index.html');
            copy($bootstrapRoot . '/css/dashboard.css', $css . '/dashboard.css');
            copy($bootstrapRoot . '/css/bootstrap.min.css', $css . '/bootstrap.min.css');
        }

        if (!is_dir($fonts)) {
            mkdir($fonts, 0777, true);
            touch($fonts . '/index.html');
            copy($bootstrapRoot . '/fonts/glyphicons-halflings-regular.eot', $fonts . '/glyphicons-halflings-regular.eot');
            copy($bootstrapRoot . '/fonts/glyphicons-halflings-regular.svg', $fonts . '/glyphicons-halflings-regular.svg');
            copy($bootstrapRoot . '/fonts/glyphicons-halflings-regular.ttf', $fonts . '/glyphicons-halflings-regular.ttf');
            copy($bootstrapRoot . '/fonts/glyphicons-halflings-regular.woff', $fonts . '/glyphicons-halflings-regular.woff');
            copy($bootstrapRoot . '/fonts/glyphicons-halflings-regular.woff2', $fonts . '/glyphicons-halflings-regular.woff2');
        }

        return $this;
    }

    /**
     * Uninstall Twitter Bootstrap resources
     *
     * @param  string $path Project root path
     * @return $this
     */
    public function uninstall($path)
    {
        $js  = $path . 'public/js';
        $css = $path . 'public/css';
        $fonts = $path . 'public/fonts';

        $installed = array(

            // Files:
            $js . '/bootstrap/bootstrap.min.js',
            $js . '/bootstrap/index.html',
            $css . '/bootstrap/bootstrap.min.css',
            $css . '/bootstrap/dashboard.css',
            $css . '/bootstrap/index.html',
            $fonts . '/bootstrap/glyphicons-halflings-regular.eot',
            $fonts . '/bootstrap/glyphicons-halflings-regular.svg',
            $fonts . '/bootstrap/glyphicons-halflings-regular.ttf',
            $fonts . '/bootstrap/glyphicons-halflings-regular.woff',
            $fonts . '/bootstrap/glyphicons-halflings-regular.woff2',
            $fonts . '/bootstrap/index.html',

            // Sub-directories:
            $js . '/bootstrap',
            $css . '/bootstrap',
            $fonts . '/bootstrap',

            // Directories:
            $js,
            $css,
            $fonts
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
