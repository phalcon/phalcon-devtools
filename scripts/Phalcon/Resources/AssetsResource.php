<?php

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

/**
 * \Phalcon\Resources\AssetsResource
 *
 * @property \Phalcon\Utils\FsUtils $fs
 *
 * @package Phalcon\Resources
 */
class AssetsResource extends Injectable
{
    /**
     * Returns assets resource path.
     *
     * @param string $path
     *
     * @return string
     */
    public function path($path)
    {
        return PTOOLSPATH . DS . 'resources' . DS . $this->fs->normalize($path);
    }
}
