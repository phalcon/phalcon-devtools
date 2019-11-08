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

namespace Phalcon\DevTools\Providers;

use Phalcon\DevTools\Exception\ProviderException;

abstract class AbstractProvider
{
    /**
     * @return string
     * @throws ProviderException
     */
    public function getProviderName(): string
    {
        if (!property_exists($this, 'providerName')) {
            throw new ProviderException('Provider must contain $providerName property.');
        }

        return $this->providerName;
    }
}
