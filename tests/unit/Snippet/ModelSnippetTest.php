<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Snippet;

use Codeception\Test\Unit;
use Phalcon\Db\Column;
use Phalcon\DevTools\Options\OptionsAware;
use Phalcon\DevTools\Snippet\ModelSnippet;

final class ModelSnippetTest extends Unit
{
    /**
     * @var ModelSnippet
     */
    private $snippet;

    public function setUp(): void
    {
        parent::setUp();

        $this->snippet = new ModelSnippet();
    }

    public function testGetClass(): void
    {
        $expected = <<<EOD
<?php

namespace Test\DevTools;

class Test extends BaseClass
{

}

EOD;

        $options = new OptionsAware([
            'className' => 'Test',
        ]);

        $classString = $this->snippet->getClass(
            $options,
            'namespace Test\DevTools;' . PHP_EOL . PHP_EOL,
            '',
            '',
            '',
            'BaseClass',
            ''
        );

        $this->assertSame($expected, $classString);
    }

    public function testGetValidateInclusion(): void
    {
        $validateInclusion = $this->snippet->getValidateInclusion(
            'test',
            '1, 2, 3'
        );

        $this->assertStringContainsString("'domain'   => [1, 2, 3],", $validateInclusion);
    }

    public function testGetValidateEmail(): void
    {
        $validateEmail = $this->snippet->getValidateEmail(
            'email_field'
        );

        $this->assertStringContainsString("\$validator->add('email_field'", $validateEmail);
    }

    public function testGetColumnMap(): void
    {
        $columnMap = $this->snippet->getColumnMap(
            [], true
        );

        $this->assertStringContainsString("return [\n    \n];", $columnMap);
    }
}
