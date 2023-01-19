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

namespace Phalcon\DevTools\Generator\Signature;

use Nette\PhpGenerator\Constant;

class ConstantGenerator
{
    private $constant;

    public function __construct(Constant $constant)
    {
        $this->constant = $constant;
    }

    public function addComments(array $comments): void
    {
        foreach ($comments as $comment) {
            $this->constant->addComment($comment);
        }
    }

    public function setAccessMode(string $accessMode): void
    {
        if ($accessMode === 'private') {
            $this->constant->setPrivate();
        } elseif ($accessMode === 'protected') {
            $this->constant->setProtected();
        } else {
            $this->constant->setPublic();
        }
    }
}
