<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (http://www.phalconphp.com)       |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file docs/LICENSE.txt.                        |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Serghei Iakovlev <serghei@phalconphp.com>                     |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Web;

/**
 * Installer Interface
 *
 * @package Phalcon\Web
 */
interface InstallerInterface
{
    /**
     * Install resources
     *
     * @param  string $path Project root path
     * @return $this
     */
    public function install($path);

    /**
     * Uninstall resources
     *
     * @param  string $path Project root path
     * @return $this
     */
    public function uninstall($path);
}
