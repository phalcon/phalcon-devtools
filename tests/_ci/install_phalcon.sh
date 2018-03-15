#!/bin/sh

# Ensure that this is being run inside a CI container
if [ "${CI}" != "true" ]; then
    echo "This script is designed to run inside a CI container only. Exiting"
    exit 1
fi

PHALCON_VERSION=${PHALCON_VERSION:-master}
PHP_MAJOR=`$(phpenv which php-config) --version | cut -d '.' -f 1,2`

LOCAL_SRC_DIR=${HOME}/src/phalcon/${PHALCON_VERSION}
LOCAL_LIB_DIR=${HOME}/.local/lib
LOCAL_LIBRARY=${LOCAL_LIB_DIR}/phalcon-${PHALCON_VERSION}-${PHP_MAJOR}.so

PHALCON_INI_FILE=$(phpenv root)/versions/$(phpenv version-name)/etc/conf.d/50-phalcon.ini

EXTENSION_DIR=`$(phpenv which php-config) --extension-dir`

if [ ! -f ${LOCAL_LIBRARY} ]; then
    mkdir -p ${LOCAL_SRC_DIR}
    mkdir -p ${LOCAL_LIB_DIR}
    git clone --depth=1 -v https://github.com/phalcon/cphalcon.git -b ${PHALCON_VERSION} ${LOCAL_SRC_DIR}

    cd ${LOCAL_SRC_DIR}/build

    ./install --phpize $(phpenv which phpize) --php-config $(phpenv which php-config)

    if [ ! -f "${EXTENSION_DIR}/phalcon.so" ]; then
        echo "Unable to locate installed phalcon.so"
        exit 1
    fi

    cp "${EXTENSION_DIR}/phalcon.so" ${LOCAL_LIBRARY}
fi

echo "[Phalcon]" > ${PHALCON_INI_FILE}
echo "extension=${LOCAL_LIBRARY}" >> ${PHALCON_INI_FILE}

php --ri phalcon || exit 1
