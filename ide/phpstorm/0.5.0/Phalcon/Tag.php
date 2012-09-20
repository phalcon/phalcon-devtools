<?php 

namespace Phalcon {

	/**
	 * Phalcon\Tag
	 *
	 * Phalcon\Tag is designed to simplify building of HTML tags.
	 * It provides a set of helpers to generate HTML in a dynamic way.
	 * This component is an abstract class that you can extend to add more helpers.
	 */
	
	abstract class Tag {

		protected static $_displayValues;

		protected static $_documentTitle;

		protected static $_dependencyInjector;

		/**
		 * Sets the dependency injector container.
		 *
		 * @param \Phalcon\DI $dispatcher
		 */
		public static function setDI($dependencyInjector){ }


		/**
		 * Internally gets the request dispatcher
		 *
		 * @return \Phalcon\DI
		 */
		public static function getDI(){ }


		/**
		 * Return a URL service from the DI
		 *
		 * @return \Phalcon\Mvc\Url
		 */
		public static function getUrlService(){ }


		/**
		 * Returns a Dispatcher service from the DI
		 *
		 * @return \Phalcon\Mvc\Dispatcher
		 */
		public static function getDispatcherService(){ }


		/**
		 * Assigns default values to generated tags by helpers
		 *
		 * <code>
		 * //Assigning "peter" to "name" component
		 * \Phalcon\Tag::setDefault("name", "peter");
		 *
		 * //Later in the view
		 * echo \Phalcon\Tag::textField("name"); //Will have the value "peter" by default
		 * </code>
		 *
		 * @param string $id
		 * @param string $value
		 */
		public static function setDefault($id, $value){ }


		/**
		 * Alias of \Phalcon\Tag::setDefault
		 *
		 * @param string $id
		 * @param string $value
		 */
		public static function displayTo($id, $value){ }


		/**
		 * Every helper calls this function to check whether a component has a predefined
		 * value using \Phalcon\Tag::setDefault or value from $_POST
		 *
		 * @param string $name
		 * @return mixed
		 */
		public static function getValue($name){ }


		/**
		 * Resets the request and internal values to avoid those fields will have any default value
		 */
		public static function resetInput(){ }


		/**
		 * Builds a HTML A tag using framework conventions
		 *
		 *<code>
		 *	echo \Phalcon\Tag::linkTo('signup/register', 'Register Here!');
		 *</code>
		 *
		 * @param array $parameters
		 * @return string
		 */
		public static function linkTo($parameters, $text){ }


		/**
		 * Builds generic INPUT tags
		 *
		 * @param   string $type
		 * @param array $parameters
		 * @param 	boolean $asValue
		 * @return string
		 */
		protected static function _inputField(){ }


		/**
		 * Builds a HTML input[type="text"] tag
		 *
		 * <code>
		 *	echo \Phalcon\Tag::textField(array("name", "size" => 30))
		 * </code>
		 *
		 * @param array $parameters
		 * @return string
		 */
		public static function textField($parameters){ }


		/**
		 * Builds a HTML input[type="password"] tag
		 *
		 *<code>
		 * echo \Phalcon\Tag::passwordField(array("name", "size" => 30))
		 *</code>
		 *
		 * @param array $parameters
		 * @return string
		 */
		public static function passwordField($parameters){ }


		/**
		 * Builds a HTML input[type="hidden"] tag
		 *
		 *<code>
		 * echo \Phalcon\Tag::hiddenField(array("name", "value" => "mike"))
		 *</code>
		 *
		 * @param array $parameters
		 * @return string
		 */
		public static function hiddenField($parameters){ }


		/**
		 * Builds a HTML input[type="file"] tag
		 *
		 *<code>
		 * echo \Phalcon\Tag::fileField("file")
		 *</code>
		 *
		 * @param array $parameters
		 * @return string
		 */
		public static function fileField($parameters){ }


		/**
		 * Builds a HTML input[type="check"] tag
		 *
		 *<code>
		 * echo \Phalcon\Tag::checkField(array("name", "size" => 30))
		 *</code>
		 *
		 * @param array $parameters
		 * @return string
		 */
		public static function checkField($parameters){ }


		/**
		 * Builds a HTML input[type="radio"] tag
		 *
		 *<code>
		 * echo \Phalcon\Tag::radioField(array("name", "size" => 30))
		 *</code>
		 *
		 * @param array $parameters
		 * @return string
		 */
		public static function radioField($parameters){ }


		/**
		 * Builds a HTML input[type="submit"] tag
		 *
		 *<code>
		 * echo \Phalcon\Tag::submitButton("Save")
		 *</code>
		 *
		 * @param array $params
		 * @return string
		 */
		public static function submitButton($parameters){ }


		/**
		 * Builds a HTML SELECT tag using a PHP array for options
		 *
		 *<code>
		 *	echo \Phalcon\Tag::selectStatic("status", array("A" => "Active", "I" => "Inactive"))
		 *</code>
		 *
		 * @param array $parameters
		 * @return string
		 */
		public static function selectStatic($parameters, $data){ }


		/**
		 * Builds a HTML SELECT tag using a \Phalcon_Model resultset as options
		 *
		 *<code>
		 *	echo \Phalcon\Tag::selectStatic(array(
		 *		"robotId",
		 *		Robots::find("type = 'mechanical'"),
		 *		"using" => array("id", "name")
		 * 	));
		 *</code>
		 *
		 * @param array $params
		 * @return string
		 */
		public static function select($parameters, $data){ }


		/**
		 * Builds a HTML TEXTAREA tag
		 *
		 *<code>
		 * echo \Phalcon\Tag::textArea(array("comments", "cols" => 10, "rows" => 4))
		 *</code>
		 *
		 * @param array $parameters
		 * @return string
		 */
		public static function textArea($parameters){ }


		/**
		 * Builds a HTML FORM tag
		 *
		 * <code>
		 * echo \Phalcon\Tag::form("posts/save");
		 * echo \Phalcon\Tag::form(array("posts/save", "method" => "post"));
		 * </code>
		 *
		 * @param array $parameters
		 * @return string
		 */
		public static function form($parameters){ }


		/**
		 * Builds a HTML close FORM tag
		 *
		 * @return string
		 */
		public static function endForm(){ }


		/**
		 * Set the title of view content
		 *
		 * @param string $title
		 */
		public static function setTitle($title){ }


		/**
		 * Add to title of view content
		 *
		 * @param string $title
		 */
		public static function appendTitle($title){ }


		/**
		 * Add before the title of view content
		 *
		 * @param string $title
		 */
		public static function prependTitle($title){ }


		/**
		 * Get the title of view content
		 *
		 * @return string
		 */
		public static function getTitle(){ }


		/**
		 * Builds a LINK[rel="stylesheet"] tag
		 *
		 * <code>
		 * echo \Phalcon\Tag::stylesheetLink("http://fonts.googleapis.com/css?family=Rosario", false);
		 * echo \Phalcon\Tag::stylesheetLink("css/style.css");
		 * </code>
		 *
		 * @param array $parameters
		 * @param   boolean $local
		 * @return string
		 */
		public static function stylesheetLink($parameters, $local){ }


		/**
		 * Builds a SCRIPT[type="javascript"] tag
		 *
		 * <code>
		 * echo \Phalcon\Tag::javascriptInclude("http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false);
		 * echo \Phalcon\Tag::javascriptInclude("javascript/jquery.js");
		 * </code>
		 *
		 * @param array $parameters
		 * @param   boolean $local
		 * @return string
		 */
		public static function javascriptInclude($parameters, $local){ }


		/**
		 * Builds HTML IMG tags
		 *
		 * @param  array $parameters
		 * @return string
		 */
		public static function image($parameters){ }

	}
}
