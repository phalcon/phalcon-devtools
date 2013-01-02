<?php 

namespace Phalcon {

	/**
	 * Phalcon\Tag
	 *
	 * Phalcon\Tag is designed to simplify building of HTML tags.
	 * It provides a set of helpers to generate HTML in a dynamic way.
	 * This component is an abstract class that you can extend to add more helpers.
	 */
	
	class Tag {

		const HTML32 = 1;

		const HTML401_STRICT = 2;

		const HTML401_TRANSITIONAL = 3;

		const HTML401_FRAMESET = 4;

		const HTML5 = 5;

		const XHTML10_STRICT = 6;

		const XHTML10_TRANSITIONAL = 7;

		const XHTML10_FRAMESET = 8;

		const XHTML11 = 9;

		const XHTML20 = 10;

		const XHTML5 = 11;

		protected static $_displayValues;

		protected static $_documentTitle;

		protected static $_documentType;

		protected static $_dependencyInjector;

		protected static $_urlService;

		protected static $_dispatcherService;

		/**
		 * Sets the dependency injector container.
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 */
		public static function setDI($dependencyInjector){ }


		/**
		 * Internally gets the request dispatcher
		 *
		 * @return \Phalcon\DiInterface
		 */
		public static function getDI(){ }


		/**
		 * Return a URL service from the DI
		 *
		 * @return \Phalcon\Mvc\UrlInterface
		 */
		public static function getUrlService(){ }


		/**
		 * Returns a Dispatcher service from the DI
		 *
		 * @return \Phalcon\Mvc\DispatcherInterface
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
		 * @param array|string $parameters
		 * @param   string $text
		 * @return string
		 */
		public static function linkTo($parameters, $text=null){ }


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
		 * @param array $parameters
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
		 * @param   array $data
		 * @return string
		 */
		public static function selectStatic($parameters, $data=null){ }


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
		 * @param array $parameters
		 * @param   array $data
		 * @return string
		 */
		public static function select($parameters, $data=null){ }


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
		 * Volt syntax:
		 * <code>
		 * {{ form("posts/save") }}
		 * {{ form("posts/save", "method": "post") }}
		 * </code>
		 *
		 * @param array $parameters
		 * @return string
		 */
		public static function form($parameters=null){ }


		/**
		 * Builds a HTML close FORM tag
		 *
		 * @return string
		 */
		public static function endForm(){ }


		/**
		 * Set the title of view content
		 *
		 *<code>
		 * \Phalcon\Tag::setTitle('Welcome to my Page');
		 *</code>
		 *
		 * @param string $title
		 */
		public static function setTitle($title){ }


		/**
		 * Appends a text to current document title
		 *
		 * @param string $title
		 */
		public static function appendTitle($title){ }


		/**
		 * Prepends a text to current document title
		 *
		 * @param string $title
		 */
		public static function prependTitle($title){ }


		/**
		 * Gets the current document title
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
		public static function stylesheetLink($parameters=null, $local=null){ }


		/**
		 * Builds a SCRIPT[type="javascript"] tag
		 *
		 * <code>
		 * echo \Phalcon\Tag::javascriptInclude("http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false);
		 * echo \Phalcon\Tag::javascriptInclude("javascript/jquery.js");
		 * </code>
		 *
		 * Volt syntax:
		 * <code>
		 * {{ javascript_include("http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false) }}
		 * {{ javascript_include("javascript/jquery.js") }}
		 * </code>
		 *
		 * @param array $parameters
		 * @param   boolean $local
		 * @return string
		 */
		public static function javascriptInclude($parameters=null, $local=null){ }


		/**
		 * Builds HTML IMG tags
		 *
		 * @param  array $parameters
		 * @return string
		 */
		public static function image($parameters=null){ }


		/**
		 * Converts texts into URL-friendly titles
		 *
		 * @param string $text
		 * @param string $separator
		 * @param boolean $lowercase
		 * @return text
		 */
		public static function friendlyTitle($text, $separator=null, $lowercase=null){ }


		/**
		 * Set the document type of content
		 *
		 * @param string $doctype
		 */
		public static function setDocType($doctype){ }


		/**
		 * Get the document type declaration of content
		 *
		 * @return string
		 */
		public static function getDocType(){ }

	}
}
