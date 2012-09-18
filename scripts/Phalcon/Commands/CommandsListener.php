<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Framework                                                      |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2012 Phalcon Team (http://www.phalconphp.com)       |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file docs/LICENSE.txt.                        |
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

use Phalcon\Script;
use Phalcon\Script\Color;
use Phalcon\Events\Event;

/**
 * Phalcon\Commands\CommandListener
 *
 * Listens for events in commands
 */
class CommandsListener
{

	public function beforeCommand(Event $event, Command $command)
	{

		if ($command->canBeExternal() == false) {
			$path = $command->getOption('directory');
			if (!file_exists($path . '.phalcon')) {
				throw new CommandsException("This command should be invoked inside a Phalcon project directory");
			}
		}

		$parameters = $command->parseParameters();
		if (count($parameters) < 2 || $command->isReceivedOption('help') || $command->getOption(1) == 'help') {
			$command->getHelp();
			return false;
		}
	}

}