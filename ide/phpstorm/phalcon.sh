#!/bin/bash

#
#  +------------------------------------------------------------------------+
#  | Phalcon Framework                                                      |
#  +------------------------------------------------------------------------+
#  | Copyright (c) 2011-2015 Phalcon Team (https://www.phalconphp.com)      |
#  +------------------------------------------------------------------------+
#  | This source file is subject to the New BSD License that is bundled     |
#  | with this package in the file LICENSE.txt.                             |
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
	elif [ -e $HOME/.zshrc ]; then
		. $HOME/.zshrc
	elif [ -e $HOME/.config/fish/config.fish ]; then
		. $HOME/.config/fish/config.fish
	fi
}

if [ -z "$PTOOLSPATH" ]; then
	run_profile
fi

if [ ! -z "$PTOOLSPATH" ]; then
	php "$PTOOLSPATH/phalcon.php" $*
else
	if [ -n "$ZSH_VERSION" ]; then
		echo "Error: Add environment variable PTOOLSPATH to your $HOME/.zsh"
	elif [ -n "$BASH_VERSION" ]; then
		echo "Error: Add environment variable PTOOLSPATH to your $HOME/.profile"
	elif [ -n "$FISH_VERSION" ]; then
		echo "Error: Add environment variable PTOOLSPATH, to your $HOME/.config/fish/config.fish"
	else
		echo "Error: Add environment variable PTOOLSPATH, unknown shell type"
	fi
fi
