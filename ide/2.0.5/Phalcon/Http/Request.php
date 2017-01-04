<?php

namespace Phalcon\Http;

use Phalcon\DiInterface;
use Phalcon\FilterInterface;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Http\Request\Exception;
use Phalcon\Http\Request\File;


class Request implements RequestInterface, InjectionAwareInterface
{

	protected $_dependencyInjector;

	protected $_rawBody;

	protected $_filter;

	protected $_putCache;



	/**
	 * Sets the dependency injector
	 * 
	 * @param DiInterface $dependencyInjector
	 *
	 * @return void
	 */
	public function setDI(DiInterface $dependencyInjector) {}

	/**
	 * Returns the internal dependency injector
	 *
	 * @return DiInterface
	 */
	public function getDI() {}

	/**
	 * Gets a variable from the $_REQUEST superglobal applying filters if needed.
	 * If no parameters are given the $_REQUEST superglobal is returned
	 *
	 *<code>
	 *	//Returns value from $_REQUEST["user_email"] without sanitizing
	 *	$userEmail = $request->get("user_email");
	 *
	 *	//Returns value from $_REQUEST["user_email"] with sanitizing
	 *	$userEmail = $request->get("user_email", "email");
	 *</code>
	 * 
	 * @param string $name
	 * @param mixed $filters
	 * @param mixed $defaultValue
	 * @param boolean $notAllowEmpty
	 * @param boolean $noRecursive
	 *
	 * @return mixed
	 */
	public function get($name=null, $filters=null, $defaultValue=null, $notAllowEmpty=false, $noRecursive=false) {}

	/**
	 * Gets a variable from the $_POST superglobal applying filters if needed
	 * If no parameters are given the $_POST superglobal is returned
	 *
	 *<code>
	 *	//Returns value from $_POST["user_email"] without sanitizing
	 *	$userEmail = $request->getPost("user_email");
	 *
	 *	//Returns value from $_POST["user_email"] with sanitizing
	 *	$userEmail = $request->getPost("user_email", "email");
	 *</code>
	 * 
	 * @param string $name
	 * @param mixed $filters
	 * @param mixed $defaultValue
	 * @param boolean $notAllowEmpty
	 * @param boolean $noRecursive
	 *
	 * @return mixed
	 */
	public function getPost($name=null, $filters=null, $defaultValue=null, $notAllowEmpty=false, $noRecursive=false) {}

	/**
	 * Gets a variable from put request
	 *
	 *<code>
	 *	//Returns value from $_PUT["user_email"] without sanitizing
	 *	$userEmail = $request->getPut("user_email");
	 *
	 *	//Returns value from $_PUT["user_email"] with sanitizing
	 *	$userEmail = $request->getPut("user_email", "email");
	 *</code>
	 * 
	 * @param string $name
	 * @param mixed $filters
	 * @param mixed $defaultValue
	 * @param boolean $notAllowEmpty
	 * @param boolean $noRecursive
	 *
	 * @return mixed
	 */
	public function getPut($name=null, $filters=null, $defaultValue=null, $notAllowEmpty=false, $noRecursive=false) {}

	/**
	 * Gets variable from $_GET superglobal applying filters if needed
	 * If no parameters are given the $_GET superglobal is returned
	 *
	 *<code>
	 *	//Returns value from $_GET["id"] without sanitizing
	 *	$id = $request->getQuery("id");
	 *
	 *	//Returns value from $_GET["id"] with sanitizing
	 *	$id = $request->getQuery("id", "int");
	 *
	 *	//Returns value from $_GET["id"] with a default value
	 *	$id = $request->getQuery("id", null, 150);
	 *</code>
	 * 
	 * @param string $name
	 * @param mixed $filters
	 * @param mixed $defaultValue
	 * @param boolean $notAllowEmpty
	 * @param boolean $noRecursive
	 *
	 * @return mixed
	 */
	public function getQuery($name=null, $filters=null, $defaultValue=null, $notAllowEmpty=false, $noRecursive=false) {}

	/**
	 * Helper to get data from superglobals, applying filters if needed.
	 * If no parameters are given the superglobal is returned.
	 * 
	 * @param array $source
	 * @param string $name
	 * @param mixed $filters
	 * @param mixed $defaultValue
	 * @param boolean $notAllowEmpty
	 * @param boolean $noRecursive
	 *
	 * @return mixed
	 */
	protected final function getHelper(array $source, $name=null, $filters=null, $defaultValue=null, $notAllowEmpty=false, $noRecursive=false) {}

	/**
	 * Gets variable from $_SERVER superglobal
	 * 
	 * @param string $name
	 *
	 * @return mixed
	 */
	public function getServer($name) {}

	/**
	 * Checks whether $_REQUEST superglobal has certain index
	 * 
	 * @param string $name
	 *
	 * @return boolean
	 */
	public function has($name) {}

	/**
	 * Checks whether $_POST superglobal has certain index
	 * 
	 * @param string $name
	 *
	 * @return boolean
	 */
	public function hasPost($name) {}

	/**
	 * Checks whether the PUT data has certain index
	 * 
	 * @param string $name
	 *
	 * @return boolean
	 */
	public function hasPut($name) {}

	/**
	 * Checks whether $_GET superglobal has certain index
	 * 
	 * @param string $name
	 *
	 * @return boolean
	 */
	public function hasQuery($name) {}

	/**
	 * Checks whether $_SERVER superglobal has certain index
	 * 
	 * @param string $name
	 *
	 * @return boolean
	 */
	public final function hasServer($name) {}

	/**
	 * Gets HTTP header from request data
	 * 
	 * @param string $header
	 *
	 * @return string
	 */
	public final function getHeader($header) {}

	/**
	 * Gets HTTP schema (http/https)
	 *
	 * @return string
	 */
	public function getScheme() {}

	/**
	 * Checks whether request has been made using ajax
	 *
	 * @return boolean
	 */
	public function isAjax() {}

	/**
	 * Checks whether request has been made using SOAP
	 *
	 * @return boolean
	 */
	public function isSoapRequested() {}

	/**
	 * Checks whether request has been made using any secure layer
	 *
	 * @return boolean
	 */
	public function isSecureRequest() {}

	/**
	 * Gets HTTP raw request body
	 *
	 * @return string
	 */
	public function getRawBody() {}

	/**
			 * We need store the read raw body because it can't be read again
	 * 
	 * @param boolean $associative
			 *
	 * @return \stdClass|array|boolean
	 */
	public function getJsonRawBody($associative=false) {}

	/**
	 * Gets active server address IP
	 *
	 * @return string
	 */
	public function getServerAddress() {}

	/**
	 * Gets active server name
	 *
	 * @return string
	 */
	public function getServerName() {}

	/**
	 * Gets information about schema, host and port used by the request
	 *
	 * @return string
	 */
	public function getHttpHost() {}

	/**
		 * Get the server name from _SERVER['HTTP_HOST']
		 *
	 * @return string
	 */
	public final function getURI() {}

	/**
	 * Gets most possible client IPv4 Address. This method search in _SERVER['REMOTE_ADDR'] and optionally in _SERVER['HTTP_X_FORWARDED_FOR']
	 * 
	 * @param boolean $trustForwardedHeader
	 *
	 * @return string|boolean
	 */
	public function getClientAddress($trustForwardedHeader=false) {}

	/**
		 * Proxies uses this IP
		 *
	 * @return string
	 */
	public final function getMethod() {}

	/**
	 * Gets HTTP user agent used to made the request
	 *
	 * @return string
	 */
	public function getUserAgent() {}

	/**
	 * Checks if a method is a valid HTTP method
	 * 
	 * @param string $method
	 *
	 * @return boolean
	 */
	public function isValidHttpMethod($method) {}

	/**
	 * Check if HTTP method match any of the passed methods
	 * When strict is true it checks if validated methods are real HTTP methods
	 * 
	 * @param mixed $methods
	 * @param boolean $strict
	 *
	 * @return boolean
	 */
	public function isMethod($methods, $strict=false) {}

	/**
	 * Checks whether HTTP method is POST. if _SERVER["REQUEST_METHOD"]==="POST"
	 *
	 * @return boolean
	 */
	public function isPost() {}

	/**
	 * Checks whether HTTP method is GET. if _SERVER["REQUEST_METHOD"]==="GET"
	 *
	 * @return boolean
	 */
	public function isGet() {}

	/**
	 * Checks whether HTTP method is PUT. if _SERVER["REQUEST_METHOD"]==="PUT"
	 *
	 * @return boolean
	 */
	public function isPut() {}

	/**
	 * Checks whether HTTP method is PATCH. if _SERVER["REQUEST_METHOD"]==="PATCH"
	 *
	 * @return boolean
	 */
	public function isPatch() {}

	/**
	 * Checks whether HTTP method is HEAD. if _SERVER["REQUEST_METHOD"]==="HEAD"
	 *
	 * @return boolean
	 */
	public function isHead() {}

	/**
	 * Checks whether HTTP method is DELETE. if _SERVER["REQUEST_METHOD"]==="DELETE"
	 *
	 * @return boolean
	 */
	public function isDelete() {}

	/**
	 * Checks whether HTTP method is OPTIONS. if _SERVER["REQUEST_METHOD"]==="OPTIONS"
	 *
	 * @return boolean
	 */
	public function isOptions() {}

	/**
	 * Checks whether request include attached files
	 * 
	 * @param boolean $onlySuccessful
	 *
	 * @return 
	 */
	public function hasFiles($onlySuccessful=false) {}

	/**
	 * Recursively counts file in an array of files
	 * 
	 * @param mixed $data
	 * @param boolean $onlySuccessful
	 *
	 * @return 
	 */
	protected final function hasFileHelper($data, $onlySuccessful) {}

	/**
	 * Gets attached files as Phalcon\Http\Request\File instances
	 * 
	 * @param boolean $onlySuccessful
	 *
	 * @return File[]
	 */
	public function getUploadedFiles($onlySuccessful=false) {}

	/**
	 * Smooth out $_FILES to have plain array with all files uploaded
	 * 
	 * @param array $names
	 * @param array $types
	 * @param array $tmp_names
	 * @param array $sizes
	 * @param array $errors
	 * @param string $prefix
	 *
	 * @return array
	 */
	protected final function smoothFiles(array $names, array $types, array $tmp_names, array $sizes, array $errors, $prefix) {}

	/**
	 * Returns the available headers in the request
	 *
	 * @return array
	 */
	public function getHeaders() {}

	/**
	 * Gets web page that refers active request. ie: http://www.google.com
	 *
	 * @return string
	 */
	public function getHTTPReferer() {}

	/**
	 * Process a request header and return an array of values with their qualities
	 * 
	 * @param string $serverIndex
	 * @param string $name
	 *
	 * @return array
	 */
	protected final function _getQualityHeader($serverIndex, $name) {}

	/**
	 * Process a request header and return the one with best quality
	 * 
	 * @param array $qualityParts
	 * @param string $name
	 *
	 * @return string
	 */
	protected final function _getBestQuality(array $qualityParts, $name) {}

	/**
	 * Gets content type which request has been made
	 *
	 * @return string|null
	 */
	public function getContentType() {}

	/**
			 * @see https://bugs.php.net/bug.php?id=66606
			 *
	 * @return array
	 */
	public function getAcceptableContent() {}

	/**
	 * Gets best mime/type accepted by the browser/client from _SERVER["HTTP_ACCEPT"]
	 *
	 * @return string
	 */
	public function getBestAccept() {}

	/**
	 * Gets a charsets array and their quality accepted by the browser/client from _SERVER["HTTP_ACCEPT_CHARSET"]
	 *
	 * @return 
	 */
	public function getClientCharsets() {}

	/**
	 * Gets best charset accepted by the browser/client from _SERVER["HTTP_ACCEPT_CHARSET"]
	 *
	 * @return string
	 */
	public function getBestCharset() {}

	/**
	 * Gets languages array and their quality accepted by the browser/client from _SERVER["HTTP_ACCEPT_LANGUAGE"]
	 *
	 * @return array
	 */
	public function getLanguages() {}

	/**
	 * Gets best language accepted by the browser/client from _SERVER["HTTP_ACCEPT_LANGUAGE"]
	 *
	 * @return string
	 */
	public function getBestLanguage() {}

	/**
	 * Gets auth info accepted by the browser/client from $_SERVER['PHP_AUTH_USER']
	 *
	 * @return array|null
	 */
	public function getBasicAuth() {}

	/**
	 * Gets auth info accepted by the browser/client from $_SERVER['PHP_AUTH_DIGEST']
	 *
	 * @return array
	 */
	public function getDigestAuth() {}

}
