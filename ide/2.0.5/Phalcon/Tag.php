<?php

namespace Phalcon;

use Phalcon\Tag\Select;
use Phalcon\Tag\Exception;
use Phalcon\Mvc\UrlInterface;


class Tag
{

	/**
	 * Pre-assigned values for components
	 */
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

	/**
	 * HTML document title
	 */
	protected static $_documentTitle = null;

	protected static $_documentTitleSeparator = null;

	protected static $_documentType = 11;

	/**
	 * Framework Dispatcher
	 */
	protected static $_dependencyInjector;

	protected static $_urlService = null;

	protected static $_dispatcherService = null;

	protected static $_escaperService = null;

	protected static $_autoEscape = true;



	/**
	 * Obtains the 'escaper' service if required
	 *
	 * @param array $params
	 * 
	 * @return mixed
	 */
	public static function getEscaper(array $params) {}

	/**
	 * Renders parameters keeping order in their HTML attributes
	 * 
	 * @param string $code
	 * @param array $attributes
	 *
	 * @return string
	 */
	public static function renderAttributes($code, array $attributes) {}

	/**
	 * Sets the dependency injector container.
	 * 
	 * @param DiInterface $dependencyInjector
	 *
	 * @return void
	 */
	public static function setDI(DiInterface $dependencyInjector) {}

	/**
	 * Internally gets the request dispatcher
	 *
	 * @return DiInterface
	 */
	public static function getDI() {}

	/**
	 * Returns a URL service from the default DI
	 *
	 * @return UrlInterface
	 */
	public static function getUrlService() {}

	/**
	 * Returns an Escaper service from the default DI
	 *
	 * @return EscaperInterface
	 */
	public static function getEscaperService() {}

	/**
	 * Set autoescape mode in generated html
	 * 
	 * @param boolean $autoescape
	 *
	 * @return void
	 */
	public static function setAutoescape($autoescape) {}

	/**
	 * Assigns default values to generated tags by helpers
	 *
	 * <code>
	 * //Assigning "peter" to "name" component
	 * Phalcon\Tag::setDefault("name", "peter");
	 *
	 * //Later in the view
	 * echo Phalcon\Tag::textField("name"); //Will have the value "peter" by default
	 * </code>
	 * 
	 * @param string $id
	 * @param string $value
	 *
	 *
	 * @return void
	 */
	public static function setDefault($id, $value) {}

	/**
	 * Assigns default values to generated tags by helpers
	 *
	 * <code>
	 * //Assigning "peter" to "name" component
	 * Phalcon\Tag::setDefaults(array("name" => "peter"));
	 *
	 * //Later in the view
	 * echo Phalcon\Tag::textField("name"); //Will have the value "peter" by default
	 * </code>
	 * 
	 * @param array $values
	 * @param boolean $merge
	 *
	 * @return void
	 */
	public static function setDefaults(array $values, $merge=false) {}

	/**
	 * Alias of Phalcon\Tag::setDefault
	 * 
	 * @param string $id
	 * @param string $value
	 *
	 *
	 * @return mixed
	 */
	public static function displayTo($id, $value) {}

	/**
	 * Check if a helper has a default value set using Phalcon\Tag::setDefault or value from _POST
	 *
	 * @param mixed $name
	 * 
	 * @return boolean
	 */
	public static function hasValue($name) {}

	/**
		 * Check if there is a predefined or a POST value for it
	 * 
	 * @param mixed $name
	 * @param $params
		 *
	 * @return mixed
	 */
	public static function getValue($name, $params=null) {}

	/**
			 * Check if there is a predefined value for it
			 *
	 * @return void
	 */
	public static function resetInput() {}

	/**
	 * Builds a HTML A tag using framework conventions
	 *
	 *<code>
	 *	echo Phalcon\Tag::linkTo("signup/register", "Register Here!");
	 *	echo Phalcon\Tag::linkTo(array("signup/register", "Register Here!"));
	 *	echo Phalcon\Tag::linkTo(array("signup/register", "Register Here!", "class" => "btn-primary"));
	 *	echo Phalcon\Tag::linkTo("http://phalconphp.com/", "Phalcon", FALSE);
	 *	echo Phalcon\Tag::linkTo(array("http://phalconphp.com/", "Phalcon Home", FALSE));
	 *	echo Phalcon\Tag::linkTo(array("http://phalconphp.com/", "Phalcon Home", "local" =>FALSE));
	 *</code>
	 *
	 * @param array|string $parameters
	 * @param string $text
	 * @param boolean $local
	 * 
	 * @return string
	 */
	public static function linkTo($parameters, $text=null, $local=true) {}

	/**
	 * Builds generic INPUT tags
	 *
	 * @param string $type
	 * @param array $parameters
	 * @param boolean $asValue
	 * 
	 * @return string
	 */
	static protected final function _inputField($type, $parameters, $asValue=false) {}

	/**
			 * Automatically assign the id if the name is not an array
	 * 
	 * @param string $type
	 * @param mixed $parameters
			 *
	 * @return string
	 */
	static protected final function _inputFieldChecked($type, $parameters) {}

	/**
		* Automatically assign the id if the name is not an array
	 * 
	 * @param mixed $parameters
		*
	 * @return string
	 */
	public static function colorField($parameters) {}

	/**
	 * Builds a HTML input[type="text"] tag
	 *
	 * <code>
	 *	echo Phalcon\Tag::textField(array("name", "size" => 30));
	 * </code>
	 *
	 * @param mixed $parameters
	 * 
	 * @return string
	 */
	public static function textField($parameters) {}

	/**
	 * Builds a HTML input[type="number"] tag
	 *
	 * <code>
	 *	echo Phalcon\Tag::numericField(array("price", "min" => "1", "max" => "5"));
	 * </code>
	 *
	 * @param mixed $parameters
	 * 
	 * @return string
	 */
	public static function numericField($parameters) {}

	/**
	* Builds a HTML input[type="range"] tag
	*
	 * @param mixed $parameters
	 * 
	* @return string
	 */
	public static function rangeField($parameters) {}

	/**
	 * Builds a HTML input[type="email"] tag
	 *
	 * <code>
	 *	echo Phalcon\Tag::emailField("email");
	 * </code>
	 *
	 * @param mixed $parameters
	 * 
	 * @return string
	 */
	public static function emailField($parameters) {}

	/**
	 * Builds a HTML input[type="date"] tag
	 *
	 * <code>
	 *	echo Phalcon\Tag::dateField(array("born", "value" => "14-12-1980"))
	 * </code>
	 *
	 * @param mixed $parameters
	 * 
	 * @return string
	 */
	public static function dateField($parameters) {}

	/**
	* Builds a HTML input[type="datetime"] tag
	*
	 * @param mixed $parameters
	 * 
	* @return string
	 */
	public static function dateTimeField($parameters) {}

	/**
	* Builds a HTML input[type="datetime-local"] tag
	*
	 * @param mixed $parameters
	 * 
	* @return string
	 */
	public static function dateTimeLocalField($parameters) {}

	/**
	 * Builds a HTML input[type="month"] tag
	 *
	 * @param mixed $parameters
	 * 
	 * @return string
	 */
	public static function monthField($parameters) {}

	/**
	 * Builds a HTML input[type="time"] tag
	 *
	 * @param mixed $parameters
	 * 
	 * @return string
	 */
	public static function timeField($parameters) {}

	/**
	 * Builds a HTML input[type="week"] tag
	 *
	 * @param mixed $parameters
	 * 
	 * @return string
	 */
	public static function weekField($parameters) {}

	/**
	 * Builds a HTML input[type="password"] tag
	 *
	 *<code>
	 * echo Phalcon\Tag::passwordField(array("name", "size" => 30));
	 *</code>
	 *
	 * @param mixed $parameters
	 * 
	 * @return string
	 */
	public static function passwordField($parameters) {}

	/**
	 * Builds a HTML input[type="hidden"] tag
	 *
	 *<code>
	 * echo Phalcon\Tag::hiddenField(array("name", "value" => "mike"));
	 *</code>
	 *
	 * @param mixed $parameters
	 * 
	 * @return string
	 */
	public static function hiddenField($parameters) {}

	/**
	 * Builds a HTML input[type="file"] tag
	 *
	 *<code>
	 * echo Phalcon\Tag::fileField("file");
	 *</code>
	 *
	 * @param mixed $parameters
	 * 
	 * @return string
	 */
	public static function fileField($parameters) {}

	/**
	 * Builds a HTML input[type="search"] tag
	 *
	 * @param mixed $parameters
	 * 
	 * @return string
	 */
	public static function searchField($parameters) {}

	/**
	* Builds a HTML input[type="tel"] tag
	*
	 * @param mixed $parameters
	 * 
	* @return string
	 */
	public static function telField($parameters) {}

	/**
	 * Builds a HTML input[type="url"] tag
	 *
	 * @param mixed $parameters
	 * 
	 * @return string
	 */
	public static function urlField($parameters) {}

	/**
	 * Builds a HTML input[type="check"] tag
	 *
	 *<code>
	 * echo Phalcon\Tag::checkField(array("terms", "value" => "Y"));
	 *</code>
	 *
	 * @param mixed $parameters
	 * 
	 * @return string
	 */
	public static function checkField($parameters) {}

	/**
	 * Builds a HTML input[type="radio"] tag
	 *
	 *<code>
	 * echo Phalcon\Tag::radioField(array("weather", "value" => "hot"))
	 *</code>
	 *
	 * Volt syntax:
	 *<code>
	 * {{ radio_field("Save") }}
	 *</code>
	 *
	 * @param mixed $parameters
	 * 
	 * @return string
	 */
	public static function radioField($parameters) {}

	/**
	 * Builds a HTML input[type="image"] tag
	 *
	 *<code>
	 * echo Phalcon\Tag::imageInput(array("src" => "/img/button.png"));
	 *</code>
	 *
	 * Volt syntax:
	 *<code>
	 * {{ image_input("src": "/img/button.png") }}
	 *</code>
	 *
	 * @param mixed $parameters
	 * 
	 * @return string
	 */
	public static function imageInput($parameters) {}

	/**
	 * Builds a HTML input[type="submit"] tag
	 *
	 *<code>
	 * echo Phalcon\Tag::submitButton("Save")
	 *</code>
	 *
	 * Volt syntax:
	 *<code>
	 * {{ submit_button("Save") }}
	 *</code>
	 *
	 * @param mixed $parameters
	 * 
	 * @return string
	 */
	public static function submitButton($parameters) {}

	/**
	 * Builds a HTML SELECT tag using a PHP array for options
	 *
	 *<code>
	 *	echo Phalcon\Tag::selectStatic("status", array("A" => "Active", "I" => "Inactive"))
	 *</code>
	 *
	 * @param array $parameters
	 * @param array $data
	 * 
	 * @return string
	 */
	public static function selectStatic($parameters, $data=null) {}

	/**
	 * Builds a HTML SELECT tag using a Phalcon\Mvc\Model resultset as options
	 *
	 *<code>
	 *	echo Phalcon\Tag::select(array(
	 *		"robotId",
	 *		Robots::find("type = "mechanical""),
	 *		"using" => array("id", "name")
	 * 	));
	 *</code>
	 *
	 * Volt syntax:
	 *<code>
	 * {{ select("robotId", robots, "using": ["id", "name"]) }}
	 *</code>
	 *
	 * @param mixed $parameters
	 * @param array $data
	 * 
	 * @return string
	 */
	public static function select($parameters, $data=null) {}

	/**
	 * Builds a HTML TEXTAREA tag
	 *
	 *<code>
	 * echo Phalcon\Tag::textArea(array("comments", "cols" => 10, "rows" => 4))
	 *</code>
	 *
	 * Volt syntax:
	 *<code>
	 * {{ text_area("comments", "cols": 10, "rows": 4) }}
	 *</code>
	 *
	 * @param mixed $parameters
	 * 
	 * @return string
	 */
	public static function textArea($parameters) {}

	/**
	 * Builds a HTML FORM tag
	 *
	 * <code>
	 * echo Phalcon\Tag::form("posts/save");
	 * echo Phalcon\Tag::form(array("posts/save", "method" => "post"));
	 * </code>
	 *
	 * Volt syntax:
	 * <code>
	 * {{ form("posts/save") }}
	 * {{ form("posts/save", "method": "post") }}
	 * </code>
	 *
	 * @param mixed $parameters
	 * 
	 * @return string
	 */
	public static function form($parameters) {}

	/**
		 * By default the method is POST
		 *
	 * @return string
	 */
	public static function endForm() {}

	/**
	 * Set the title of view content
	 *
	 *<code>
	 * Phalcon\Tag::setTitle("Welcome to my Page");
	 *</code>
	 * 
	 * @param string $title
	 *
	 * @return void
	 */
	public static function setTitle($title) {}

	/**
	 * Set the title separator of view content
	 *
	 *<code>
	 * Phalcon\Tag::setTitleSeparator("-");
	 *</code>
	 * 
	 * @param string $titleSeparator
	 *
	 * @return void
	 */
	public static function setTitleSeparator($titleSeparator) {}

	/**
	 * Appends a text to current document title
	 * 
	 * @param string $title
	 *
	 * @return void
	 */
	public static function appendTitle($title) {}

	/**
	 * Prepends a text to current document title
	 * 
	 * @param string $title
	 *
	 * @return void
	 */
	public static function prependTitle($title) {}

	/**
	 * Gets the current document title
	 *
	 * <code>
	 * 	echo Phalcon\Tag::getTitle();
	 * </code>
	 *
	 * <code>
	 * 	{{ get_title() }}
	 * </code>
	 * 
	 * @param boolean $tags
	 *
	 * @return string
	 */
	public static function getTitle($tags=true) {}

	/**
	 * Gets the current document title separator
	 *
	 * <code>
	 *         echo Phalcon\Tag::getTitleSeparator();
	 * </code>
	 *
	 * <code>
	 *         {{ get_title_separator() }}
	 * </code>
	 *
	 * @return string
	 */
	public static function getTitleSeparator() {}

	/**
	 * Builds a LINK[rel="stylesheet"] tag
	 *
	 * <code>
	 * 	echo Phalcon\Tag::stylesheetLink("http://fonts.googleapis.com/css?family=Rosario", false);
	 * 	echo Phalcon\Tag::stylesheetLink("css/style.css");
	 * </code>
	 *
	 * Volt Syntax:
	 *<code>
	 * 	{{ stylesheet_link("http://fonts.googleapis.com/css?family=Rosario", false) }}
	 * 	{{ stylesheet_link("css/style.css") }}
	 *</code>
	 *
	 * @param mixed $parameters
	 * @param boolean $local
	 * 
	 * @return string
	 */
	public static function stylesheetLink($parameters=null, $local=true) {}

	/**
		 * URLs are generated through the "url" service
	 * 
	 * @param mixed $parameters
	 * @param boolean $local
		 *
	 * @return string
	 */
	public static function javascriptInclude($parameters=null, $local=true) {}

	/**
		 * URLs are generated through the "url" service
	 * 
	 * @param mixed $parameters
	 * @param boolean $local
		 *
	 * @return string
	 */
	public static function image($parameters=null, $local=true) {}

	/**
		 * Use the "url" service if the URI is local
	 * 
	 * @param string $text
	 * @param string $separator
	 * @param boolean $lowercase
	 * @param $replace
		 *
	 * @return string
	 */
	public static function friendlyTitle($text, $separator="-", $lowercase=true, $replace=null) {}

	/**
			 * Save the old locale and set the new locale to UTF-8
	 * 
	 * @param int $doctype
			 *
	 * @return void
	 */
	public static function setDocType($doctype) {}

	/**
	 * Get the document type declaration of content
	 *
	 * @return string
	 */
	public static function getDocType() {}

	/**
	 * Builds a HTML tag
	 *
	 *<code>
	 *        echo Phalcon\Tag::tagHtml(name, parameters, selfClose, onlyStart, eol);
	 *</code>
	 *
	 * @param string $tagName
	 * @param mixed $parameters
	 * @param boolean $selfClose
	 * @param boolean $onlyStart
	 * @param boolean $useEol
	 * 
	 * @return string
	 */
	public static function tagHtml($tagName, $parameters=null, $selfClose=false, $onlyStart=false, $useEol=false) {}

	/**
		 * Check if Doctype is XHTML
	 * 
	 * @param string $tagName
	 * @param boolean $useEol
		 *
	 * @return string
	 */
	public static function tagHtmlClose($tagName, $useEol=false) {}

}
