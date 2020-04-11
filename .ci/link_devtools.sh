#!/usr/bin/env bash
#
# This file is part of the Phalcon Framework.
#
# (c) Phalcon Team <team@phalcon.io>
#
# For the full copyright and license information, please view the
# LICENSE.txt file that was distributed with this source code.

mkdir "$GITHUB_WORKSPACE"/bin
ln -s "$GITHUB_WORKSPACE"/phalcon "$GITHUB_WORKSPACE"/bin/phalcon
echo "::add-path::$GITHUB_WORKSPACE/bin"
chmod +x "$GITHUB_WORKSPACE"/phalcon
