<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (https://www.phalconphp.com)      |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Mvc\Model\Migration;

use Phalcon\Db\Profiler as DbProfiler;

/**
 * Phalcon\Mvc\Model\Migration\Profiler
 *
 * Displays transactions made on the database and the times them taken to execute
 *
 * @package Phalcon\Mvc\Model\Migration
 */
class Profiler extends DbProfiler
{
    /**
     * @param $profile DbProfiler
     */
    public function beforeStartProfile($profile)
    {
        echo $profile->getInitialTime() , ': ' , str_replace([ "\n", "\t" ], " ", $profile->getSQLStatement());
    }

    /**
     * @param $profile DbProfiler
     */
    public function afterEndProfile($profile)
    {
        echo '  => ' , $profile->getFinalTime() , ' (' , ($profile->getTotalElapsedSeconds()) , ')' , PHP_EOL;
    }
}
