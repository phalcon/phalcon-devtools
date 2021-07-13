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

namespace Phalcon\DevTools;

/**
 * This class allows to get the installed version of the Developer Tools
 */
class Version
{

    /**
     * @return array
     */
    // phpcs:disable
    protected static function getVersion(): array
    {
        return [4, 2, 0, 0, 0];
    }
    // phpcs:enable

    public static function get(): string
    {
        list($major,$medium,$minor,$special,$specialNumber) = self::getVersion();

        $result  = $major . '.' . $medium . '.' . $minor;
        $suffix  = self::getSpecial($special);

        if ($suffix !== '') {
            /**
             * A pre-release version should be denoted by appending alpha/beta or RC and
             * a patch version.
             * examples 5.0.0alpha2, 5.0.0beta1, 5.0.0RC3
             */
            $result .= $suffix;

            if ($specialNumber !== 0) {
                $result .= $specialNumber;
            }
        }

        return $result;
    }

    /**
     * Translates a number to a special release.
     * @param int $special
     * @return string
     */
    protected static function getSpecial(int $special): string
    {
        switch($special) {
            case 1:
                $suffix = 'alpha';
                break;
            case 2:
                $suffix = 'beta';
                break;
            case 3:
                $suffix = 'RC';
                break;
            default:
                $suffix = '';
        }
        return $suffix;
    }

}
