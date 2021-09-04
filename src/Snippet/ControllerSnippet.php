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

use Phalcon\Config;
use Phalcon\Db\Column;
use Phalcon\DevTools\Utils;

class ControllerSnippet
{
    public $modelClass;
    public $plural;
    public $singular;
    public $pk;
    public $pkVar;
    public $pkGet;
    public $singularVar;
    public $assignInputRequest;
    public $assignTagDefault;

    public function __construct(string $modelClass, Config $options)
    {
        $dataTypes = $options->get('dataTypes');
        $genSetGet = (bool)$options->get('genSettersGetters');
        $identityField = $options->get('identityField');
        $attributes = $options->get('attributes');

        $this->modelClass = $modelClass;
        $this->plural = $options->get('plural');
        $this->singular = $options->get('singular');
        $this->pk = $attributes[0] ?? '';
        $this->pkVar = '$' . $this->pk;
        $this->pkGet = $genSetGet ? 'get' . Utils::camelize($this->pk, '_-') . '()' : $this->pk;
        $this->singularVar = '$' . Utils::lowerCamelizeWithDelimiter($this->singular, '-', true);
        $this->assignInputRequest = $this->captureFilterInput($this->singular, $dataTypes, $genSetGet, $identityField);
        $this->assignTagDefault = $this->assignTagDefaults($this->singular, $dataTypes, $genSetGet);
    }

    public function getSearchAction(): string
    {
        return sprintf(
            '
$numberPage = $this->request->getQuery("page", "int", 1);
$parameters = Criteria::fromInput($this->di, %s::class, $_GET)->getParams();
$parameters["order"] = "%s";

$paginator = new Model([
    "model" => %s::class,
    "parameters" => $parameters,
    "limit" => 10,
    "page" => $numberPage,
]);

$paginate = $paginator->paginate();

if (0 === $paginate->getTotalItems()) {
    $this->flash->notice("The search did not find any %s");

    $this->dispatcher->forward([
        "controller" => "%s",
        "action" => "index",
    ]);

    return;
}

$this->view->page = $paginate;
',
            $this->modelClass,
            $this->pk,
            $this->modelClass,
            $this->plural,
            $this->plural
        );
    }

    public function getEditAction(): string
    {
        return sprintf(
            '
if (!$this->request->isPost()) {
    /** @var %s %s */
    %s = %s::findFirstBy%s(%s);
    if (!%s) {
        $this->flash->error("%s was not found");

        $this->dispatcher->forward([
            "controller" => "%s",
            "action" => "index",
        ]);

        return;
    }

    $this->view->%s = %s->%s;

%s
}
',
            $this->modelClass,
            $this->singularVar,
            $this->singularVar,
            $this->modelClass,
            $this->pk,
            $this->pkVar,
            $this->singularVar,
            $this->singular,
            $this->plural,
            $this->pk,
            $this->singularVar,
            $this->pkGet,
            $this->assignTagDefault
        );
    }

    public function getCreateAction(): string
    {
        return sprintf(
            '
if (!$this->request->isPost()) {
    $this->dispatcher->forward([
        "controller" => "%s",
        "action" => "index"
    ]);

    return;
}

%s = new %s();
%s

if (!%s->save()) {
    foreach (%s->getMessages() as $message) {
        $this->flash->error($message);
    }

    $this->dispatcher->forward([
        "controller" => "%s",
        "action" => "new",
    ]);

    return;
}

$this->flash->success("%s was created successfully");

$this->dispatcher->forward([
    "controller" => "%s",
    "action" => "index",
]);
',
            $this->plural,
            $this->singularVar,
            $this->modelClass,
            $this->assignInputRequest,
            $this->singularVar,
            $this->singularVar,
            $this->plural,
            $this->singular,
            $this->plural
        );
    }

    public function getSaveAction(): string
    {
        return sprintf(
            '
if (!$this->request->isPost()) {
    $this->dispatcher->forward([
        "controller" => "%s",
        "action" => "index",
    ]);

    return;
}

%s = $this->request->getPost("%s");
/** @var %s %s */
%s = %s::findFirstBy%s(%s);

if (!%s) {
    $this->flash->error("%s does not exist " . %s);

    $this->dispatcher->forward([
        "controller" => "%s",
        "action" => "index",
    ]);

    return;
}

%s

if (!%s->save()) {
    foreach (%s->getMessages() as $message) {
        $this->flash->error($message);
    }

    $this->dispatcher->forward([
        "controller" => "%s",
        "action" => "edit",
        "params" => [%s->%s],
    ]);

    return;
}

$this->flash->success("%s was updated successfully");

$this->dispatcher->forward([
    "controller" => "%s",
    "action" => "index",
]);
',
            $this->plural,
            $this->pkVar,
            $this->pk,
            $this->modelClass,
            $this->singularVar,
            $this->singularVar,
            $this->modelClass,
            $this->pk,
            $this->pkVar,
            $this->singularVar,
            $this->singular,
            $this->pkVar,
            $this->plural,
            $this->assignInputRequest,
            $this->singularVar,
            $this->singularVar,
            $this->plural,
            $this->singularVar,
            $this->pkGet,
            $this->singular,
            $this->plural
        );
    }

    public function getDeleteAction(): string
    {
        return sprintf(
            '
/** @var %s %s */
%s = %s::findFirstBy%s(%s);
if (!%s) {
    $this->flash->error("%s was not found");

    $this->dispatcher->forward([
        "controller" => "%s",
        "action" => "index",
    ]);

    return;
}

if (!%s->delete()) {

    foreach (%s->getMessages() as $message) {
        $this->flash->error($message);
    }

    $this->dispatcher->forward([
        "controller" => "%s",
        "action" => "search",
    ]);

    return;
}

$this->flash->success("%s was deleted successfully");

$this->dispatcher->forward([
    "controller" => "%s",
    "action" => "index",
]);
',
            $this->modelClass,
            $this->singularVar,
            $this->singularVar,
            $this->modelClass,
            $this->pk,
            $this->pkVar,
            $this->singularVar,
            $this->singular,
            $this->plural,
            $this->singularVar,
            $this->singularVar,
            $this->plural,
            $this->singular,
            $this->plural
        );
    }

    /**
     * @param string $var
     * @param mixed $fields
     * @param bool $useGetSet
     * @param null|string $identityField
     *
     * @return string
     */
    private function captureFilterInput(string $var, $fields, bool $useGetSet, string $identityField = null): string
    {
        $codes = [];
        foreach ($fields as $field => $dataType) {
            if ($identityField !== null && $field === $identityField) {
                continue;
            }

            if (\in_array($dataType, [Column::TYPE_DECIMAL, Column::TYPE_INTEGER])) {
                $fieldCode = '$this->request->getPost("' . $field . '", "int")';
            } elseif ($field === 'email') {
                $fieldCode = '$this->request->getPost("' . $field . '", "email")';
            } else {
                $fieldCode = '$this->request->getPost("' . $field . '")';
            }

            $code = '$' . Utils::lowerCamelizeWithDelimiter($var, '-', true) . '->';
            if ($useGetSet) {
                $code .= 'set' . Utils::camelize($field, '_-') . '(' . $fieldCode . ');';
            } else {
                $code .= $field . ' = ' . $fieldCode . ';';
            }

            $codes[] = $code;
        }

        return implode(PHP_EOL, $codes);
    }

    /**
     * @param string $var
     * @param mixed $fields
     * @param bool $useGetSetters
     *
     * @return string
     */
    private function assignTagDefaults(string $var, $fields, bool $useGetSetters): string
    {
        $code = [];
        foreach ($fields as $field => $dataType) {
            if ($useGetSetters) {
                $accessor = 'get' . Utils::camelize($field, '_-') . '()';
            } else {
                $accessor = $field;
            }

            $code[] = "\t" .
                      "Tag::setDefault('$field', $" .
                      Utils::lowerCamelizeWithDelimiter($var, '-', true) .
                      '->' .
                      $accessor .
                      ');';
        }

        return implode(PHP_EOL, $code);
    }
}
