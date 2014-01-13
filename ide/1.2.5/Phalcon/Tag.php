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

		protected static $_escaperService;

		protected static $_autoEscape;

		/**
		 * Sets the dependency injector container.
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 */
		public static function setDI($dependencyInjector){ }


		/**
		 * Internally gets the dependency injector
		 *
		 * @return \Phalcon\DiInterface
		 */
		public static function getDI(){ }


		/**
		 * Return a URL service from the default DI
		 *
		 * @return \Phalcon\Mvc\UrlInterface
		 */
		public static function getUrlService(){ }


		/**
		 * Returns an Escaper service from the default DI
		 *
		 * @return \Phalcon\EscaperInterface
		 */
		public static function getEscaperService(){ }


		/**
		 * Get current autoescape mode
		 *
		 * @return bool
		 */
		public static function getAutoescape(){ }


		/**
		 * Set autoescape mode in generated html
		 *
		 * @param boolean $autoescape
		 */
		public static function setAutoescape($autoescape){ }


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
		 * Assigns default values to generated tags by helpers
		 *
		 * <code>
		 * //Assigning "peter" to "name" component
		 * \Phalcon\Tag::setDefaults(array("name" => "peter"));
		 *
		 * //Later in the view
		 * echo \Phalcon\Tag::textField("name"); //Will have the value "peter" by default
		 * </code>
		 *
		 * @param array $values
		 */
		public static function setDefaults($values){ }


		/**
		 * Alias of \Phalcon\Tag::setDefault
		 *
		 * @param string $id
		 * @param string $value
		 */
		public static function displayTo($id, $value){ }


		/**
		 * Check if a helper has a default value set using \Phalcon\Tag::setDefault or value from $_POST
		 *
		 * @param string $name
		 * @return boolean
		 */
		public static function hasValue($name){ }


		/**
		 * Every helper calls this function to check whether a component has a predefined
		 * value using \Phalcon\Tag::setDefault or value from $_POST
		 *
		 * @param string $name
		 * @param array $params
		 * @return mixed
		 */
		public static function getValue($name, $params=null){ }


		/**
		 * Resets the request and internal values to avoid those fields will have any default value
		 */
		public static function resetInput(){ }


		/**
		 * Builds a HTML A tag using framework conventions
		 *
		 *<code>
		 *	echo \Phalcon\Tag::linkTo('signup/register', 'Register Here!');
		 *	echo \Phalcon\Tag::linkTo(array('signup/register', 'Register Here!'));
		 *	echo \Phalcon\Tag::linkTo(array('signup/register', 'Register Here!', 'class' => 'btn-primary'));
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
		 * Builds INPUT tags that implements the checked attribute
		 *
		 * @param   string $type
		 * @param array $parameters
		 * @return string
		 */
		protected static function _inputFieldChecked(){ }


		/**
		 * Builds a HTML input[type="text"] tag
		 *
		 * <code>
		 *	echo \Phalcon\Tag::textField(array("name", "size" => 30));
		 * </code>
		 *
		 * @param array $parameters
		 * @return string
		 */
		public static function textField($parameters){ }


		/**
		 * Builds a HTML input[type="number"] tag
		 *
		 * <code>
		 *	echo \Phalcon\Tag::numericField(array("price", "min" => "1", "max" => "5"));
		 * </code>
		 *
		 * @param array $parameters
		 * @return string
		 */
		public static function numericField($parameters){ }


		/**
		 * Builds a HTML input[type="email"] tag
		 *
		 * <code>
		 *	echo \Phalcon\Tag::emailField("email");
		 * </code>
		 *
		 * @param array $parameters
		 * @return string
		 */
		public static function emailField($parameters){ }


		/**
		 * Builds a HTML input[type="date"] tag
		 *
		 * <code>
		 *	echo \Phalcon\Tag::dateField(array("born", "value" => "14-12-1980"))
		 * </code>
		 *
		 * @param array $parameters
		 * @return string
		 */
		public static function dateField($parameters){ }


		/**
		 * Builds a HTML input[type="password"] tag
		 *
		 *<code>
		 * echo \Phalcon\Tag::passwordField(array("name", "size" => 30));
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
		 * echo \Phalcon\Tag::hiddenField(array("name", "value" => "mike"));
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
		 * echo \Phalcon\Tag::fileField("file");
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
		 * echo \Phalcon\Tag::checkField(array("terms", "value" => "Y"));
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
		 * echo \Phalcon\Tag::radioField(array("wheather", "value" => "hot"))
		 *</code>
		 *
		 * Volt syntax:
		 *<code>
		 * {{ radio_field('Save') }}
		 *</code>
		 *
		 * @param array $parameters
		 * @return string
		 */
		public static function radioField($parameters){ }


		/**
		 * Builds a HTML input[type="image"] tag
		 *
		 *<code>
		 * echo \Phalcon\Tag::imageInput(array("src" => "/img/button.png"));
		 *</code>
		 *
		 * Volt syntax:
		 *<code>
		 * {{ image_input('src': '/img/button.png') }}
		 *</code>
		 *
		 * @param array $parameters
		 * @return string
		 */
		public static function imageInput($parameters){ }


		/**
		 * Builds a HTML input[type="submit"] tag
		 *
		 *<code>
		 * echo \Phalcon\Tag::submitButton("Save")
		 *</code>
		 *
		 * Volt syntax:
		 *<code>
		 * {{ submit_button('Save') }}
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
		 * Builds a HTML SELECT tag using a \Phalcon\Mvc\Model resultset as options
		 *
		 *<code>
		 *	echo \Phalcon\Tag::select(array(
		 *		"robotId",
		 *		Robots::find("type = 'mechanical'"),
		 *		"using" => array("id", "name")
		 * 	));
		 *</code>
		 *
		 * Volt syntax:
		 *<code>
		 * {{ select("robotId", robots, "using": ["id", "name"]) }}
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
		 * Volt syntax:
		 *<code>
		 * {{ text_area("comments", "cols": 10, "rows": 4) }}
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
		 * <code>
		 * 	echo \Phalcon\Tag::getTitle();
		 * </code>
		 *
		 * <code>
		 * 	{{ get_title() }}
		 * </code>
		 *
		 * @return string
		 */
		public static function getTitle($tags=null){ }


		/**
		 * Builds a LINK[rel="stylesheet"] tag
		 *
		 * <code>
		 * 	echo \Phalcon\Tag::stylesheetLink("http://fonts.googleapis.com/css?family=Rosario", false);
		 * 	echo \Phalcon\Tag::stylesheetLink("css/style.css");
		 * </code>
		 *
		 * Volt Syntax:
		 *<code>
		 * 	{{ stylesheet_link("http://fonts.googleapis.com/css?family=Rosario", false) }}
		 * 	{{ stylesheet_link("css/style.css") }}
		 *</code>
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
		 * 	echo \Phalcon\Tag::javascriptInclude("http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false);
		 * 	echo \Phalcon\Tag::javascriptInclude("javascript/jquery.js");
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
		 * <code>
		 * 	echo \Phalcon\Tag::image("img/bg.png");
		 * 	echo \Phalcon\Tag::image(array("img/photo.jpg", "alt" => "Some Photo"));
		 * </code>
		 *
		 * Volt Syntax:
		 * <code>
		 * 	{{ image("img/bg.png") }}
		 * 	{{ image("img/photo.jpg", "alt": "Some Photo") }}
		 * 	{{ image("http://static.mywebsite.com/img/bg.png", false) }}
		 * </code>
		 *
		 * @param  array $parameters
		 * @param  boolean $local
		 * @return string
		 */
		public static function image($parameters=null, $local=null){ }


		/**
		 * Converts texts into URL-friendly titles
		 *
		 *<code>
		 * echo \Phalcon\Tag::friendlyTitle('These are big important news', '-')
		 *</code>
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


		/**
		 * Builds a HTML tag
		 *
		 *<code>
		 *	echo \Phalcon\Tag::tagHtml($name, $parameters, $selfClose, $onlyStart, $eol);
		 *</code>
		 *
		 * @param string $tagName
		 * @param array $parameters
		 * @param boolean $selfClose
		 * @param boolean $onlyStart
		 * @param boolean $useEol
		 * @return string
		 */
		public static function tagHtml($tagName, $parameters=null, $selfClose=null, $onlyStart=null, $useEol=null){ }


		/**
		 * Builds a HTML tag closing tag
		 *
		 *<code>
		 *	echo \Phalcon\Tag::tagHtmlClose('script', true)
		 *</code>
		 *
		 * @param string $tagName
		 * @param boolean $useEol
		 * @return string
		 */
		public static function tagHtmlClose($tagName, $useEol=null){ }

	}
}
