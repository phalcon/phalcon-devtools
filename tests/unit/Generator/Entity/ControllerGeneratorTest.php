<?php

declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Generator\Helper;

use Codeception\Test\Unit;
use Nette\PhpGenerator\PsrPrinter;
use Phalcon\DevTools\Generator\Entity\ControllerEntityGenerator;
use Psr\Http\Message\UploadedFileInterface;

final class ControllerGeneratorTest extends Unit
{
    private const CLASS_NAME = 'ClassEntity';
    private const BASE_CLASS = 'BaseEntity';
    private const NAMESPACE = 'App\Entities';
    private $generator;

    public function setUp(): void
    {
        parent::setUp();

        $this->generator = new ControllerEntityGenerator(
            self::CLASS_NAME, self::BASE_CLASS, self::NAMESPACE
        );
    }

    public function testPrint(): void
    {
        $code = $this->generator->printCode(new PsrPrinter());

        $this->assertStringContainsString('class ClassEntity extends BaseEntity', $code);
    }

    public function testStrict(): void
    {
        $this->generator->setStrict();
        $code = $this->generator->printCode(new PsrPrinter());

        $this->assertStringContainsString('declare(strict_types=1);', $code);
    }

    public function testAbstract(): void
    {
        $this->generator->setClassAbstract();
        $code = $this->generator->printCode(new PsrPrinter());

        $this->assertStringContainsString('abstract class ClassEntity extends BaseEntity', $code);
    }

    public function testImplements(): void
    {
        $this->generator->addImplements(UploadedFileInterface::class);
        $code = $this->generator->printCode(new PsrPrinter());

        $this->assertStringContainsString('use Psr\Http\Message\UploadedFileInterface;', $code);
        $this->assertStringContainsString('implements UploadedFileInterface', $code);
    }

    public function testAddMethod(): void
    {
        $this->generator->addMethod('test');
        $code = $this->generator->printCode(new PsrPrinter());

        $this->assertStringContainsString('public function test()', $code);
    }

    public function testAddImport(): void
    {
        $this->generator->addImport(self::class);
        $code = $this->generator->printCode(new PsrPrinter());

        $this->assertStringContainsString('use ' . self::class . ';', $code);
    }

    public function testAddConstant(): void
    {
        $this->generator->addConstant('test');
        $code = $this->generator->printCode(new PsrPrinter());

        $this->assertStringContainsString('public const test = null;', $code);
    }

    public function testAddProperty(): void
    {
        $this->generator->addProperty('test');
        $code = $this->generator->printCode(new PsrPrinter());

        $this->assertStringContainsString('public $test;', $code);
    }

    public function testAddMethods(): void
    {
        $this->generator->addMethods([
            'testFunction1' => [],
            'testFunction2' => [],
        ]);
        $code = $this->generator->printCode(new PsrPrinter());

        $this->assertStringContainsString('public function testFunction1()', $code);
        $this->assertStringContainsString('public function testFunction2()', $code);
    }

    public function testGetCleanImports(): void
    {
        $imports = $this->generator->getCleanImports();

        $this->assertSame([
            "ClassEntity" => [],
            "BaseEntity" => [],
        ], $imports);
    }
}
