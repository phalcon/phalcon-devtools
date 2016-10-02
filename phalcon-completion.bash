#!/usr/bin/env bash

#
#  +------------------------------------------------------------------------+
#  | Phalcon Developer Tools                                                |
#  +------------------------------------------------------------------------+
#  | Copyright (c) 2011-2016 Phalcon Team (https://www.phalconphp.com)      |
#  +------------------------------------------------------------------------+
#  | This source file is subject to the New BSD License that is bundled     |
#  | with this package in the file  LICENSE.txt.                            |
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

_phalcon()
{
	local cur prev
	_get_comp_words_by_ref -n = cur prev

	commands="commands list enumerate controller create-controller model \
	create-model all-models create-all-models project create-project scaffold \
	create-scaffold migration create-migration webtools create-webtools"

	case "$prev" in
		project|create-project)
			COMPREPLY=($(compgen -W "--name --webtools --directory --type --template-path --use-config-ini --trace --help --namespace" -- "$cur"))
			return 0
			;;
	esac

	COMPREPLY=($(compgen -W "$commands" -- "$cur"))

} &&
complete -F _phalcon phalcon
