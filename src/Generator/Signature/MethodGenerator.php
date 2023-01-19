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
use Nette\PhpGenerator\Method;
use Phalcon\DevTools\Generator\Helper\MethodArgumentDto;
use Roave\BetterReflection\Reflection\ReflectionFunction;

class MethodGenerator
{
    private $method;
    private $handler;

    public function __construct(Method $method, $handler)
    {
        $this->method = $method;
        $this->handler = $handler;
    }

    public function addComments(array $comments): self
    {
        foreach ($comments as $comment) {
            $this->method->addComment($comment);
        }

        return $this;
    }

    public function addArguments(array $arguments): self
    {
        foreach ($arguments as $argument) {
            if (\is_string($argument)) {
                $this->method->addParameter($argument);
            } elseif ($argument instanceof MethodArgumentDto) {
                $parameter = $this->method->addParameter($argument->getName());
                if (null !== $argument->getType()) {
                    if (false !== strpos($argument->getType(), '\\')) {
                        $this->handler->addUse($argument->getType());
                    }
                    $parameter->setType($argument->getType());
                }
                if ($argument->isNullable()) {
                    $parameter->setNullable();
                }
                if ($argument->isRef()) {
                    $parameter->setReference();
                }
                if (MethodArgumentDto::NO_VALUE !== $argument->getDefault()) {
                    $parameter->setDefaultValue($argument->getDefault());
                }
            }
        }

        return $this;
    }

    public function setAccessMode(string $accessMode): self
    {
        if ($accessMode === 'private') {
            $this->method->setPrivate();
        } elseif ($accessMode === 'protected') {
            $this->method->setProtected();
        } else {
            $this->method->setPublic();
        }

        return $this;
    }

    public function setReturnType(?string $returnType = null, bool $returnTypeNullable = false): self
    {
        if (null !== $returnType) {
            $this->method->setReturnType($returnType);
            if ($returnTypeNullable) {
                $this->method->setReturnNullable();
            }
        }

        return $this;
    }

    public function setFinal(bool $isFinal = true): self
    {
        if ($isFinal) {
            $this->method->setFinal();
        }

        return $this;
    }

    public function setStatic(bool $isStatic = true): self
    {
        if ($isStatic) {
            $this->method->setStatic();
        }

        return $this;
    }

    public function setBody($body): self
    {
        if ($body instanceof Closure || is_callable($body)) {
            $body = ReflectionFunction::createFromClosure($body)->getBodyCode();
        } else {
            $body = (string)$body;
        }

        $this->method->setBody($body);

        return $this;
    }
}
