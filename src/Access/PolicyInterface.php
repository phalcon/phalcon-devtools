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

namespace Phalcon\DevTools\Access;

interface PolicyInterface
{
    /**
     * Checks whether a user is allowed to access an resource.
     *
     * @param string $resourceName Resource name.
     * @param array $data Data. [Optional]
     * @return bool
     */
    public function isAllowedAccess(string $resourceName, array $data = null): bool;
}
