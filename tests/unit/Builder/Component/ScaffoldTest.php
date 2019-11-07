<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Builder\Component;

use Codeception\Test\Unit;
use Phalcon\DevTools\Builder\Component\AbstractComponent;
use Phalcon\DevTools\Builder\Component\Scaffold;

final class ScaffoldTest extends Unit
{
    public function testConstruct(): void
    {
        $class = $this->createMock(Scaffold::class);

        $this->assertInstanceOf(AbstractComponent::class, $class);
    }
}
