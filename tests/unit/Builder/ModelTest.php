<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Builder;

use Codeception\Test\Unit;
use Phalcon\DevTools\Builder\Component;
use Phalcon\DevTools\Builder\Model;

final class ModelTest extends Unit
{
    public function testConstruct(): void
    {
        $class = $this->createMock(Model::class);

        $this->assertInstanceOf(Component::class, $class);
    }
}
