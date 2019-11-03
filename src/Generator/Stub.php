<?php

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Phalcon\DevTools\Generator;

use Exception;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use ReflectionException;
use ReflectionExtension;
use ReflectionMethod;
use ReflectionParameter;

class Stub
{
    /**
     * @var ReflectionExtension
     */
    protected $extension;

    /**
     * @var string
     */
    protected $targetDir;

    /**
     * @param string $extension
     * @param string $targetDir
     *
     * @throws ReflectionException
     */
    public function __construct($extension, $targetDir)
    {
        if (!extension_loaded($extension)) {
            throw new Exception("Extension '{$extension}' was not loaded");
        }

        $this->extension = new ReflectionExtension($extension);
        $this->targetDir = rtrim($targetDir, DIRECTORY_SEPARATOR);

        if (is_dir($this->targetDir . DIRECTORY_SEPARATOR . $this->extension->getVersion())) {
            $this->cleanup($this->targetDir . DIRECTORY_SEPARATOR . $this->extension->getVersion());
        }
    }

    /**
     * @throws ReflectionException
     */
    public function generate(): void
    {
        $this->generateFileStructure();
    }

    /**
     * @throws ReflectionException
     */
    protected function generateFileStructure(): void
    {
        $classes = $this->extension->getClassNames();

        foreach ($classes as $class) {
            $reflectionClass = new ReflectionClass($class);

            $output = "<?php\n\n";
            $output .= $this->exportNamespace($reflectionClass);
            $output .= $this->exportDefinition($reflectionClass);
            $output .= "\n{\n\n";
            $output .= $this->exportClassConstants($reflectionClass);
            $output .= $this->exportClassProperties($reflectionClass);
            $output .= $this->exportClassMethods($reflectionClass);
            $output .= "}";

            $dir_class = str_replace('\\', DIRECTORY_SEPARATOR, $reflectionClass->getNamespaceName());
            $dir = $this->targetDir .
                DIRECTORY_SEPARATOR . $this->extension->getVersion() . DIRECTORY_SEPARATOR . $dir_class;

            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }

            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
            $path = $this->targetDir .
                DIRECTORY_SEPARATOR . $this->extension->getVersion() . DIRECTORY_SEPARATOR . $file;

            $fp = fopen($path, 'w+');
            fputs($fp, $output);
            fclose($fp);
        }
    }

    /**
     * @param  ReflectionClass $reflectionClass
     * @return string
     */
    protected function exportNamespace(ReflectionClass $reflectionClass): string
    {
        return 'namespace ' . $reflectionClass->getNamespaceName() . ";\n\n";
    }

    /**
     * @param  ReflectionClass $reflectionClass
     * @return string
     */
    protected function exportDefinition(ReflectionClass $reflectionClass): string
    {
        $definition = [$this->removeNamespace($reflectionClass)];

        if ($reflectionClass->isInterface()) {
            array_unshift($definition, 'interface');
        } else {
            array_unshift($definition, 'class');

            if ($reflectionClass->isFinal()) {
                array_unshift($definition, 'final');
            }

            if ($reflectionClass->isAbstract()) {
                array_unshift($definition, 'abstract');
            }
        }

        $parent = $reflectionClass->getParentClass();
        if (method_exists($parent, 'getName')) {
            array_push($definition, 'extends');
            array_push($definition, $parent->getName());
        }

        $interfaces = $reflectionClass->getInterfaceNames();
        if (is_array($interfaces) && count($interfaces) > 0) {
            array_push($definition, 'implements');
            array_push($definition, implode(', ', $interfaces));
        }

        return trim(implode(' ', $definition));
    }

    /**
     * @param  ReflectionClass $reflectionClass
     * @return string
     */
    protected function removeNamespace(ReflectionClass $reflectionClass): string
    {
        $class = str_replace($reflectionClass->getNamespaceName(), '', $reflectionClass->getName());

        return ltrim($class, '\\');
    }

    /**
     * @param  ReflectionClass $reflectionClass
     * @return null|string
     */
    protected function exportClassConstants(ReflectionClass $reflectionClass): ?string
    {
        $constants = $reflectionClass->getConstants();
        $all = [];

        if (!empty($constants)) {
            foreach ($constants as $name => $value) {
                array_push($all, sprintf("\tconst %s = %s;", $name, $value));
            }
        }

        if (empty($all)) {
            return null;
        }

        return implode("\n", $all);
    }

    /**
     * @param  ReflectionClass $reflectionClass
     * @return null|string
     */
    protected function exportClassProperties(ReflectionClass $reflectionClass): ?string
    {
        $properties = $reflectionClass->getProperties();

        if (empty($properties)) {
            return null;
        }

        $output = '';

        foreach ($properties as $property) {
            $doc = ["\t/**"];
            if ($property->isStatic()) {
                $doc[] = sprintf("\t * @static");
            }
            $doc[] = sprintf("\t * @var $%s", $property->getName());
            $doc[] = "\t */\n";
            $output .= implode("\n", $doc);

            $var = [];
            if ($property->isPrivate()) {
                $var[] = 'private';
            } elseif ($property->isProtected()) {
                $var[] = 'protected';
            } elseif ($property->isPublic()) {
                $var[] = 'public';
            }

            if ($property->isStatic()) {
                $var[] = 'static';
            }

            $var[] = sprintf('$%s;', $property->getName());
            $output .= "\t" . implode(' ', $var) . "\n\n";
        }

        return $output;
    }

    /**
     * @param ReflectionClass $reflectionClass
     * @return null|string
     * @throws ReflectionException
     */
    protected function exportClassMethods(ReflectionClass $reflectionClass): ?string
    {
        $methods = $reflectionClass->getMethods();

        if (empty($methods)) {
            return null;
        }

        $output = '';

        foreach ($methods as $method) {
            /** @var ReflectionMethod|ReflectionParameter $method */
            $doc = ["\t/**"];
            $func = [];

            if ($method->isFinal()) {
                $doc[] = sprintf("\t * @final");
                $func[] = 'final';
            }

            if ($method->isPrivate()) {
                $func[] = 'private';
            } elseif ($method->isProtected()) {
                $func[] = 'protected';
            } elseif ($method->isPublic()) {
                $func[] = 'public';
            }

            if ($method->isStatic()) {
                $doc[] = sprintf("\t * @static");
                $func[] = 'static';
            }

            $func[] = 'function';

            $params = [];

            foreach ($method->getParameters() as $parameter) {
                $name = $parameter->getName();
                $_doc = '';
                $param = '$' . $name;

                if ($parameter->isOptional() && $parameter->isDefaultValueAvailable()) {
                    if ($parameter->isArray()) {
                        $param .= ' = ' . print_r($parameter->getDefaultValue(), true);
                        $_doc .= 'array ';
                    } else {
                        if (gettype($method->getDefaultValue()) == 'string') {
                            $param .= " = '" . $method->getDefaultValue() . "'";
                        } else {
                            $param .= " = " . $method->getDefaultValue();
                        }

                        $_doc .= gettype($method->getDefaultValue()) . ' ';
                    }
                } elseif ($parameter->isDefaultValueAvailable()) {
                    $param = '&' . $param;
                }

                $_doc .= '$';
                $doc[] = sprintf("\t * @param %s", $_doc . $name);
                $params[] = $param;
            }

            $func[] = $method->getName() . '(' . implode(', ', $params) . ')';

            $doc[] = "\t */\n";
            $func[] = "\n\t{}\n";
            $output .= implode("\n", $doc);
            $output .= "\t" . implode(' ', $func) . "\n";
        }

        return $output;
    }

    /**
     * @param string $dir
     */
    protected function cleanup(string $dir): void
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dir),
            RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($iterator as $path) {
            if ($path->isDir() && !in_array($path->getFileName(), ['.', '..'])) {
                rmdir($path->getPathName());
            } elseif ($path->isFile() && !in_array($path->getFileName(), ['.', '..'])) {
                unlink($path->getPathName());
            }
        }

        rmdir($dir);
    }
}
