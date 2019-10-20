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

namespace Phalcon\Resources;

use Phalcon\Di\Injectable;
use Phalcon\Utils\FsUtils;

/**
 * \Phalcon\Resources\AssetsResource
 *
 * @property FsUtils $fs
 *
 * @package Phalcon\Resources
 */
class AssetsResource extends Injectable
{
    /**
     * Returns assets resource path.
     *
     * @param string $path
     * @return string
     */
    public function path(string $path): string
    {
        return PTOOLSPATH . DS . 'resources' . DS . $this->fs->normalize($path);
    }
}
