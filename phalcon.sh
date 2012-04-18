#!/bin/bash

if [ -z "$PTOOLSPATH" ]; then
        if [ "$0" == "-bash" ];
        then
        echo "Phalcon devtools install. PhalconPHP 2012. Make sure phalcon.sh is in the same dir as phalcon.php and that you run this with sudo or as root."
        echo "Installing Devtools..."
        DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
        export PTOOLSPATH=$DIR
        export PATH=$PATH:$DIR
        echo "Working dir is: "$DIR
        else
        echo 'Run this installer with ". ./phalcon.sh". Exiting...'
        exit
        fi
fi
app="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
if [ ! -L $app/phalcon ]; then
        echo "Generating symlink"
        ln -s $app/phalcon.sh $app/phalcon
        chmod +x $app/phalcon
        echo "Done. Devtools installed!"
else
php "$PTOOLSPATH/phalcon.php" $*
fi

