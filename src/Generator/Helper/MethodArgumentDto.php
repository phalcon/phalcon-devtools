<?php

declare(strict_types=1);

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Phalcon\DevTools\Generator\Helper;

class MethodArgumentDto
{
    public const NO_VALUE = '#no_value_argument#';

    private $name;
    private $type;
    private $nullable;
    private $ref;
    private $default;

    public function __construct(
        string $name,
        ?string $type = null,
        bool $nullable = false,
        $default = self::NO_VALUE,
        bool $ref = false
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->nullable = $nullable;
        $this->ref = $ref;
        $this->default = $default;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function isNullable(): bool
    {
        return $this->nullable;
    }

    /**
     * @return bool
     */
    public function isRef(): bool
    {
        return $this->ref;
    }

    /**
     * @return mixed|null
     */
    public function getDefault()
    {
        return $this->default;
    }
}
