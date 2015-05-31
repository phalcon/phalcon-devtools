<?php 

namespace Phalcon\Translate\Adapter {

	/**
	 * Class Gettext
	 *
	 * @package Phalcon\Translate\Adapter
	 */
	
	class Gettext extends \Phalcon\Translate\Adapter implements \Phalcon\Translate\AdapterInterface, \ArrayAccess {

		protected $_directory;

		protected $_defaultDomain;

		protected $_locale;

		protected $_category;

		/**
		 * \Phalcon\Translate\Adapter\Gettext constructor
		 */
		public function __construct($options){ }


		/**
		 * Returns the translation related to the given key
		 *
		 * @param string  index
		 * @param array   placeholders
		 * @param string  domain
		 * @return string
		 */
		public function query($index, $placeholders=null){ }


		/**
		 * Check whether is defined a translation key in the internal array
		 */
		public function exists($index){ }


		/**
		 * The plural version of gettext().
		 * Some languages have more than one form for plural messages dependent on the count.
		 *
		 * @param  string  msgid1
		 * @param  string  msgid2
		 * @param  int     count
		 * @param  array   placeholders
		 * @param  string  domain
		 *
		 * @return string
		 */
		public function nquery($msgid1, $msgid2, $count, $placeholders=null, $domain=null){ }


		/**
		 * Changes the current domain (i.e. the translation file). The passed domain must be one
		 * of those passed to the constructor.
		 *
		 * @param  string domain
		 *
		 * @return string Returns the new current domain.
		 * @throws \InvalidArgumentException
		 */
		public function setDomain($domain){ }


		/**
		 * Sets the default domain
		 *
		 * @return string Returns the new current domain.
		 */
		public function resetDomain(){ }


		/**
		 * Sets the domain default to search within when calls are made to gettext()
		 */
		public function setDefaultDomain($domain){ }


		/**
		 * Gets the default domain
		 */
		public function getDefaultDomain(){ }


		/**
		 * Sets the path for a domain
		 */
		public function setDirectory($directory){ }


		/**
		 * Gets the path for a domain
		 */
		public function getDirectory($directory){ }


		/**
		 * Sets locale information
		 */
		public function setLocale($category, $locale){ }


		/**
		 * Gets locale
		 */
		public function getLocale(){ }


		/**
		 * Gets locale category
		 */
		public function getCategory(){ }


		/**
		 * Validator for constructor
		 */
		protected function prepareOptions($options){ }


		/**
		 * Gets default options
		 */
		protected function getOptionsDefault(){ }

	}
}
