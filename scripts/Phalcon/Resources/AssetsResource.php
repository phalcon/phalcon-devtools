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

namespace Phalcon\Resources;

use Phalcon\Mvc\User\Component;

/**
 * \Phalcon\Resources\AssetsResource
 *
 * @property \Phalcon\Utils\FsUtils $fs
 *
 * @package Phalcon\Resources
 */
class AssetsResource extends Component
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
