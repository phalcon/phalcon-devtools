<?php

namespace Phalcon\Annotations;

use Phalcon\Annotations\ReaderInterface;


class Reader implements ReaderInterface
{

	/**
	 * Reads annotations from the class dockblocks, its methods and/or properties
	 * 
	 * @param string $className
	 *
	 * @return array
	 */
	public function parse($className) {}

	/**
		 * A ReflectionClass is used to obtain the class dockblock
	 * 
	 * @param string $docBlock
	 * @param $file
	 * @param $line
		 *
	 * @return array
	 */
	public static function parseDocBlock($docBlock, $file=null, $line=null) {}

}
