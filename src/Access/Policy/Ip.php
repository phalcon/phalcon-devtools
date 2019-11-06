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

namespace Phalcon\DevTools\Access\Policy;

use Phalcon\DevTools\Access\PolicyInterface;
use Phalcon\Di\Injectable;
use Phalcon\Http\RequestInterface;

/**
 * @property RequestInterface $request
 */
class Ip extends Injectable implements PolicyInterface
{
    /**
     * The allowed IP address.
     *
     * @var string
     */
    protected $allowedIp;

    /**
     * Ip constructor.
     *
     * @param string $ip The allowed IP address.
     */
    public function __construct(string $ip)
    {
        $this->allowedIp = trim($ip);
    }

    /**
     * {@inheritdoc}
     *
     * @param string $resourceName Resource name.
     * @param array $data Data. [Optional]
     * @return bool
     */
    public function isAllowedAccess(string $resourceName, array $data = null): bool
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
     * @param string $ip
     * @return bool
     */
    protected function checkIp(string $ip): bool
    {
        return 0 === strpos($ip, $this->allowedIp);
    }
}
