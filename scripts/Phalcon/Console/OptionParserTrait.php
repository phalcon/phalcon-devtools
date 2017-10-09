<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2017 Phalcon Team (https://www.phalconphp.com)      |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Sergii Svyrydenko <sergey.v.svyrydenko@gmail.com>             |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Console;

use Phalcon\Version\IncrementalItem as IncrementalVersion;
use Phalcon\Version\ItemCollection as VersionCollection;
use Phalcon\Mvc\Model\Migration as ModelMigration;
use InvalidArgumentException;

/**
 * \Phalcon\Utils\OptionParserTrait
 *
 * Parsing CLI options
 *
 * @package   Phalcon\Utils
 * @copyright Copyright (c) 2011-2017 Phalcon Team (team@phalconphp.com)
 * @license   New BSD License
 */
trait OptionParserTrait
{
    /**
     * Get prefix from the option
     *
     * @param  string  $prefix
     * @param  mixed  $prefixEnd
     *
     * @return mixed
     */
    public function getPrefixOption($prefix, $prefixEnd = '*')
    {
        if (substr($prefix, -1) != $prefixEnd) {
            return '';
        }

        return substr($prefix, 0, -1);
    }

    /**
     * Get version name to generate migration
     *
     * @return IncrementalVersion
     */
    public function getVersionNameGeneratingMigration()
    {
        if (empty($this->options)) {
            throw new InvalidArgumentException('Options were not defined yet');
        }

        // Use timestamped version if description is provided
        if ($this->options['descr']) {
            $this->options['version'] = (string)(int)(microtime(true) * pow(10, 6));
            VersionCollection::setType(VersionCollection::TYPE_TIMESTAMPED);
            $versionItem = VersionCollection::createItem($this->options['version'] . '_' . $this->options['descr']);

            // Elsewhere use old-style incremental versioning
            // The version is specified
        } elseif ($this->options['version']) {
            VersionCollection::setType(VersionCollection::TYPE_INCREMENTAL);
            $versionItem = VersionCollection::createItem($this->options['version']);

            // The version is guessed automatically
        } else {
            VersionCollection::setType(VersionCollection::TYPE_INCREMENTAL);
            $versionItems = ModelMigration::scanForVersions($this->options['migrationsDir']);

            if (!isset($versionItems[0])) {
                $versionItem = VersionCollection::createItem('1.0.0');

            } else {
                /** @var IncrementalVersion $versionItem */
                $versionItem = VersionCollection::maximum($versionItems);
                $versionItem = $versionItem->addMinor(1);
            }
        }

        return $versionItem;
    }
}
