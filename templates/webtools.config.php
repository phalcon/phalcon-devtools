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
  +------------------------------------------------------------------------+
*/

/**
 * @const PTOOLS_IP Allowed IP for access.
 *        Phalcon Developers Tools can only be used in local machine, however
 *        you can set this to allow certain IP address.
 *
 *        For example:
 *          192.168.0.1 or SUBNET 192., 10.0.2., 86.84.124.
 */
defined('PTOOLS_IP') || define('PTOOLS_IP', '192.168.');

// ---------------------------- DO NOT EDIT BELOW ------------------------------

/**
 * @const PTOOLSPATH The path to the Phalcon Developers Tools.
 */
defined('PTOOLSPATH') || define('PTOOLSPATH', '@@PATH@@');
