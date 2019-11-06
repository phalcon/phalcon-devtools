<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Builder\Project;

use Codeception\Test\Unit;
use Phalcon\DevTools\Builder\Project\Cli;
use Phalcon\DevTools\Builder\Project\ProjectBuilder;

final class CliTest extends Unit
{
    public function testConstruct(): void
    {
        $class = $this->createMock(Cli::class);

        $this->assertInstanceOf(ProjectBuilder::class, $class);
    }
}
