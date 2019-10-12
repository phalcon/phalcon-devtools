#!/usr/bin/env bash
#
# This file is part of the Phalcon Framework.
#
# (c) Phalcon Team <team@phalcon.io>
#
# For the full copyright and license information, please view the
# LICENSE.txt file that was distributed with this source code.

set -e

: "${PHALCON_VERSION:=master}"

EXT_DIR="$(php-config --extension-dir)"
LOCAL_PATH="phalcon-$PHALCON_VERSION/php-$(php-config --vernum)/$TRAVIS_ARCH"

# Using cache only for tagged Phalcon versions
if [ "$PHALCON_VERSION" != "master" ] &&
   [ "$PHALCON_VERSION" != "4.0.x" ] &&
   [ -f "$HOME/assets/$LOCAL_PATH/phalcon.so" ]
then
  cp "$HOME/assets/$LOCAL_PATH/phalcon.so" "$EXT_DIR/phalcon.so"
else
  git clone --depth=1 -v https://github.com/phalcon/cphalcon.git -b "$PHALCON_VERSION" /tmp/phalcon
  cd /tmp/phalcon/build || extit 1
  ./install --phpize "$(phpenv which phpize)" --php-config "$(phpenv which php-config)" 1> /dev/null

  mkdir -p "$HOME/assets/$LOCAL_PATH"
  cp "$EXT_DIR/phalcon.so" "$HOME/assets/$LOCAL_PATH/phalcon.so"
fi

echo extension=phalcon.so >> "$(phpenv prefix)/etc/php.ini"

"$(phpenv which php)" -m | grep -q phalcon
