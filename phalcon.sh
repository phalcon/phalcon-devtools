#!/usr/bin/env bash

#
#  +------------------------------------------------------------------------+
#  | Phalcon Developer Tools                                                |
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
#  |          Jakob <@jamurko>                                              |
#  +------------------------------------------------------------------------+
#

alter_profile(){
	DIR="$1"
	export PTOOLSPATH="$DIR/"
	export PATH="$PATH:$DIR"
	PTOOLSVAR="export PTOOLSPATH=$DIR/"
	PATHVAR="export PATH=\$PATH:$DIR"
	if [ -e $HOME/.bash_profile ]; then
		echo "$PTOOLSVAR" >> $HOME/.bash_profile
		echo "$PATHVAR" >> $HOME/.bash_profile
		source $HOME/.bash_profile
	elif [ -e $HOME/.profile ]; then
		echo "$PTOOLSVAR" >> $HOME/.profile
		echo "$PATHVAR" >> $HOME/.profile
		source $HOME/.profile
	elif [ -e $HOME/.bashrc ]; then
		echo "$PTOOLSVAR" >> $HOME/.bashrc
		echo "$PATHVAR" >> $HOME/.bashrc
		source $HOME/.bashrc
	else
		echo "No bash profile detected. Environment vars might disappear on console restart!"
	fi

	if [ -e $HOME/.cshrc ]; then
		echo "setenv PTOOLSPATH ${DIR}/" >> $HOME/.cshrc
		echo "setenv PATH \${PATH}:$DIR" >> $HOME/.cshrc
	fi
}

check_install(){
	if [ -z "$PTOOLSPATH" ]; then
		if [ `echo $0 | grep "bash"`=="bash" ]; then ## bash check (linux/osx)
			echo "Phalcon Developer Tools Installer"
			echo "Make sure phalcon.sh is in the same dir as phalcon.php and that you are running this with sudo or as root."
			echo "Installing Devtools..."
			DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
			alter_profile $DIR
			echo "Working dir is: $DIR"
		else
			echo 'Phalcon Developer Tools need to be installed...'
			echo 'Run this installer with ". ./phalcon.sh". Exiting...'
			return 1
		fi
		app="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
		if [ ! -L $app/phalcon ]; then
			echo "Generating symlink..."
			ln -s $app/phalcon.sh $app/phalcon
			chmod +x $app/phalcon
			echo "Done. Devtools installed!"
		fi
		return 1
	fi
	return 0
}

if check_install; then
	php "$PTOOLSPATH/phalcon.php" $*
fi
