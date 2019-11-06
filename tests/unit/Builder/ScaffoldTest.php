<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Builder;

use Codeception\Test\Unit;
use Phalcon\DevTools\Builder\Component;
use Phalcon\DevTools\Builder\Scaffold;

final class ScaffoldTest extends Unit
{
    public function testConstruct(): void
    {
        $class = $this->createMock(Scaffold::class);

        $this->assertInstanceOf(Component::class, $class);
    }
}
