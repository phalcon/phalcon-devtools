<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Generator\Helper;

use Codeception\Test\Unit;
use Phalcon\DevTools\Generator\Helper\MethodArgumentDto;

final class MethodArgumentDtoTest extends Unit
{
    private $methodArgumentDto;

    public function setUp(): void
    {
        parent::setUp();
        $this->methodArgumentDto = new MethodArgumentDto(
            'testName', 'testType'
        );
    }

    public function testInstance(): void
    {
        $this->assertInstanceOf(MethodArgumentDto::class, $this->methodArgumentDto);
    }

    public function testGetters(): void
    {
        $this->assertSame('testName', $this->methodArgumentDto->getName());
        $this->assertSame('testType', $this->methodArgumentDto->getType());
        $this->assertFalse($this->methodArgumentDto->isNullable());
        $this->assertFalse($this->methodArgumentDto->isRef());
        $this->assertSame(MethodArgumentDto::NO_VALUE, $this->methodArgumentDto->getDefault());
    }
}
