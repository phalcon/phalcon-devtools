<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Builder;

use Codeception\Test\Unit;
use Phalcon\DevTools\Builder\AllModels;
use Phalcon\DevTools\Builder\Component;

final class AllModelsTest extends Unit
{
    public function testConstruct(): void
    {
        $class = $this->createMock(AllModels::class);

        $this->assertInstanceOf(Component::class, $class);
    }
}
