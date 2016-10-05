#!/usr/bin/env bash
#
#
#  +------------------------------------------------------------------------+
#  | Phalcon Developer Tools                                                |
#  +------------------------------------------------------------------------+
#  | Copyright (c) 2011-2016 Phalcon Team (https://www.phalconphp.com)      |
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
#  |          Jakob <@jamurko>                                              |
#  +------------------------------------------------------------------------+
#

PURPLE="\033[0;35m"
GREEN="\033[0;32m"
YELLOW="\033[1;33m"
NC="\033[0m"
DIR=

init(){
	source=`echo $0 | grep "bash"`

	if [ "$source" == "bash" ]; then
		DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
	else
		DIR=$( cd -P -- "$( dirname -- "$0" )" && pwd -P )
	fi

	DIR=${DIR%/}
}

alter_profile(){
	export PTOOLSPATH="$DIR/"
	export PATH="$PATH:$DIR"

	PTOOLSVAR="export PTOOLSPATH=${DIR}/"
	PATHVAR="export PATH=\$PATH:$DIR"

	if [ -e $HOME/.bash_profile ]; then
		echo "$PTOOLSVAR" >> $HOME/.bash_profile
		echo "$PATHVAR" >> $HOME/.bash_profile
		source $HOME/.bash_profile
	elif [ -e $HOME/.bashrc ]; then
		echo "$PTOOLSVAR" >> $HOME/.bashrc
		echo "$PATHVAR" >> $HOME/.bashrc
		source $HOME/.bashrc
	elif [ -e $HOME/.profile ]; then
		echo "$PTOOLSVAR" >> $HOME/.profile
		echo "$PATHVAR" >> $HOME/.profile
		source $HOME/.profile
	elif [ -e $HOME/.zshrc ]; then
		echo "$PTOOLSVAR" >> $HOME/.zshrc
		echo "$PATHVAR" >> $HOME/.zshrc
		source $HOME/.bashrc
	elif [ -e $HOME/.cshrc ]; then
		echo "setenv PTOOLSPATH ${DIR}/" >> $HOME/.cshrc
		echo "setenv PATH \${PATH}:$DIR" >> $HOME/.cshrc
		source $HOME/.cshrc
	else
		printf "\n${PURPLE}No bash profile detected. Environment vars might disappear on console restart!${NC}\n"
		return 0
	fi
}

check_install(){
	if [ -z "$PTOOLSPATH" ]; then
		printf "\n${YELLOW}Phalcon Developer Tools Installer${NC}"
		printf "\n"
		printf "\n${PURPLE}Make sure phalcon.sh is in the same dir as phalcon.php${NC}"
		printf "\n${PURPLE}and that you are running this with sudo or as root.${NC}"
		printf "\n"
		printf "\nInstalling Devtools..."
		printf "\nWorking dir is: ${DIR}"

		alter_profile
		devtools="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

		if [ -f ${devtools}/phalcon ]; then
			printf "\nFailed to create symbolic link ${devtools}/phalcon: File exists"
			printf "\nExit.\n\n"
			return 0
		fi

		if [ ! -L ${devtools}/phalcon ]; then
			printf "\nGenerating symlink..."
			ln -s ${devtools}/phalcon.sh ${devtools}/phalcon
			chmod +x ${devtools}/phalcon
			printf "\nDone. Devtools installed!"
			printf "\n\n"
		fi
		return 1
	else
		PTOOLSPATH=${PTOOLSPATH%/}
		if [ "${PTOOLSPATH}" != "${DIR}" ]; then
			printf "\n${PURPLE}The You environment variable \$PTOOLSPATH is outdated!${NC}"
			printf "\n${PURPLE}Current value: $PTOOLSPATH${NC}"
			printf "\n${PURPLE}New value: $DIR${NC}"
			printf "\nExit.\n\n"
			return 0
		fi
	fi
	return 0
}

init

if check_install; then
	PTOOLSPATH=${PTOOLSPATH%/}
	php "$PTOOLSPATH/phalcon.php" $*
fi
