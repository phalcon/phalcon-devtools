#!/usr/bin/env php
<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-present Phalcon Team (https://www.phalconphp.com)   |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>             |
  +------------------------------------------------------------------------+
*/

use Phalcon\Exception as PhalconException;
use Phalcon\Devtools\Modules\DevtoolsApplication;
use Phalcon\Devtools\Modules\Core\CliApplication;

try {
    require dirname(__FILE__) . '/bootstrap/autoload.php';

    $cliApp = new CliApplication();

    $applicarion = new DevtoolsApplication($cliApp);
    $applicarion->run($argv);

    $result = true;
} catch (\Exception $e) {
    fwrite(STDERR, $e->getMessage());//@todo add colorized message

    $result = false;
} catch (PhalconException $e) {
    fwrite(STDERR, $e->getMessage());//@todo add colorized message

    $result = false;
} catch (\Throwable $e) {
    fwrite(STDERR, $e->getMessage());//@todo add colorized message

    $result = false;
}

$result || exit(1);
