<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Builder;

use Codeception\Test\Unit;
use Phalcon\DevTools\Builder\Component;
use Phalcon\DevTools\Builder\Project;

final class ProjectTest extends Unit
{
    public function testConstruct(): void
    {
        $class = $this->createMock(Project::class);

        $this->assertInstanceOf(Component::class, $class);
    }
}
