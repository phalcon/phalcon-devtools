<?php

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Phalcon\Access\Policy;

use Phalcon\Di\Injectable;
use Phalcon\Access\PolicyInterface;

/**
 * \Phalcon\Access\Policy\Ip
 *
 * @property \Phalcon\Http\Request|\Phalcon\Http\RequestInterface $request
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
