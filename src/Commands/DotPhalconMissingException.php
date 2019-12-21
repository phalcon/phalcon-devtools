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

namespace Phalcon\DevTools\Commands;

use Phalcon\DevTools\Script\Color;

/**
 * .phalcon is missing Exception
 *
 *  This is thrown when a CLI command is run without a .phalcon file
 *  In the CWD
 */
class DotPhalconMissingException extends CommandsException implements ISelfHealingException
{
    const DEFAULT_MESSAGE = "This command must be run inside a Phalcon project with a .phalcon directory.";
    const RESOLUTION_PROMPT = "Shall I create the .phalcon directory now? (y/n)";

    public function __construct($message = self::DEFAULT_MESSAGE, $code = 0)
    {
        $this->message = $message;
        $this->code = $code;

        parent::__construct();
    }

    public function scanPathMessage(): string
    {
        return 'One was not found at ' . getcwd();
    }

    public function promptResolution(): bool
    {
        fwrite(STDOUT, Color::info(self::RESOLUTION_PROMPT));
        $handle = fopen("php://stdin", "r");
        $line = fgets($handle);
        if (trim(mb_strtolower($line)) != 'y') {
            echo "ABORTING!\n";
            return false;
        }

        fclose($handle);
        echo "\n";
        echo "Retrying command...\n";
        $this->resolve();

        return true;
    }

    public function resolve(): bool
    {
        return mkdir(getcwd() . '/.phalcon');
    }
}
