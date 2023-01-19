<?php

declare(strict_types=1);

namespace Phalcon\DevTools\Generator\Helper;

class ModelMethodsHelper
{
    private $hasInitialize = false;
    private $hasValidations = false;
    private $hasFind = false;
    private $hasFindFirst = false;
    private $hasColumnMapped = false;

    public function setState(string $methodName): void
    {
        switch ($methodName) {
            case 'initialize':
                $this->hasInitialize = true;
                break;
            case 'validation':
                $this->hasValidations = true;
                break;
            case 'find':
                $this->hasFind = true;
                break;
            case 'findFirst':
                $this->hasFindFirst = true;
                break;
            case 'columnMap':
                $this->hasColumnMapped = true;
                break;
        }
    }

    public function alreadyInitialized(): bool
    {
        return $this->hasInitialize;
    }

    public function alreadyValidations(): bool
    {
        return $this->hasValidations;
    }

    public function alreadyFind(): bool
    {
        return $this->hasFind;
    }

    public function alreadyFindFirst(): bool
    {
        return $this->hasFindFirst;
    }

    public function alreadyColumnMapped(): bool
    {
        return $this->hasColumnMapped;
    }
}
