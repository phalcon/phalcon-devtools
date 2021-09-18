<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Builder\Component;

use Codeception\Test\Unit;
use Phalcon\DevTools\Builder\Component\AbstractComponent;
use Phalcon\DevTools\Builder\Component\Task;

final class TaskTest extends Unit
{
    public function testConstruct(): void
    {
        $class = $this->createMock(Task::class);

        $this->assertInstanceOf(AbstractComponent::class, $class);
    }
}
