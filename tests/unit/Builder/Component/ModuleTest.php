<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Builder\Component;

use Codeception\Test\Unit;
use Phalcon\DevTools\Builder\Component\AbstractComponent;
use Phalcon\DevTools\Builder\Component\Module;

final class ModuleTest extends Unit
{
    public function testConstruct(): void
    {
        $class = $this->createMock(Module::class);

        $this->assertInstanceOf(AbstractComponent::class, $class);
    }
}
