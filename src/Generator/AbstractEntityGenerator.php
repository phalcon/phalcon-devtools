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

namespace Phalcon\DevTools\Generator;

use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\Printer;
use Nette\PhpGenerator\PsrPrinter;
use Phalcon\DevTools\Builder\Exception\BuilderException;
use Phalcon\DevTools\Generator\Helper\ReflectionHelper;
use Phalcon\DevTools\Generator\Signature\ConstantGenerator;
use Phalcon\DevTools\Generator\Signature\MethodGenerator;
use Phalcon\DevTools\Generator\Signature\PropertyGenerator;
use Roave\BetterReflection\Reflection\ReflectionClass;
use Roave\BetterReflection\Reflection\ReflectionClassConstant;
use Roave\BetterReflection\Reflection\ReflectionMethod;
use Roave\BetterReflection\Reflection\ReflectionProperty;
use SplFileObject;

abstract class AbstractEntityGenerator
{
    /**
     * @var PhpFile
     */
    protected $file;
    /**
     * @var PhpFile|PhpNamespace
     */
    protected $handler;
    /**
     * @var ClassType
     */
    protected $class;
    /**
     * @var MethodGenerator[]
     */
    protected $methods;
    /**
     * @var ConstantGenerator[]
     */
    protected $constants;
    /**
     * @var PropertyGenerator[]
     */
    protected $properties;

    public function __construct(string $className, ?string $baseClass = null, ?string $namespace = null)
    {
        $this->file = new PhpFile();
        if (null !== $namespace) {
            $this->handler = $this->file->addNamespace($namespace);
        } else {
            $this->handler = $this->file;
        }

        $this->class = $this->handler->addClass($className);
        if (null !== $baseClass) {
            $this->class->setExtends($baseClass);
            $this->handler->addUse($baseClass);
        }
    }

    public function printCode(Printer $printer): string
    {
        return $printer->printFile($this->file);
    }

    public function setStrict(bool $strict = true): self
    {
        $this->file->setStrictTypes($strict);

        return $this;
    }

    public function setClassAbstract(): self
    {
        $this->class->setAbstract();

        return $this;
    }

    public function addImplements(string $interface): void
    {
        $this->class->addImplement($interface);
        $this->handler->addUse($interface);
    }

    public function addComments(array $comments): void
    {
        foreach ($comments as $comment) {
            $this->handler->addComment($comment);
        }
    }

    public function addClassComments(array $comments): void
    {
        foreach ($comments as $comment) {
            $this->class->addComment($comment);
        }
    }

    public function hasImport(string $import): bool
    {
        $cleanImports = $this->getCleanImports();
        foreach ($cleanImports as $cleanImport) {
            if (in_array($import, $cleanImport, true)) {
                return true;
            }
        }

        return false;
    }

    public function getImports(): array
    {
        if ($this->handler instanceof PhpFile) {
            $imports = [];
            foreach ($this->handler->getNamespaces() as $item) {
                $imports[] = $item->getUses();
            }

            return array_merge(...$imports);
        }

        if ($this->handler instanceof PhpNamespace) {
            return $this->handler->getUses();
        }

        return [];
    }

    public function getCleanImports(): array
    {
        $cleanImports = [];
        $imports = $this->getImports();
        foreach ($imports as $alias => $import) {
            if (false !== strpos($alias, 'as')) {
                $importArr = explode(' as ', $import);
                $newAlias = explode(' as ', $alias)[0] ?? 0;
                $cleanImports[$newAlias] = [];
                if (isset($importArr[1])) {
                    $cleanImports[$newAlias][] = '\\'. $importArr[0];
                }
                if (isset($importArr[1])) {
                    $cleanImports[$newAlias][] = $importArr[1];
                }

            } else {
                $cleanImports[$alias] = ['\\'. $import, $alias];
            }
        }

        return $cleanImports;
    }

    public function addImport(string $class, ?string $alias = null): self
    {
        if (!$this->hasImport($class)) {
            if (null !== $alias) {
                $this->handler->addUse($class, $alias);
            } else {
                $this->handler->addUse($class);
            }
        }

        return $this;
    }

    public function addImports(array $imports): self
    {
        foreach ($imports as $import) {
            $this->addImport(...$import);
        }

        return $this;
    }

    public function hasConstant(string $name): bool
    {
        return isset($this->constants[$name]);
    }

    public function getConstant(string $name): ConstantGenerator
    {
        if (!isset($this->constants[$name])) {
            $this->addConstant($name);
        }

        return $this->constants[$name];
    }

    public function addConstant(
        string $name,
        $value = null,
        ?string $visibility = 'public',
        array $comments = []
    ): ConstantGenerator {
        $constant = new ConstantGenerator($this->class->addConstant($name, $value));
        $constant->setAccessMode($visibility);
        $constant->addComments($comments);

        $this->afterConstantCreation($name);

        return $constant;
    }

    public function addConstantFromReflection(ReflectionClassConstant $constant): ConstantGenerator
    {
        return $this->addConstant(
            $constant->getName(),
            $constant->getValue(),
            ReflectionHelper::getAccessMode($constant),
            ReflectionHelper::parseComments($constant->getDocComment())
        );
    }

    public function hasProperty(string $name): bool
    {
        return isset($this->constants[$name]);
    }

    public function getProperty(string $name): PropertyGenerator
    {
        if (!isset($this->properties[$name])) {
            $this->addProperty($name);
        }

        return $this->properties[$name];
    }

    public function addProperty(
        string $name,
        $value = PropertyGenerator::NO_VALUE,
        ?string $type = null,
        bool $isStatic = false,
        bool $isNullable = false,
        ?string $visibility = 'public',
        array $comments = []
    ): PropertyGenerator {
        $property = new PropertyGenerator($this->class->addProperty($name), $this->handler);
        $property->setAccessMode($visibility);
        $property->setType($type);
        $property->setStatic($isStatic);
        $property->setNullable($isNullable);
        $property->addComments($comments);

        if ($value !== PropertyGenerator::NO_VALUE) {
            $property->setValue($value);
        }

        $this->afterPropertyCreation($name);

        return $property;
    }

    public function addPropertyFromReflection(ReflectionProperty $property): PropertyGenerator
    {
        $propertyType = $property->getType();

        return $this->addProperty(
            $property->getName(),
            $property->getValue() ?? PropertyGenerator::NO_VALUE,
            null !== $propertyType ? (string)$propertyType : null,
            $property->isStatic(),
            $property->allowsNull(),
            ReflectionHelper::getAccessMode($property),
            ReflectionHelper::parseComments($property->getDocComment())
        );
    }

    public function hasMethod(string $name): bool
    {
        return isset($this->methods[$name]);
    }

    public function getMethod(string $name): MethodGenerator
    {
        if (!isset($this->methods[$name])) {
            $this->addMethod($name);
        }

        return $this->methods[$name];
    }

    public function addMethod(
        string $name,
        string $accessMode = 'public',
        ?string $returnType = null,
        bool $returnTypeNullable = false,
        bool $isFinal = false,
        bool $isStatic = false
    ): MethodGenerator {
        $method = new MethodGenerator($this->class->addMethod($name), $this->handler);
        $method->setAccessMode($accessMode);
        $method->setReturnType($returnType, $returnTypeNullable);
        $method->setFinal($isFinal);
        $method->setStatic($isStatic);

        $this->methods[$name] = $method;

        $this->afterMethodCreation($name);

        return $method;
    }

    public function addMethodFromReflection(ReflectionMethod $reflectionMethod): MethodGenerator
    {
        $name = $reflectionMethod->getName();
        $body = ReflectionHelper::cleanFQCN($this->getCleanImports(), $reflectionMethod->getBodyCode());
        $returnType = $reflectionMethod->getReturnType();
        $comments = ReflectionHelper::parseComments($reflectionMethod->getDocComment());

        $arguments = [];
        $parameters = $reflectionMethod->getParameters();
        foreach ($parameters as $parameter) {
            $arguments[] = ReflectionHelper::getTypeReference($parameter);
        }

        return $this->addMethod(
            $name,
            ReflectionHelper::getAccessMode($reflectionMethod),
            null !== $returnType ? (string)$returnType : null,
            null !== $returnType && $returnType->allowsNull(),
            $reflectionMethod->isFinal(),
            $reflectionMethod->isStatic()
        )->setBody($body)->addComments($comments)->addArguments($arguments);
    }

    public function createConstantsFromReflection(
        string $fullClassName,
        ?ReflectionClass $reflection = null
    ): void {
        if (null === $reflection) {
            $reflection = ReflectionClass::createFromName($fullClassName);
        }
        if (method_exists($reflection, 'getReflectionConstants')) {
            foreach ($reflection->getReflectionConstants() as $constant) {
                if (ReflectionHelper::isInClass($constant, $fullClassName)) {
                    continue;
                }

                $this->addConstantFromReflection($constant);
            }
        }
    }

    public function createPropertiesFromReflection(
        string $fullClassName,
        ?ReflectionClass $reflection = null,
        array $ignored = []
    ): void {
        if (null === $reflection) {
            $reflection = ReflectionClass::createFromName($fullClassName);
        }
        foreach ($reflection->getProperties() as $property) {
            $propertyName = $property->getName();
            if (!empty($ignored[$propertyName]) || ReflectionHelper::isInClass($property, $fullClassName)) {
                continue;
            }

            $this->addPropertyFromReflection($property);
        }
    }

    public function createMethodsFromReflection(
        string $fullClassName,
        ?ReflectionClass $reflection = null,
        array $ignored = []
    ): void {
        if (null === $reflection) {
            $reflection = ReflectionClass::createFromName($fullClassName);
        }
        foreach ($reflection->getMethods() as $method) {
            $methodName = $method->getName();
            if (isset($ignored[$methodName]) || ReflectionHelper::isInClass($method, $fullClassName)) {
                continue;
            }

            $this->addMethodFromReflection($method);
        }
    }

    public function addMethods(array $methods = []): void
    {
        foreach ($methods as $name => $params) {
            $method = $this->addMethod($name);
            if (isset($params['comments'])) {
                $method->addComments($params['comments']);
            }
            if (isset($params['arguments'])) {
                $method->addArguments($params['arguments']);
            }
            if (isset($params['body'])) {
                $method->setBody($params['body']);
            }
            if (isset($params['final'])) {
                $method->setFinal($params['final']);
            }
            if (isset($params['return'])) {
                $method->setReturnType(
                    $params['return']['type'] ?? null, $params['return']['nullable'] ?? false
                );
            }
            if (isset($params['static'])) {
                $method->setStatic($params['static']);
            }
            if (isset($params['accessMode'])) {
                $method->setAccessMode($params['accessMode']);
            }
        }
    }

    /**
     * @throws BuilderException
     */
    public function save(string $path, string $mode = 'wb+'): void
    {
        $code = $this->printCode(new PsrPrinter());
        $file = new SplFileObject($path, $mode);
        if (!$file->fwrite($code)) {
            throw new BuilderException(
                sprintf('Unable to write to %s. Check write-access of a file.', $file->getRealPath())
            );
        }
    }

    abstract public function afterMethodCreation(string $methodName): void;

    abstract public function afterPropertyCreation(string $propertyName): void;

    abstract public function afterConstantCreation(string $constantName): void;
}
