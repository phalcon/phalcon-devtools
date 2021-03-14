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

namespace Phalcon\DevTools\Utils;

use Phalcon\DevTools\Version;
use Phalcon\Di\Injectable;
use Phalcon\Registry;
use Phalcon\Url;
use Phalcon\Url\UrlInterface;
use Phalcon\Version as PhVersion;

/**
 * @property Registry $registry
 * @property Url|UrlInterface $url
 */
class SystemInfo extends Injectable
{
    public function get(): array
    {
        return $this->getVersions() + $this->getUris() + $this->getDirectories() + $this->getEnvironment();
    }

    public function getDirectories(): array
    {
        return [
            'DevTools Path' => $this->registry->offsetGet('directories')->ptoolsPath,
            'Templates Path' => $this->registry->offsetGet('directories')->templatesPath,
            'Application Path' => $this->registry->offsetGet('directories')->basePath,
            'Controllers Path' => $this->registry->offsetGet('directories')->controllersDir,
            'Models Path' => $this->registry->offsetGet('directories')->modelsDir,
            'Migrations Path' => $this->registry->offsetGet('directories')->migrationsDir,
            'WebTools Views' => $this->registry->offsetGet('directories')->webToolsViews,
            'WebTools Resources' => $this->registry->offsetGet('directories')->resourcesDir,
            'WebTools Elements' => $this->registry->offsetGet('directories')->elementsDir,
        ];
    }

    public function getUris(): array
    {
        return [
            'Base URI' => $this->url->getBaseUri(),
            'WebTools URI' => rtrim('/', $this->url->getBaseUri()) . '/webtools.php',
        ];
    }

    public function getVersions(): array
    {
        return [
            'Phalcon DevTools Version' => Version::get(),
            'Phalcon Version' => PhVersion::get(),
            'AdminLTE Version' => '3.0.1',
        ];
    }

    public function getEnvironment(): array
    {
        return [
            'OS' => php_uname(),
            'PHP Version' => PHP_VERSION,
            'PHP SAPI' => php_sapi_name(),
            'PHP Bin' => PHP_BINARY,
            'PHP Extension Dir' => PHP_EXTENSION_DIR,
            'PHP Bin Dir' => PHP_BINDIR,
            'Loaded PHP config' => php_ini_loaded_file(),
        ];
    }
}
