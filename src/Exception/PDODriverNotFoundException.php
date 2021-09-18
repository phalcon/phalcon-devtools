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

namespace Phalcon\DevTools\Exception;

use PDOException;
use Phalcon\Devtools\Script\Color;
use PDO;

class PDODriverNotFoundException extends PDOException
{
    protected $adapter = '';

    public function __construct($message, $adapter = '')
    {
        parent::__construct($message);
        $this->adapter = $adapter;
    }

    public function getAdapter()
    {
        return $this->adapter;
    }

    public function writeNicelyFormattedErrorOutput()
    {
        fwrite(STDERR, Color::error($this->getMessage()) . PHP_EOL);

        if (!extension_loaded('PDO')) {
            fwrite(STDERR, Color::error('PDO extension is not loaded') . PHP_EOL);
        } else {
            $loadedDrivers = PDO::getAvailableDrivers();
            fwrite(STDERR, 'PDO Drivers loaded:' . PHP_EOL);
            fwrite(STDERR, print_r($loadedDrivers, true). PHP_EOL);
        }
    }
}
