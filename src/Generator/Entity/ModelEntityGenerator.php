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

namespace Phalcon\DevTools\Generator\Entity;

use Phalcon\Db\ColumnInterface;
use Phalcon\DevTools\Generator\AbstractEntityGenerator;
use Phalcon\DevTools\Generator\Helper\ModelMethodsHelper;
use Phalcon\DevTools\Generator\Signature\MethodGenerator;
use Phalcon\DevTools\Generator\Signature\PropertyGenerator;

class ModelEntityGenerator extends AbstractEntityGenerator
{
    protected $methodsHelper;

    public function setMethodsHelper(ModelMethodsHelper $methodsHelper): void
    {
        $this->methodsHelper = $methodsHelper;
    }

    public function addPropertyFromColumn(
        ColumnInterface $field,
        string $fieldName,
        string $type,
        string $accessMode,
        bool $annotate = false
    ): PropertyGenerator {
        $property = $this->addProperty($fieldName);
        $property->setAccessMode($accessMode);

        $comments = ["\n@var $type"];
        if ($annotate) {
            if ($field->isPrimary()) {
                $comments[] = '@Primary';
            }
            if ($field->isAutoIncrement()) {
                $comments[] = '@Identity';
            }
            $name = $field->getName();
            $size = $field->getSize() ? ', length=' . $field->getSize() : '';
            $nullable = $field->isNotNull() ? 'false' : 'true';
            $comments[] = "@Column(column=\"$name\", type=\"$type\"$size, nullable=$nullable)";

        }
        $property->addComments($comments);

        return $property;
    }

    public function addSetter(
        ColumnInterface $field,
        string $methodName,
        string $type,
        string $fieldName
    ): MethodGenerator {
        $bodyParts = [
            "\$this->$fieldName = \$$fieldName;\n",
            "\nreturn \$this;\n",
        ];

        return $this->addMethod('set' . $methodName)
            ->addArguments([$fieldName])
            ->setBody(implode('', $bodyParts))
            ->addComments([
                "Method to set the value of field {$field->getName()}\n",
                "@param $type \$$fieldName",
                '@return $this',
            ]);
    }

    public function addGetter(
        ColumnInterface $field,
        string $methodName,
        string $type,
        string $fieldName,
        array $typeMap
    ): MethodGenerator {
        if (isset($typeMap[$type])) {
            $typeMapType = $typeMap[$type];
            $bodyParts = [
                "if (\$this->$fieldName) {\n",
                "return new $typeMapType(\$this->$fieldName);\n",
                "} else {\n",
                "return null;\n",
                "}",
            ];
        } else {
            $bodyParts = [
                "\nreturn \$this->$fieldName;\n",
            ];
        }

        return $this->addMethod('get' . $methodName)
            ->setBody(implode('', $bodyParts))
            ->addComments([
                "Returns the value of field {$field->getName()}\n",
                "@return $type",
            ]);
    }

    public function afterMethodCreation(string $methodName): void
    {
        $this->methodsHelper->setState($methodName);
    }
}
