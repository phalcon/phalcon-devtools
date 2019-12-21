<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Builder\Project;

use Codeception\Test\Unit;
use Phalcon\DevTools\Builder\Project\ProjectBuilder;
use Phalcon\DevTools\Builder\Project\Simple;

final class SimpleTest extends Unit
{
    public function testConstruct(): void
    {
        $class = $this->createMock(Simple::class);

        $this->assertInstanceOf(ProjectBuilder::class, $class);
    }
}
