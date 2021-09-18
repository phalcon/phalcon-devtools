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

namespace Phalcon\DevTools\Generator\Signature;

use Closure;
use Nette\PhpGenerator\Property;
use Roave\BetterReflection\Reflection\ReflectionFunction;

class PropertyGenerator
{
    public const NO_VALUE = '#no_value_property#';
    private $property;
    private $handler;

    public function __construct(Property $property, $handler)
    {
        $this->property = $property;
        $this->handler = $handler;
    }

    public function addComments(array $comments): void
    {
        foreach ($comments as $comment) {
            $this->property->addComment($comment);
        }
    }

    public function setAccessMode(string $accessMode): void
    {
        if ($accessMode === 'private') {
            $this->property->setPrivate();
        } elseif ($accessMode === 'protected') {
            $this->property->setProtected();
        } else {
            $this->property->setPublic();
        }
    }

    public function setNullable(bool $isNullable = false): void
    {
        if ($isNullable) {
            $this->property->setNullable();
        }
    }

    public function setStatic(bool $isStatic = false): void
    {
        if ($isStatic) {
            $this->property->setStatic();
        }
    }

    public function setType(?string $type = null): void
    {
        if (null !== $type) {
            if (false !== strpos($type, '\\')) {
                $this->handler->addUse($type);
            }
            $this->property->setType($type);
        }
    }

    public function setValue($value): void
    {
        if ($value instanceof Closure || is_callable($value)) {
            $value = ReflectionFunction::createFromClosure($value)->getBodyCode();
        }

        $this->property->setValue($value);
    }
}
