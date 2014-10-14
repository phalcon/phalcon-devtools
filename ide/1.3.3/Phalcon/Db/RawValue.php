<?php 

namespace Phalcon\Db {

	/**
	 * Phalcon\Db\RawValue
	 *
	 * This class allows to insert/update raw data without quoting or formating.
	 *
	 *The next example shows how to use the MySQL now() function as a field value.
	 *
	 *<code>
	 *	$subscriber = new Subscribers();
	 *	$subscriber->email = 'andres@phalconphp.com';
	 *	$subscriber->created_at = new Phalcon\Db\RawValue('now()');
	 *	$subscriber->save();
	 *</code>
	 */
	
	class RawValue {

		protected $_value;

		/**
		 * \Phalcon\Db\RawValue constructor
		 *
		 * @param string $value
		 */
		public function __construct($value){ }


		/**
		 * Returns internal raw value without quoting or formating
		 *
		 * @return string
		 */
		public function getValue(){ }


		/**
		 * Magic method __toString returns raw value without quoting or formating
		 */
		public function __toString(){ }

	}
}
