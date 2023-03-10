<?php

namespace Helper;

use Codeception\Module;

/**
 * Console Helper
 *
 * Here you can define custom actions
 * all public methods declared in helper class will be available in $I
 *
 * @package Helper
 */
class Console extends Module
{
    public function haveFile($path, $content = null)
    {
        file_put_contents($path, $content ?: '');
    }
}
