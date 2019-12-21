<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Builder\Project;

use Codeception\Test\Unit;
use Phalcon\DevTools\Builder\Project\Micro;
use Phalcon\DevTools\Builder\Project\ProjectBuilder;

final class MicroTest extends Unit
{
    public function testConstruct(): void
    {
        $class = $this->createMock(Micro::class);

        $this->assertInstanceOf(ProjectBuilder::class, $class);
    }
}
