<?php

/**
 * Phalcon_Model_Migration_Profiler
 *
 * Displays transactions made on the database and the times them taken to execute
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class Phalcon_Model_Migration_Profiler extends Phalcon_Db_Profiler {

	public function beforeStartProfile($profile){
		echo $profile->getInitialTime(), ': ', str_replace(array("\n", "\t"), " ", $profile->getSQLStatement());
	}

	public function afterEndProfile($profile){
		echo '  => ', $profile->getFinalTime(), ' (', ($profile->getTotalElapsedSeconds()), ')', PHP_EOL;
	}

}