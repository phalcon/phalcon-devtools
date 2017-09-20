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
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Commands;

use Phalcon\Events\Event;

/**
 * Commands Listener
 *
 * @package Phalcon\Commands
 */
class CommandsListener
{
    /**
     * Before command executing
     *
     * @param Event   $event
     * @param Command $command
     *
     * @return bool
     * @throws DotPhalconMissingException
     */
    public function beforeCommand(Event $event, Command $command)
    {
        $parameters = $command->parseParameters([], ['h' => 'help']);

        if (
            count($parameters) < ($command->getRequiredParams() + 1) ||
            $command->isReceivedOption(['help', 'h', '?']) ||
            in_array($command->getOption(1), ['help', 'h', '?'])
        ) {
            $command->getHelp();

            return false;
        }

        if ($command->canBeExternal() == false) {
            $path = $command->getOption('directory');
            if ($path) $path = realpath($path) . DIRECTORY_SEPARATOR;
            if (!file_exists($path.'.phalcon') || !is_dir($path.'.phalcon')) {
                throw new DotPhalconMissingException();
            }
        }

        return true;
    }
}
