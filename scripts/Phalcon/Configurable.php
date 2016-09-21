<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (http://www.phalconphp.com)       |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file docs/LICENSE.txt.                        |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  |          Serghei Iakovlev <serghei@phalconphp.com>                     |
  +------------------------------------------------------------------------+
*/

namespace Phalcon;

use Phalcon\Exception\InvalidArgumentException;
use Phalcon\Exception\ReadOnlyParameterException;

/**
 * \Phalcon\Configurable
 *
 * @package Phalcon
 */
trait Configurable
{
    /**
     * Sets the params by using passed config.
     *
     * @param array|\Traversable $parameters
     * @return $this
     * @throws InvalidArgumentException|ReadOnlyParameterException
     */
    public function setParameters($parameters)
    {
        if (!is_array($parameters) && !($parameters instanceof \Traversable)) {
            throw new InvalidArgumentException('Parameters must be either an array or Traversable.');
        }

        foreach ($this->configurable as $param) {
            if (!isset($parameters[$param])) {
                continue;
            }

            $method = 'set' . Text::camelize($param);

            if (method_exists($this, $method)) {
                $this->$method($parameters[$param]);
            } else {
                throw new ReadOnlyParameterException(
                    sprintf('Setting readonly property: %s::$%s', get_class($this), $param)
                );
            }
        }

        return $this;
    }

    /**
     * Sets the params by using defined constants.
     *
     * @return $this
     */
    public function initFromConstants()
    {
        foreach ($this->defines as $const => $property) {
            if (defined($const) && property_exists($this, $property)) {
                $this->{$property} = rtrim(trim(constant($const)), '\\/');
            }
        }

        return $this;
    }
}
