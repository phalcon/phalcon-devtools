<?php 

namespace Phalcon {

	/**
	 * Phalcon\Registry
	 *
	 * A registry is a container for storing objects and values in the application space.
	 * By storing the value in a registry, the same object is always available throughout
	 * your application.
	 *
	 * <code>
	 * 	$registry = new \Phalcon\Registry();
	 *
	 * 	// Set value
	 * 	$registry->something = 'something';
	 * 	// or
	 * 	$registry['something'] = 'something';
	 *
	 * 	// Get value
	 * 	$value = $registry->something;
	 * 	// or
	 * 	$value = $registry['something'];
	 *
	 * 	// Check if the key exists
	 * 	$exists = isset($registry->something);
	 * 	// or
	 * 	$exists = isset($registry['something']);
	 *
	 * 	// Unset
	 * 	unset($registry->something);
	 * 	// or
	 * 	unset($registry['something']);
	 * </code>
	 *
	 * In addition to ArrayAccess, Phalcon\Registry also implements Countable
	 * (count($registry) will return the number of elements in the registry),
	 * Serializable and Iterator (you can iterate over the registry
	 * using a foreach loop) interfaces. For PHP 5.4 and higher, JsonSerializable
	 * interface is implemented.
	 *
	 * Phalcon\Registry is very fast (it is typically faster than any userspace
	 * implementation of the registry); however, this comes at a price:
	 * Phalcon\Registry is a final class and cannot be inherited from.
	 *
	 * Though Phalcon\Registry exposes methods like __get(), offsetGet(), count() etc,
	 * it is not recommended to invoke them manually (these methods exist mainly to
	 * match the interfaces the registry implements): $registry->__get('property')
	 * is several times slower than $registry->property.
	 *
	 * Internally all the magic methods (and interfaces except JsonSerializable)
	 * are implemented using object handlers or similar techniques: this allows
	 * to bypass relatively slow method calls.
	 */
	
	final class Registry implements \ArrayAccess, \Iterator, \Traversable, \Serializable, \Countable, \JsonSerializable {

		public function __get($property){ }


		public function __set($property, $value){ }


		public function __isset($property){ }


		public function __unset($property){ }


		public function __call($method, $arguments=null){ }


		public function count(){ }


		public function offsetGet($property){ }


		public function offsetSet($property, $value){ }


		public function offsetUnset($property){ }


		public function offsetExists($property){ }


		public function current(){ }


		public function key(){ }


		public function next(){ }


		public function rewind(){ }


		public function valid(){ }


		public function jsonSerialize(){ }


		public function serialize(){ }


		public function unserialize($serialized=null){ }


		private function __wakeup(){ }

	}
}
