#!/usr/bin/env bash
#
# This file is part of the Phalcon Framework.
#
# (c) Phalcon Team <team@phalcon.io>
#
# For the full copyright and license information, please view the
# LICENSE.txt file that was distributed with this source code.

set -e

: "${BOX_VERSION:=3.8.3}"

wget "https://github.com/humbug/box/releases/download/${BOX_VERSION}/box.phar" \
    --quiet \
    -O "${HOME}/bin/box"

chmod +x "${HOME}/bin/box"
box --version
