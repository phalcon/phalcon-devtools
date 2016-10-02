<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (https://www.phalconphp.com)      |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
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

use Traversable;
use Phalcon\Exception\InvalidArgumentException;

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
     * @param array|Traversable $parameters
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setParameters($parameters)
    {
        if (!is_array($parameters) && !($parameters instanceof Traversable)) {
            throw new InvalidArgumentException('Parameters must be either an array or Traversable.');
        }

        foreach ($this->configurable as $param) {
            if (!isset($parameters[$param])) {
                continue;
            }

            $this->setParameter($param, $parameters[$param]);
        }

        return $this;
    }

    /**
     * Sets the parameter by using snake_case notation.
     *
     * @param string $parameter Parameter name
     * @param mixed $value The value
     * @return $this
     */
    public function setParameter($parameter, $value)
    {
        $method = 'set' . Text::camelize($parameter);

        if (method_exists($this, $method)) {
            $this->$method($value);
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
            if (defined($const) && in_array($property, $this->configurable)) {
                $this->setParameter($property, constant($const));
            }
        }

        return $this;
    }
}
