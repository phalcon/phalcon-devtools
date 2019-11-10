#!/bin/sh
#
# This file is part of the Phalcon Framework.
#
# (c) Phalcon Team <team@phalcon.io>
#
# For the full copyright and license information, please view the
# LICENSE.txt file that was distributed with this source code.

set -eu

if [ "$(command -v box 2>/dev/null || true)" = "" ]; then
  (>&2 printf "To use this script you need to install humbug/box: %s \\n" \
    "https://github.com/humbug/box")
  (>&2 echo "Aborting.")
  exit 1
fi

box validate
box compile

if [ ! -f "./phalcon.phar" ] || [ ! -x "./phalcon.phar" ]; then
  (>&2 echo "Something went wrong when building zephir.phar")
  (>&2 echo "Aborting.")
  exit 1
fi
