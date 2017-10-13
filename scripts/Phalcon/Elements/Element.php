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

namespace Phalcon\Elements;

use Phalcon\Mvc\User\Component;

/**
 * \Phalcon\Elements\Element
 *
 * @property \Phalcon\Tag $tag
 * @package Phalcon\Elements
 */
class Element extends Component
{
    /**
     * Builds a HTML A tag using framework conventions
     *
     * @param array $link
     *
     * @return string
     */
    public function createLink(array $link)
    {
        $local = $this->isLocalLink($link);
        $text  = isset($link['text']) ? $link['text'] : '';

        if (isset($link['wrap']) && is_string($link['wrap'])) {
            $text = strtr('<:open>:text</:close>', [
                ':open'  => $link['wrap'],
                ':close' => $link['wrap'],
                ':text'  => $text
            ]);
        }

        if (isset($link['icon']) && is_string($link['icon'])) {
            $text = strtr(':icon:text' ,[
                ':icon' => '<i class="'.$link['icon'].'"></i> ',
                ':text' => $text
            ]);
        }

        if (isset($link['caret']) && is_string($link['caret'])) {
            $text = strtr(':text:icon' ,[
                ':icon' => ' <i class="'.$link['caret'].'"></i>',
                ':text' => $text
            ]);
        }

        $href = isset($link['href']) ? $link['href'] : '';
        unset($link['text'], $link['local'], $link['wrap'], $link['icon'], $link['caret'], $link['href']);

        return $this->tag->linkTo([$href, $text] + $link + ['local' => $local]);
    }

    public function isLocalLink(array $link)
    {
        return isset($link['local']) ? boolval($link['local']) : true;
    }
}
