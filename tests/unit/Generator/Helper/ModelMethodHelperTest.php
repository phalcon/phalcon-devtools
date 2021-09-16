<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Generator\Helper;

use Codeception\Test\Unit;
use Phalcon\DevTools\Generator\Helper\ModelMethodsHelper;

final class ModelMethodHelperTest extends Unit
{
    private $modelMethodsHelper;

    public function setUp(): void
    {
        parent::setUp();
        $this->modelMethodsHelper = new ModelMethodsHelper();
    }

    public function testInstance(): void
    {
        $this->assertInstanceOf(ModelMethodsHelper::class, $this->modelMethodsHelper);
    }

    public function testState(): void
    {
        $this->modelMethodsHelper->setState('initialize');
        $this->assertTrue($this->modelMethodsHelper->alreadyInitialized());

        $this->modelMethodsHelper->setState('findFirst');
        $this->assertTrue($this->modelMethodsHelper->alreadyFindFirst());

        $this->modelMethodsHelper->setState('find');
        $this->assertTrue($this->modelMethodsHelper->alreadyFind());

        $this->modelMethodsHelper->setState('validation');
        $this->assertTrue($this->modelMethodsHelper->alreadyValidations());

        $this->modelMethodsHelper->setState('columnMap');
        $this->assertTrue($this->modelMethodsHelper->alreadyColumnMapped());
    }
}
