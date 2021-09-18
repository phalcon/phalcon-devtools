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

namespace Phalcon\DevTools\Generator\Helper;

use Roave\BetterReflection\Reflection\ReflectionClassConstant;
use Roave\BetterReflection\Reflection\ReflectionConstant;
use Roave\BetterReflection\Reflection\ReflectionMethod;
use Roave\BetterReflection\Reflection\ReflectionParameter;
use Roave\BetterReflection\Reflection\ReflectionProperty;

class ReflectionHelper
{
    public static function parseComments(?string $docBlock = null): ?array
    {
        if (null === $docBlock) {
            return null;
        }
        $filteredDocBlock = str_replace(["/**\n", "\n */", " *"], ['', '', ""], $docBlock);

        return array_map('trim', explode("\n", $filteredDocBlock));
    }

    public static function getTypeReference(?ReflectionParameter $type = null): ?MethodArgumentDto
    {
        if (null === $type) {
            return null;
        }

        return new MethodArgumentDto(
            $type->getName(),
            null !== $type->getType() ? (string)$type->getType() : null,
            $type->allowsNull(),
            $type->isDefaultValueAvailable() ? $type->getDefaultValue() : MethodArgumentDto::NO_VALUE,
            $type->isPassedByReference()
        );
    }

    public static function cleanFQCN(array $imports, string $code): string
    {
        $imports = array_reverse($imports);
        foreach ($imports as $import) {
            [$className, $alias] = $import;
            if (false !== strpos($code, $className)) {
                $code = str_replace($className, $alias, $code);
            }
        }

        return $code;
    }

    /**
     * @param ReflectionMethod|ReflectionConstant|ReflectionProperty|ReflectionClassConstant $handler
     *
     * @return string
     */
    public static function getAccessMode($handler): string
    {
        if ($handler->isProtected()) {
            return 'protected';
        }
        if ($handler->isPublic()) {
            return 'public';
        }

        return 'private';
    }

    /**
     * @param ReflectionMethod|ReflectionConstant|ReflectionProperty|ReflectionClassConstant $handler
     * @param string $fullClassName
     *
     * @return bool
     */
    public static function isInClass($handler, string $fullClassName): bool
    {
        return $handler->getDeclaringClass()->getName() !== $fullClassName;
    }
}
