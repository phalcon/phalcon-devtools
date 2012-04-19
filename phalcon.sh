#!/bin/bash

if [ -z "$PTOOLSPATH" ]; then                           ## check that we haven't installed yet
        if [ "$0" == "-bash" -o "$0" == "bash" ]; then                          ## bash check (linux/osx)
                echo "Phalcon Developer Tools Installer"
                echo "Make sure phalcon.sh is in the same dir as phalcon.php and that you are running this with sudo or as root."
                echo "Installing Devtools..."
                DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
                export PTOOLSPATH=$DIR
                export PATH=$PATH:$DIR
                        if [ -e $HOME/.profile ]; then ## make sure phalcon is available on every possible shell, see http://stefaanlippens.net/bashrc_and_o$
                                VAR1="export PTOOLSPATH=$DIR"
                                VAR2="export PATH=$PATH:$DIR"
                                echo "$VAR1" >> $HOME/.profile
                                echo "$VAR2" >> $HOME/.profile
                        elif [ -e $HOME/.bash_profile ]; then
                                VAR1="export PTOOLSPATH=$DIR"
                                VAR2="export PATH=$PATH:$DIR"
                                echo "$VAR1" >> $HOME/.bash_profile
                                echo "$VAR2" >> $HOME/.bash_profile
                        elif [ -e $HOME/.bashrc ]; then
                                VAR1="export PTOOLSPATH=$DIR"
                                VAR2="export PATH=$PATH:$DIR"
                                echo "$VAR1" >> $HOME/.bashrc
                                echo "$VAR2" >> $HOME/.bashrc
                        else
                                echo "No bash profile detected. Env vars might dissapear at console restart!"
                        fi
                        echo "Working dir is: "$DIR
        else
                echo 'Run this installer with ". ./phalcon.sh". Exiting...'
                return
        fi
fi

app="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
if [ ! -L $app/phalcon ]; then
        echo "Generating symlink..."
        ln -s $app/phalcon.sh $app/phalcon
        chmod +x $app/phalcon
        echo "Done. Devtools installed!"
else
        php "$PTOOLSPATH/phalcon.php" $*
fi

