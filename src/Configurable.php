<?php
declare(strict_types=1);

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Phalcon\DevTools;

use Traversable;
use Phalcon\DevTools\Exception\InvalidArgumentException;

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
     * @param mixed $parameters
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
