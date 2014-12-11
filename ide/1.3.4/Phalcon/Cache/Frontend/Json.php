<?php 

namespace Phalcon\Cache\Frontend {

	/**
	 * Phalcon\Cache\Frontend\Json
	 *
	 * Allows to cache data converting/deconverting them to JSON.
	 *
	 * This adapters uses the json_encode/json_decode PHP's functions
	 *
	 * As the data is encoded in JSON other systems accessing the same backend could
	 * process them
	 *
	 *<code>
	 *
	 * // Cache the data for 2 days
	 * $frontCache = new Phalcon\Cache\Frontend\Json(array(
	 *    "lifetime" => 172800
	 * ));
	 *
	 * //Create the Cache setting memcached connection options
	 * $cache = new Phalcon\Cache\Backend\Memcache($frontCache, array(
	 *		'host' => 'localhost',
	 *		'port' => 11211,
	 *  	'persistent' => false
	 * ));
	 *
	 * //Cache arbitrary data
	 * $cache->save('my-data', array(1, 2, 3, 4, 5));
	 *
	 * //Get data
	 * $data = $cache->get('my-data');
	 *</code>
	 */
	
	class Json extends \Phalcon\Cache\Frontend\Data implements \Phalcon\Cache\FrontendInterface {

		/**
		 * Serializes data before storing it
		 *
		 * @param mixed $data
		 * @return string
		 */
		public function beforeStore($data){ }


		/**
		 * Unserializes data after retrieving it
		 *
		 * @param mixed $data
		 * @return mixed
		 */
		public function afterRetrieve($data){ }

	}
}
