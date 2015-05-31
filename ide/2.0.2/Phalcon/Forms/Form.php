<?php 

namespace Phalcon\Forms {

	/**
	 * Phalcon\Forms\Form
	 *
	 * This component allows to build forms using an object-oriented interface
	 */
	
	class Form extends \Phalcon\Di\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface, \Countable, \Iterator, \Traversable {

		protected $_position;

		protected $_entity;

		protected $_options;

		protected $_data;

		protected $_elements;

		protected $_elementsIndexed;

		protected $_messages;

		protected $_action;

		protected $_validation;

		public function setValidation($validation){ }


		public function getValidation(){ }


		/**
		 * \Phalcon\Forms\Form constructor
		 *
		 * @param object entity
		 * @param array userOptions
		 */
		public function __construct($entity=null, $userOptions=null){ }


		/**
		 * Sets the form's action
		 *
		 * @param string action
		 * @return \Phalcon\Forms\Form
		 */
		public function setAction($action){ }


		/**
		 * Returns the form's action
		 */
		public function getAction(){ }


		/**
		 * Sets an option for the form
		 *
		 * @param string option
		 * @param mixed value
		 * @return \Phalcon\Forms\Form
		 */
		public function setUserOption($option, $value){ }


		/**
		 * Returns the value of an option if present
		 *
		 * @param string option
		 * @param mixed defaultValue
		 * @return mixed
		 */
		public function getUserOption($option, $defaultValue=null){ }


		/**
		 * Sets options for the element
		 */
		public function setUserOptions($options){ }


		/**
		 * Returns the options for the element
		 *
		 * @return array
		 */
		public function getUserOptions(){ }


		/**
		 * Sets the entity related to the model
		 *
		 * @param object entity
		 * @return \Phalcon\Forms\Form
		 */
		public function setEntity($entity){ }


		/**
		 * Returns the entity related to the model
		 *
		 * @return object
		 */
		public function getEntity(){ }


		/**
		 * Returns the form elements added to the form
		 */
		public function getElements(){ }


		/**
		 * Binds data to the entity
		 *
		 * @param array data
		 * @param object entity
		 * @param array whitelist
		 * @return \Phalcon\Forms\Form
		 */
		public function bind($data, $entity, $whitelist=null){ }


		/**
		 * Validates the form
		 *
		 * @param array data
		 * @param object entity
		 * @return boolean
		 */
		public function isValid($data=null, $entity=null){ }


		/**
		 * Returns the messages generated in the validation
		 */
		public function getMessages($byItemName=null){ }


		/**
		 * Returns the messages generated for a specific element
		 *
		 * @param string name
		 * @return \Phalcon\Validation\Message\Group
		 */
		public function getMessagesFor($name){ }


		/**
		 * Check if messages were generated for a specific element
		 *
		 * @param string name
		 * @return boolean
		 */
		public function hasMessagesFor($name){ }


		/**
		 * Adds an element to the form
		 *
		 * @param \Phalcon\Forms\ElementInterface element
		 * @param string $postion
		 * @param bool $type If $type is TRUE, the element wile add before $postion, else is after
		 * @return \Phalcon\Forms\Form
		 */
		public function add(\Phalcon\Forms\ElementInterface $element, $postion=null, $type=null){ }


		/**
		 * Renders a specific item in the form
		 *
		 * @param string name
		 * @param array attributes
		 * @return string
		 */
		public function render($name, $attributes=null){ }


		/**
		 * Returns an element added to the form by its name
		 */
		public function get($name){ }


		/**
		 * Generate the label of a element added to the form including HTML
		 */
		public function label($name, $attributes=null){ }


		/**
		 * Returns a label for an element
		 */
		public function getLabel($name){ }


		/**
		 * Gets a value from the internal related entity or from the default value
		 *
		 * @param string name
		 * @return mixed
		 */
		public function getValue($name){ }


		/**
		 * Check if the form contains an element
		 */
		public function has($name){ }


		/**
		 * Removes an element from the form
		 */
		public function remove($name){ }


		/**
		 * Clears every element in the form to its default value
		 *
		 * @param array fields
		 * @return \Phalcon\Forms\Form
		 */
		public function clear($fields=null){ }


		/**
		 * Returns the number of elements in the form
		 */
		public function count(){ }


		/**
		 * Rewinds the internal iterator
		 */
		public function rewind(){ }


		/**
		 * Returns the current element in the iterator
		 */
		public function current(){ }


		/**
		 * Returns the current position/key in the iterator
		 */
		public function key(){ }


		/**
		 * Moves the internal iteration pointer to the next position
		 */
		public function next(){ }


		/**
		 * Check if the current element in the iterator is valid
		 */
		public function valid(){ }

	}
}
