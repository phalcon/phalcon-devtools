<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Snippet;

use Codeception\Test\Unit;
use Phalcon\Config;
use Phalcon\DevTools\Snippet\ControllerSnippet;

final class ControllerSnippetTest extends Unit
{
    private const MODEL_CLASS = 'TestModel';

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testSearchAction(): void
    {
        $options = $this->getOptions();
        $snippet = new ControllerSnippet(self::MODEL_CLASS, $options);
        $data = $snippet->getSearchAction();

        $this->assertStringContainsString(self::MODEL_CLASS, $data);
    }

    public function testEditAction(): void
    {
        $options = $this->getOptions();
        $snippet = new ControllerSnippet(self::MODEL_CLASS, $options);
        $data = $snippet->getEditAction();

        $this->assertStringContainsString(self::MODEL_CLASS, $data);
    }

    public function testCreateAction(): void
    {
        $options = $this->getOptions();
        $snippet = new ControllerSnippet(self::MODEL_CLASS, $options);
        $data = $snippet->getCreateAction();

        $this->assertStringContainsString(self::MODEL_CLASS, $data);
    }

    public function testSaveAction(): void
    {
        $options = $this->getOptions();
        $snippet = new ControllerSnippet(self::MODEL_CLASS, $options);
        $data = $snippet->getSaveAction();

        $this->assertStringContainsString(self::MODEL_CLASS, $data);
    }

    public function testDeleteAction(): void
    {
        $options = $this->getOptions();
        $snippet = new ControllerSnippet(self::MODEL_CLASS, $options);
        $data = $snippet->getDeleteAction();

        $this->assertStringContainsString(self::MODEL_CLASS, $data);
    }

    private function getOptions(): Config
    {
        return new Config([
            'plural' => 'record',
            'singular' => 'Record',
            'genSettersGetters' => true,
            'identityField' => null,
            'dataTypes' => [],
            'attributes' => [],
        ]);
    }
}
