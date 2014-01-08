#!/bin/bash

#
#  +------------------------------------------------------------------------+
#  | Phalcon Framework                                                      |
#  +------------------------------------------------------------------------+
#  | Copyright (c) 2011-2014 Phalcon Team (http://www.phalconphp.com)       |
#  +------------------------------------------------------------------------+
#  | This source file is subject to the New BSD License that is bundled     |
#  | with this package in the file docs/LICENSE.txt.                        |
#  |                                                                        |
#  | If you did not receive a copy of the license and are unable to         |
#  | obtain it through the world-wide-web, please send an email             |
#  | to license@phalconphp.com so we can send you a copy immediately.       |
#  +------------------------------------------------------------------------+
#  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
#  |          Eduar Carvajal <eduar@phalconphp.com>                         |
#  +------------------------------------------------------------------------+
#

run_profile(){
	if [ -e $HOME/.bash_profile ]; then
		. $HOME/.bash_profile
	elif [ -e $HOME/.profile ]; then
		. $HOME/.profile
	elif [ -e $HOME/.bashrc ]; then
		. $HOME/.bashrc
	elif [ -e $HOME/.zshrc]; then
		. $HOME/.zshrc
	fi
}

if [ -z "$PTOOLSPATH" ]; then
	run_profile
fi

if [ ! -z "$PTOOLSPATH" ]; then
	php "$PTOOLSPATH/phalcon.php" $*
else
	echo "Error: Add environment variable PTOOLSPATH to your .profile"
fi
