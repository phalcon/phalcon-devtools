<?php 

namespace Phalcon\Annotations {

	/**
	 * Phalcon\Annotations\AdapterInterface initializer
	 */
	
	interface AdapterInterface {

		/**
		 * Read parsed annotations
		 * 
		 * @param string $key
		 * @return \Phalcon\Annotations\Reflection
		*/
		public function read($key);


		/**
		 * Write parsed annotations
		 * 
		 * @param string $key
		 * @param \Phalcon\Annotations\Reflection $data
		*/
		public function write($key, $data);


		/**
		 * Sets the annotations parser
		 *
		 * @param \Phalcon\Annotations\ReaderInterface $reader
		 */
		public function setReader($reader);


		/**
		 * Returns the annotation reader
		 *
		 * @return \Phalcon\Annotations\ReaderInterface
		 */
		public function getReader();


		/**
		 * Parses or retrieves all the annotations found in a class
		 *
		 * @param string|object $className
		 * @return \Phalcon\Annotations\Reflection
		 */
		public function get($className);


		/**
		 * Returns the annotations found in all the class' methods
		 *
		 * @param string $className
		 * @return array
		 */
		public function getMethods($className);


		/**
		 * Returns the annotations found in a specific method
		 *
		 * @param string $className
		 * @param string $methodName
		 * @return \Phalcon\Annotations\Collection
		 */
		public function getMethod($className, $methodName);


		/**
		 * Returns the annotations found in all the class' methods
		 *
		 * @param string $className
		 * @return array
		 */
		public function getProperties($className);


		/**
		 * Returns the annotations found in a specific property
		 *
		 * @param string $className
		 * @param string $propertyName
		 * @return \Phalcon\Annotations\Collection
		 */
		public function getProperty($className, $propertyName);

	}
}
