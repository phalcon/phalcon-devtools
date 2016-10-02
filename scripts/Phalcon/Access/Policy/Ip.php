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

namespace Phalcon\Access\Policy;

use Phalcon\Di\Injectable;
use Phalcon\Access\PolicyInterface;

/**
 * \Phalcon\Access\Policy\Ip
 *
 * @package Phalcon\Access\Policy
 */
class Ip extends Injectable implements PolicyInterface
{
    /**
     * The allowed IP address.
     * @var string
     */
    protected $allowedIp;

    /**
     * Ip constructor.
     *
     * @param string $ip The allowed IP address.
     */
    public function __construct($ip)
    {
        $this->allowedIp = trim($ip);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $resourceName Resource name.
     * @param array  $data         Data. [Optional]
     * @return bool
     */
    public function isAllowedAccess($resourceName, array $data = null)
    {
        $ip = $this->request->getClientAddress();

        if ($ip && ($ip == '127.0.0.1' || $ip == '::1' || $this->checkIp($ip))) {
            return true;
        }

        return false;
    }

    /**
     * Check if IP address for securing Phalcon Developers Tools area matches
     * the given
     *
     * @param  string $ip
     * @return bool
     */
    private function checkIp($ip)
    {
        return 0 === strpos($ip, $this->allowedIp);
    }
}
