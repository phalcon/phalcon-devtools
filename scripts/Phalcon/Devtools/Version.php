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

namespace Phalcon\Devtools;

use Phalcon\Version as PhVersion;

/**
 * \Phalcon\Devtools\Version
 *
 * This class allows to get the installed version of the Developer Tools
 *
 * @package Phalcon\Devtools
 */
class Version extends PhVersion
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    protected static function _getVersion(): array
    {
        return [4, 0, 0, 1, 4];
    }
}
