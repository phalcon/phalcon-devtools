<?php
declare(strict_types=1);

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Phalcon\DevTools\Web;

use Exception;
use Phalcon\DevTools\Utils\FsUtils;
use SplFileInfo;

/**
 * Allows to use Phalcon Developer Tools with a web interface.
 */
class Tools
{
    /**
     * Install webtools
     *
     * @param string $path
     * @return bool
     */
    public static function install($path): bool
    {
        $fsUtils = new FsUtils();
        $path = $fsUtils->normalize(realpath($path)) . DS;

        $root = new SplFileInfo($path . 'public' . DS);
        $fsUtils->setDirectoryPermission($root, ['js' => 0777, 'css' => 0777]);

        $tools = rtrim(str_replace(["\\", '/'], DS, PTOOLSPATH), DS);

        copy($tools . DS . 'webtools.php', $path . 'public' . DS . 'webtools.php');

        if (!file_exists($configPath = $path . 'public' . DS . 'webtools.config.php')) {
            $template = file_get_contents(TEMPLATE_PATH . DS . 'webtools.config.php');
            $code = str_replace('@@PATH@@', $tools, $template);

            file_put_contents($configPath, $code);
        }

        return true;
    }

    /**
     * Uninstall webtools
     *
     * @param string $path
     * @return bool
     *
     * @throws Exception
     */
    public static function uninstall($path): bool
    {
        $fsUtils = new FsUtils();
        $path = $fsUtils->normalize(realpath($path)) . DS;

        $root = new SplFileInfo($path . 'public' . DS);
        $fsUtils->deleteFilesFromDirectory($root, [
            'css' . DS . 'webtools.css',
            'js' . DS . 'webtools.js',
            'js' . DS . 'webtools-ie.js',
            'webtools.config.php',
            'webtools.php'
        ]);

        return true;
    }
}
