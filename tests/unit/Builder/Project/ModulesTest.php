<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Builder\Project;

use Codeception\Test\Unit;
use Phalcon\DevTools\Builder\Project\Modules;
use Phalcon\DevTools\Builder\Project\ProjectBuilder;

final class ModulesTest extends Unit
{
    public function testConstruct(): void
    {
        $class = $this->createMock(Modules::class);

        $this->assertInstanceOf(ProjectBuilder::class, $class);
    }
}
