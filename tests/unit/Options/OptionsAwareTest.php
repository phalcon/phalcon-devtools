<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Options;

use Codeception\Test\Unit;
use Phalcon\DevTools\Options\OptionsAware;

final class OptionsAwareTest extends Unit
{
    private $optionsAwareConfig;

    public function setUp(): void
    {
        parent::setUp();

        $this->optionsAwareConfig = new OptionsAware();
    }

    public function testImplementation(): void
    {
        $this->assertInstanceOf(OptionsAware::class, $this->optionsAwareConfig);
    }

    public function testSetGetOption(): void
    {
        $this->optionsAwareConfig->setOption('testKey', 'testValue');

        $this->assertSame('testValue', $this->optionsAwareConfig->getOption('testKey'));
    }

    public function testSetGetValidOptionOrDefaultValue(): void
    {
        $this->optionsAwareConfig->setValidOptionOrDefaultValue('testKey', '', 'defaultValue');

        $this->assertSame('defaultValue', $this->optionsAwareConfig->getOption('testKey'));
    }

    public function testHasOption(): void
    {
        $this->optionsAwareConfig->setOption('testKey', 'testValue');

        $this->assertTrue($this->optionsAwareConfig->hasOption('testKey'));
    }
}
