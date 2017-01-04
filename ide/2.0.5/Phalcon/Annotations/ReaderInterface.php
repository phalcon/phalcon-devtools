<?php

namespace Phalcon\Annotations;

interface ReaderInterface
{

	/**
	 * Reads annotations from the class dockblocks, its methods and/or properties
	 * 
	 * @param string $className
	 *
	 * @return array
	 */
	public function parse($className);

	/**
	 * Parses a raw doc block returning the annotations found
	 * 
	 * @param string $docBlock
	 * @param $file
	 * @param $line
	 *
	 * @return array
	 */
	public static function parseDocBlock($docBlock, $file=null, $line=null);

}
