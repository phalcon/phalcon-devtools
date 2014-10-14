<?php 

namespace Phalcon\Annotations {

	/**
	 * Phalcon\Annotations\ReaderInterface initializer
	 */
	
	interface ReaderInterface {

		/**
		 * Reads annotations from the class dockblocks, its methods and/or properties
		 *
		 * @param string $className
		 * @return array
		 */
		public function parse($className);


		/**
		 * Parses a raw doc block returning the annotations found
		 *
		 * @param string $docBlock
		 * @return array
		 */
		public static function parseDocBlock($docBlock, $file=null, $line=null);

	}
}
