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

namespace Phalcon\DevTools\Elements;

use Phalcon\Di\Injectable;

/**
 * \Phalcon\Elements\Element
 *
 * @property \Phalcon\Tag $tag
 * @package Phalcon\Elements
 */
class Element extends Injectable
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
            $text = strtr(':icon:text', [
                ':icon' => '<i class="'.$link['icon'].'"></i> ',
                ':text' => $text
            ]);
        }

        if (isset($link['caret']) && is_string($link['caret'])) {
            $text = strtr(':text:icon', [
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
