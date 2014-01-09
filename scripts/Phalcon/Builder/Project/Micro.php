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

namespace Phalcon\Builder\Project;

/**
 * Micro
 *
 * Builder to create micro application skeletons
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2014 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class Micro extends ProjectBuilder
{

    private $_dirs = array(
        'config',
        'models',
        'views',
        'public',
        'public/img',
        'public/css',
        'public/temp',
        'public/files',
        'public/js',
        '.phalcon'
    );

    /**
     * Create .htaccess files by default of application
     *
     */
    private function createHtaccessFiles($path, $templatePath)
    {

        if (file_exists($path . '.htaccess') == false) {
            $code = '<IfModule mod_rewrite.c>'.PHP_EOL.
                "\t".'RewriteEngine on'.PHP_EOL.
                "\t".'RewriteRule  ^$ public/    [L]'.PHP_EOL.
                "\t".'RewriteRule  (.*) public/$1 [L]'.PHP_EOL.
                '</IfModule>';
            file_put_contents($path.'.htaccess', $code);
        }

        if (file_exists($path . 'public/.htaccess') == false) {
            file_put_contents($path.'public/.htaccess', file_get_contents($templatePath . '/project/micro/htaccess'));
        }

        if (file_exists($path.'index.html') == false) {
            $code = '<html><body><h1>Mod-Rewrite is not enabled</h1><p>Please enable rewrite module on your web server to continue</body></html>';
            file_put_contents($path.'index.html', $code);
        }

    }

    /**
     * Create view files by default
     *
     */
    private function createIndexViewFiles($path, $templatePath)
    {

        $file = $path.'views/index.phtml';
        if (!file_exists($file)) {
            $str = file_get_contents($templatePath . '/project/micro/views/index.phtml');
            file_put_contents($file, $str);
        }

        $file = $path.'views/404.phtml';
        if (!file_exists($file)) {
            $str = file_get_contents($templatePath . '/project/micro/views/404.phtml');
            file_put_contents($file, $str);
        }
    }

    /**
     * Creates the configuration
     *
     * @param $path
     * @param $templatePath
     * @param $name
     * @param $type
     */
    private function createConfig($path, $templatePath, $name, $type)
    {
        if (file_exists($path . 'config/config.' . $type) == false) {
            $str = file_get_contents($templatePath . '/project/micro/config.' . $type);
            $str = preg_replace('/@@name@@/', $name, $str);
            file_put_contents($path . 'config/config.' . $type, $str);
        }

        if (file_exists($path . 'config/services.php') == false) {
            $str = file_get_contents($templatePath . '/project/micro/services.php');
            file_put_contents($path . 'config/services.php', $str);
        }

        if (file_exists($path . 'config/loader.php') == false) {
            $str = file_get_contents($templatePath . '/project/micro/loader.php');
            file_put_contents($path . 'config/loader.php', $str);
        }

        if (file_exists($path . 'app.php') == false) {
            $str = file_get_contents($templatePath . '/project/micro/app.php');
            file_put_contents($path . 'app.php', $str);
        }
    }

    /**
     * Create Bootstrap file by default of application
     *
     * @param $path
     * @param $templatePath
     * @param $useIniConfig
     */
    private function createBootstrapFile($path, $templatePath, $useIniConfig)
    {
        if (file_exists($path . 'public/index.php') == false) {

            $config = '$config = include __DIR__ . "/../config/config.php";';
            if ($useIniConfig) {
                $config = '$config = new \Phalcon\Config\Adapter\Ini(__DIR__ . "/../config/config.ini");';
            }

            $str = file_get_contents($templatePath . '/project/micro/index.php');
            $str = preg_replace('/@@config@@/', $config, $str);
            file_put_contents($path . 'public/index.php', $str);
        }
    }

    /**
     * Build project
     *
     * @param $name
     * @param $path
     * @param $templatePath
     * @param $options
     *
     * @return bool
     */
    public function build($name, $path, $templatePath, $options)
    {

        $this->buildDirectories($this->_dirs,$path);

        if (isset($options['useConfigIni'])) {
            $useIniConfig = $options['useConfigIni'];
        } else {
            $useIniConfig = false;
        }

        if ($useIniConfig) {
            $this->createConfig($path, $templatePath, $name, 'ini');
        } else {
            $this->createConfig($path, $templatePath, $name, 'php');
        }

        $this->createBootstrapFile($path, $templatePath, $useIniConfig);
        $this->createHtaccessFiles($path, $templatePath);
        $this->createIndexViewFiles($path, $templatePath);

        return true;
    }

}
