#!/bin/bash

if [ -z "$PTOOLSPATH" ]; then
	export PTOOLSPATH=.
fi
php "$PTOOLSPATH/phalcon.php" $*
