<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Generator;

use Codeception\Test\Unit;
use Phalcon\DevTools\Generator\Snippet;
use Phalcon\DevTools\Options\OptionsAware;

final class SnippetTest extends Unit
{
    /**
     * @var Snippet
     */
    private $snippet;

    public function setUp(): void
    {
        parent::setUp();

        $this->snippet = new Snippet();
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
            'namespace Test\DevTools;' . PHP_EOL . PHP_EOL,
            '',
            '',
            '',
            $options,
            'BaseClass',
            ''
        );

        $this->assertSame($expected, $classString);
    }
}
