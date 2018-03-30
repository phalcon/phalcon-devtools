<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-present Phalcon Team (https://www.phalconphp.com)   |
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
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Version;

/**
 * Item Class
 *
 * Allows to manipulate version texts
 *
 * @package   Phalcon\Version
 * @copyright Copyright (c) 2011-2016 Phalcon Team (team@phalconphp.com)
 * @license   New BSD License
 */
class IncrementalItem implements ItemInterface
{
    use VersionAwareTrait;

    /**
     * @var string
     */
    private $version;

    /**
     * @var int | string
     */
    private $versionStamp = 0;

    /**
     * @var array
     */
    private $parts = [];

    /**
     * @param string $version
     * @param int    $numberParts
     */
    public function __construct($version, $numberParts = 3)
    {
        $version = trim($version);
        $this->parts = explode('.', $version);
        $nParts = count($this->parts);

        if ($nParts < $numberParts) {
            for ($i = $numberParts; $i >= $nParts; $i--) {
                $this->parts[] = '0';
                $version.='.0';
            }
        } elseif ($nParts > $numberParts) {
            for ($i = $nParts; $i <= $numberParts; $i++) {
                if (isset($this->parts[$i-1])) {
                    unset($this->parts[$i-1]);
                }
            }

            $version = join('.', $this->parts);
        }

        $this->version = $version;

        $this->regenerateVersionStamp();
    }

    /**
     * @param ItemInterface[] $versions
     *
     * @return array ItemInterface[]
     */
    public static function sortAsc($versions)
    {
        $sortData = [];
        foreach ($versions as $version) {
            $sortData[$version->getStamp()] = $version;
        }
        ksort($sortData);

        return array_values($sortData);
    }

    /**
     * @param ItemInterface[] $versions
     *
     * @return array
     */
    public static function sortDesc($versions)
    {
        $sortData = [];
        foreach ($versions as $version) {
            $sortData[$version->getStamp()] = $version;
        }
        krsort($sortData);

        return array_values($sortData);
    }

    /**
     * @param ItemInterface[] $versions
     *
     * @return null | IncrementalItem
     */
    public static function maximum($versions)
    {
        if (count($versions) == 0) {
            return null;
        }

        $versions = self::sortDesc($versions);

        return $versions[0];
    }

    /**
     * Allows to check whether a version is in a range between two values.
     *
     * @param  IncrementalItem | string $initialVersion
     * @param  IncrementalItem | string $finalVersion
     * @param  ItemInterface[] $versions
     * @return ItemInterface[]
     */
    public static function between($initialVersion, $finalVersion, $versions)
    {
        $versions = self::sortAsc($versions);

        if (!is_object($initialVersion)) {
            $initialVersion = new self($initialVersion);
        }

        if (!is_object($finalVersion)) {
            $finalVersion = new self($finalVersion);
        }

        $betweenVersions = [];
        if ($initialVersion->getStamp() == $finalVersion->getStamp()) {
            return $betweenVersions; // nothing to do
        }

        if ($initialVersion->getStamp() < $finalVersion->getStamp()) {
            $versions = self::sortAsc($versions);
        } else {
            $versions = self::sortDesc($versions);
            list($initialVersion, $finalVersion) = [$finalVersion, $initialVersion];
        }

        foreach ($versions as $version) {
            /** @var ItemInterface $version */
            if (($version->getStamp() >= $initialVersion->getStamp())
                && ($version->getStamp() <= $finalVersion->getStamp())) {
                $betweenVersions[] = $version;
            }
        }

        return $betweenVersions ;
    }

    /**
     * @return int | string
     */
    public function getStamp()
    {
        return $this->versionStamp;
    }

    /**
     * @param int $number
     *
     * @return IncrementalItem
     */
    public function addMinor($number)
    {
        $parts = array_reverse($this->parts);
        if (isset($parts[0])) {
            if (is_numeric($parts[0])) {
                $parts[0] += $number;
            } else {
                $parts[0] = ord($parts[0]) + $number;
            }
        }

        $parts = array_reverse($parts);

        $this->setParts($parts)
            ->regenerateVersionStamp();

        $this->version = join('.', $parts);

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->version;
    }

    public function getVersion()
    {
        return $this->version;
    }

    protected function regenerateVersionStamp()
    {
        $n = 2;
        $versionStamp = 0;

        foreach ($this->parts as $part) {
            if (is_numeric($part)) {
                $versionStamp += $part * pow(10, $n);
            } else {
                $versionStamp += ord($part) * pow(10, $n);
            }

            $n -= 1;
        }

        $this->versionStamp = $versionStamp;

        return $this;
    }

    protected function setParts(array $parts)
    {
        $this->parts = array_map(function ($v) {
            return strval($v);
        }, $parts);

        return $this;
    }
}
