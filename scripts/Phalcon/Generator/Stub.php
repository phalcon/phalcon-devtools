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
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Generator;

class Stub
{
    /**
     * @var \ReflectionExtension
     */
    protected $_extension;

    /**
     * @var string
     */
    protected $_targetDir;

    /**
     * @param string $extension
     * @param string $targetDir
     *
     * @return \Phalcon\Generator\Stub
     * @throws \Exception
     */
    public function __construct($extension, $targetDir)
    {
        if (!extension_loaded($extension)) {
            throw new \Exception("Extension '{$extension}' was not loaded");
        }

        $this->_extension = new \ReflectionExtension($extension);
        $this->_targetDir = rtrim($targetDir, DIRECTORY_SEPARATOR);

        if (is_dir($this->_targetDir . DIRECTORY_SEPARATOR . $this->_extension->getVersion())) {
            $this->_cleanup($this->_targetDir . DIRECTORY_SEPARATOR . $this->_extension->getVersion());
        }
    }

    /**
     * @return void
     */
    public function generate()
    {
        $this->_generateFileStructure();
    }

    /**
     * @return void
     */
    protected function _generateFileStructure()
    {
        $classes = $this->_extension->getClassNames();

        foreach ($classes as $class) {
            $reflectionClass = new \ReflectionClass($class);

            $output = "<?php\n\n";
            $output .= $this->_exportNamespace($reflectionClass);
            $output .= $this->_exportDefinition($reflectionClass);
            $output .= "\n{\n\n";
            $output .= $this->_exportClassConstants($reflectionClass);
            $output .= $this->_exportClassProperties($reflectionClass);
            $output .= $this->_exportClassMethods($reflectionClass);
            $output .= "}";

            $dir_class = str_replace('\\', DIRECTORY_SEPARATOR, $reflectionClass->getNamespaceName());
            $dir = $this->_targetDir . DIRECTORY_SEPARATOR . $this->_extension->getVersion() . DIRECTORY_SEPARATOR . $dir_class;

            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }

            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
            $path = $this->_targetDir . DIRECTORY_SEPARATOR . $this->_extension->getVersion() . DIRECTORY_SEPARATOR . $file;

            $fp = fopen($path, 'w+');
            fputs($fp, $output);
            fclose($fp);
        }
    }

    /**
     * @param  \ReflectionClass $reflectionClass
     * @return string
     */
    protected function _exportNamespace(\ReflectionClass $reflectionClass)
    {
        return 'namespace ' . $reflectionClass->getNamespaceName() . ";\n\n";
    }

    /**
     * @param  \ReflectionClass $reflectionClass
     * @return string
     */
    protected function _exportDefinition(\ReflectionClass $reflectionClass)
    {
        $definition = [$this->_removeNamespace($reflectionClass)];

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
        if (method_exists('getName', $parent)) {
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
     * @param  \ReflectionClass $reflectionClass
     * @return string
     */
    protected function _removeNamespace(\ReflectionClass $reflectionClass)
    {
        $class = str_replace($reflectionClass->getNamespaceName(), '', $reflectionClass->getName());

        return ltrim($class, '\\');
    }

    /**
     * @param  \ReflectionClass $reflectionClass
     * @return null|string
     */
    protected function _exportClassConstants(\ReflectionClass $reflectionClass)
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
     * @param  \ReflectionClass $reflectionClass
     * @return null|string
     */
    protected function _exportClassProperties(\ReflectionClass $reflectionClass)
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
     * @param  \ReflectionClass $reflectionClass
     * @return null|string
     */
    protected function _exportClassMethods(\ReflectionClass $reflectionClass)
    {
        $methods = $reflectionClass->getMethods();

        if (empty($methods)) {
            return null;
        }

        $output = '';

        foreach ($methods as $method) {
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
    protected function _cleanup($dir)
    {
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir), \RecursiveIteratorIterator::CHILD_FIRST);

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
$s = new Stub('phalcon', __DIR__ . '/../../../ide');
$s->generate();
