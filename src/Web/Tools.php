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
    const WEB_TOOLS_FILE = 'webtools.php';
    const WEB_TOOLS_CONFIG_FILE = 'webtools.config.php';
    const PROJECT_PUBLIC_FOLDER = 'public';

    /**
     * Install Web Tools
     *
     * @param string $path
     * @return void
     */
    public static function install(string $path): void
    {
        $fsUtils = new FsUtils();
        $path = $fsUtils->normalize(realpath($path)) . DS;
        $publicPath = $path . self::PROJECT_PUBLIC_FOLDER . DS;

        $root = new SplFileInfo($publicPath);
        $fsUtils->setDirectoryPermission($root, ['js' => 0777, 'css' => 0777]);

        $tools = rtrim(str_replace(["\\", '/'], DS, PTOOLSPATH), DS);

        copy($tools . DS . self::WEB_TOOLS_FILE, $publicPath . self::WEB_TOOLS_FILE);

        if (!file_exists($configPath = $publicPath . self::WEB_TOOLS_CONFIG_FILE)) {
            $template = file_get_contents(TEMPLATE_PATH . DS . self::WEB_TOOLS_CONFIG_FILE);
            $code = str_replace('@@PATH@@', $tools, $template);

            file_put_contents($configPath, $code);
        }
    }

    /**
     * Uninstall Web Tools
     *
     * @param string $path
     * @return void
     * @throws Exception
     */
    public static function uninstall($path): void
    {
        $fsUtils = new FsUtils();
        $path = $fsUtils->normalize(realpath($path)) . DS;

        $root = new SplFileInfo($path . self::PROJECT_PUBLIC_FOLDER . DS);
        $fsUtils->deleteFilesFromDirectory($root, [
            'css' . DS . 'webtools.css',
            'js' . DS . 'webtools.js',
            'js' . DS . 'webtools-ie.js',
            self::WEB_TOOLS_CONFIG_FILE,
            self::WEB_TOOLS_FILE,
        ]);
    }
}
