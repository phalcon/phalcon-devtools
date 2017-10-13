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
  |          Serghei Iakovlev <serghei@phalconphp.com>                     |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Utils;

use Phalcon\Devtools\Version;
use Phalcon\Mvc\User\Component;
use Phalcon\Version as PhVersion;

/**
 * \Phalcon\Utils\SystemInfo
 *
 * @property \Phalcon\Registry $registry
 * @property \Phalcon\Mvc\Url|\Phalcon\Mvc\UrlInterface $url
 *
 * @package Phalcon\Utils
 */
class SystemInfo extends Component
{
    public function get()
    {
        return $this->getVersions() + $this->getUris() + $this->getDirectories() + $this->getEnvironment();
    }

    public function getDirectories()
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

    public function getUris()
    {
        return [
            'Base URI' => $this->url->getBaseUri(),
            'WebTools URI' => rtrim('/', $this->url->getBaseUri()) . '/webtools.php',
        ];
    }

    public function getVersions()
    {
        return [
            'Phalcon DevTools Version' => Version::get(),
            'Phalcon Version' => PhVersion::get(),
            'AdminLTE Version' => ADMIN_LTE_VERSION,
        ];
    }

    public function getEnvironment()
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
