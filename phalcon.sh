#!/usr/bin/env bash
#
#
#  +------------------------------------------------------------------------+
#  | Phalcon Developer Tools                                                |
#  +------------------------------------------------------------------------+
#  | Copyright (c) 2011-2017 Phalcon Team (https://phalconphp.com)          |
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
IS_BASH=0
SOURCE_FILE=

init(){
	source=`echo $0 | grep "bash"`

	if [ "$source" == "bash" ]; then
		DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
		IS_BASH=1
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
		SOURCE_FILE=$HOME/.bash_profile

		source ${SOURCE_FILE}
	elif [ -e $HOME/.bashrc ]; then
		echo "$PTOOLSVAR" >> $HOME/.bashrc
		echo "$PATHVAR" >> $HOME/.bashrc
		SOURCE_FILE=$HOME/.bashrc

		source ${SOURCE_FILE}
	elif [ -e $HOME/.profile ]; then
		echo "$PTOOLSVAR" >> $HOME/.profile
		echo "$PATHVAR" >> $HOME/.profile
		SOURCE_FILE=$HOME/.profile

		source ${SOURCE_FILE}
	elif [ -e $HOME/.zshrc ]; then
		echo "$PTOOLSVAR" >> $HOME/.zshrc
		echo "$PATHVAR" >> $HOME/.zshrc
		SOURCE_FILE=$HOME/.bashrc

		source ${SOURCE_FILE}
	elif [ -e $HOME/.cshrc ]; then
		echo "setenv PTOOLSPATH ${DIR}/" >> $HOME/.cshrc
		echo "setenv PATH \${PATH}:$DIR" >> $HOME/.cshrc
		SOURCE_FILE=$HOME/.cshrc

		source ${SOURCE_FILE}
	else
		printf "\n${PURPLE}No bash profile detected. Environment vars might disappear on console restart!${NC}\n"
		return 0
	fi
}

check_bash(){
	if [ "$IS_BASH" == 0 ] && [ ! -z "$SOURCE_FILE" ]; then
		printf "\nTo start using Phalcon Developer Tools you need to run 'source ${SOURCE_FILE}'"
		printf "\n"
	fi

	printf "\n"
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

		devtools="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

		if [ -f ${devtools}/phalcon ]; then
			printf "\nFailed to create symbolic link ${devtools}/phalcon: File exists"
			printf "\nExit.\n\n"
			return 1
		fi

		alter_profile

		if [ ! -L ${devtools}/phalcon ]; then
			printf "\nGenerating symlink..."
			ln -s ${devtools}/phalcon.sh ${devtools}/phalcon
			chmod +x ${devtools}/phalcon
			printf "\n\nDone. Phalcon Developer Tools installed!"
			printf "\nThank you for using Phalcon Developer Tools!"
			printf "\nWe hope that Phalcon Developer Tools helps to make your life easier."
			printf "\n"
			printf "\nIn case of problems: "
			printf "${YELLOW}https://github.com/phalcon/phalcon-devtools/issues${NC} "
			printf "\n                and: ${YELLOW}https://forum.phalconphp.com${NC}"
			printf "\n"

			check_bash

			return 0
		fi
		return 1
	else
		devtools=${PTOOLSPATH%/}
		if [ "${devtools}" != "${DIR}" ]; then
			printf "\n${PURPLE}Your environment variable \$PTOOLSPATH is outdated!${NC}"
			printf "\n${PURPLE}Current value: $devtools${NC}"
			printf "\n${PURPLE}New value: $DIR${NC}"
			printf "\nExit.\n\n"
			return 1
		fi
	fi
	return 0
}

init

if check_install; then
	devtools=${PTOOLSPATH%/}
	php "$devtools/phalcon.php" $*
fi
