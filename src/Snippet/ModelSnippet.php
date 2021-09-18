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

namespace Phalcon\DevTools\Snippet;

use Phalcon\Db\ColumnInterface;
use Phalcon\DevTools\Options\OptionsAware as ModelOption;
use Phalcon\DevTools\Utils;

class ModelSnippet
{
    /**
     * @param ModelOption $modelOptions
     * @param string $namespace
     * @param string $useDefinition
     * @param string $classDoc
     * @param string $abstract
     * @param string $extends
     * @param string $content
     * @param string $license
     * @return string
     */
    public function getClass(
        ModelOption $modelOptions,
        string $namespace,
        string $useDefinition,
        string $classDoc = '',
        string $abstract = '',
        string $extends = '',
        string $content = '',
        string $license = ''
    ): string {
        $className = $modelOptions->getOption('className');

        $code = '<?php' . PHP_EOL . PHP_EOL;
        $code .= "{$license}{$namespace}{$useDefinition}{$classDoc}{$abstract}";
        $code .= "class {$className} extends {$extends}\n{\n{$content}\n}" . PHP_EOL;

        return $code;
    }

    public function getValidateInclusion($fieldName, $varItems): string
    {
        return "
\$this->validate(new InclusionIn([
    'field'    => '$fieldName',
    'domain'   => [$varItems],
    'required' => true,
]));" . PHP_EOL;
    }

    public function getValidateEmail($fieldName): string
    {
        return "
\$validator->add('$fieldName', new EmailValidator([
    'model'   => \$this,
    'message' => 'Please enter a correct email address',
]));" . PHP_EOL;
    }

    /**
     * @param ColumnInterface[] $fields
     * @param bool $camelize
     *
     * @return string
     */
    public function getColumnMap(array $fields, bool $camelize): string
    {
        $contents = [];
        foreach ($fields as $field) {
            $name = $field->getName();
            $alias = $camelize ? Utils::lowerCamelize($name) : $name;
            $contents[] = "'$name' => '$alias',";
        }

        return sprintf("return [\n    %s\n];", implode("\n    ", $contents));
    }

    public function getRelation($relation, $column1, $entity, $column2, $alias): string
    {
        $templateRelation = "\$this->%s('%s', '%s', '%s', %s);" . PHP_EOL;

        return sprintf($templateRelation, $relation, $column1, $entity, $column2, $alias);
    }
}
