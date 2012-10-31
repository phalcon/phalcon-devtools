<?php 

namespace Phalcon\Http {

	/**
	 * Phalcon\Http\Request
	 *
	 * <p>Encapsulates request information for easy and secure access from application controllers.</p>
	 *
	 * <p>The request object is a simple value object that is passed between the dispatcher and controller classes.
	 * It packages the HTTP request environment.</p>
	 *
	 *<code>
	 *	$request = new Phalcon\Http\Request();
	 *	if ($request->isPost() == true) {
	 *		if ($request->isAjax() == true) {
	 *			echo 'Request was made using POST and AJAX';
	 *		}
	 *	}
	 * </code>
	 *
	 */
	
	class Request {

		protected $_dependencyInjector;

		protected $_filter;

		/**
		 * Sets the dependency injector
		 *
		 * @param \Phalcon\DI $dependencyInjector
		 */
		public function setDI($dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 *
		 * @return \Phalcon\DI
		 */
		public function getDI(){ }


		/**
		 * Gets a variable from the $_REQUEST superglobal applying filters if needed
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
		 * @param string|array $filters
		 * @return mixed
		 */
		public function get($name, $filters=null){ }


		/**
		 * Gets a variable from the $_POST superglobal applying filters if needed
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
		 * @param string|array $filters
		 * @return mixed
		 */
		public function getPost($name, $filters=null){ }


		/**
		 * Gets variable from $_GET superglobal applying filters if needed
		 *
		 *<code>
		 *	//Returns value from $_GET["id"] without sanitizing
		 *	$id = $request->getQuery("id");
		 *
		 *	//Returns value from $_GET["id"] with sanitizing
		 *	$id = $request->getQuery("id", "int");
		 *</code>
		 *
		 * @param string $name
		 * @param string|array $filters
		 * @return mixed
		 */
		public function getQuery($name, $filters=null){ }


		/**
		 * Gets variable from $_SERVER superglobal
		 *
		 * @param string $name
		 * @return mixed
		 */
		public function getServer($name){ }


		/**
		 * Checks whether $_SERVER superglobal has certain index
		 *
		 * @param string $name
		 * @return boolean
		 */
		public function has($name){ }


		/**
		 * Checks whether $_POST superglobal has certain index
		 *
		 * @param string $name
		 * @return boolean
		 */
		public function hasPost($name){ }


		/**
		 * Checks whether $_SERVER superglobal has certain index
		 *
		 * @param string $name
		 * @return boolean
		 */
		public function hasQuery($name){ }


		/**
		 * Checks whether $_SERVER superglobal has certain index
		 *
		 * @param string $name
		 * @return mixed
		 */
		public function hasServer($name){ }


		/**
		 * Gets HTTP header from request data
		 *
		 * @param string $header
		 * @return string
		 */
		public function getHeader($header){ }


		/**
		 * Gets HTTP schema (http/https)
		 *
		 * @return string
		 */
		public function getScheme(){ }


		/**
		 * Checks whether request has been made using ajax. Checks if $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest'
		 *
		 * @return boolean
		 */
		public function isAjax(){ }


		/**
		 * Checks whether request has been made using SOAP
		 *
		 * @return boolean
		 */
		public function isSoapRequested(){ }


		/**
		 * Checks whether request has been made using any secure layer
		 *
		 * @return boolean
		 */
		public function isSecureRequest(){ }


		/**
		 * Gets HTTP raws request body
		 *
		 * @return string
		 */
		public function getRawBody(){ }


		/**
		 * Gets active server address IP
		 *
		 * @return string
		 */
		public function getServerAddress(){ }


		/**
		 * Gets active server name
		 *
		 * @return string
		 */
		public function getServerName(){ }


		/**
		 * Gets information about schema, host and port used by the request
		 *
		 * @return string
		 */
		public function getHttpHost(){ }


		/**
		 * Gets most possibly client IPv4 Address. This methods search in $_SERVER['REMOTE_ADDR'] and optionally in $_SERVER['HTTP_X_FORWARDED_FOR']
		 *
		 * @param boolean $trustForwardedHeader
		 * @return string
		 */
		public function getClientAddress($trustForwardedHeader=null){ }


		/**
		 * Gets HTTP method which request has been made
		 *
		 * @return string
		 */
		public function getMethod(){ }


		/**
		 * Gets HTTP user agent used to made the request
		 *
		 * @return string
		 */
		public function getUserAgent(){ }


		/**
		 * Check if HTTP method match any of the passed methods
		 *
		 * @param string|array $methods
		 */
		public function isMethod($methods){ }


		/**
		 * Checks whether HTTP method is POST. if $_SERVER['REQUEST_METHOD']=='POST'
		 *
		 * @return boolean
		 */
		public function isPost(){ }


		/**
		 *
		 * Checks whether HTTP method is GET. if $_SERVER['REQUEST_METHOD']=='GET'
		 *
		 * @return boolean
		 */
		public function isGet(){ }


		/**
		 * Checks whether HTTP method is PUT. if $_SERVER['REQUEST_METHOD']=='PUT'
		 *
		 * @return boolean
		 */
		public function isPut(){ }


		/**
		 * Checks whether HTTP method is HEAD. if $_SERVER['REQUEST_METHOD']=='HEAD'
		 *
		 * @return boolean
		 */
		public function isHead(){ }


		/**
		 * Checks whether HTTP method is DELETE. if $_SERVER['REQUEST_METHOD']=='DELETE'
		 *
		 * @return boolean
		 */
		public function isDelete(){ }


		/**
		 * Checks whether HTTP method is OPTIONS. if $_SERVER['REQUEST_METHOD']=='OPTIONS'
		 *
		 * @return boolean
		 */
		public function isOptions(){ }


		/**
		 * Checks whether request include attached files
		 *
		 * @return boolean
		 */
		public function hasFiles(){ }


		/**
		 * Gets attached files as \Phalcon\Http\Request\File instances
		 *
		 * @return \Phalcon\Http\Request\File[]
		 */
		public function getUploadedFiles(){ }


		/**
		 * Gets web page that refers active request. ie: http://www.google.com
		 *
		 * @return string
		 */
		public function getHTTPReferer(){ }


		/**
		 * Process a request header and return an array of values with their qualities
		 *
		 * @param string $serverIndex
		 * @param string $name
		 * @return array
		 */
		protected function _getQualityHeader(){ }


		/**
		 * Process a request header and return the one with best quality
		 *
		 * @param array $qualityParts
		 * @param string $name
		 * @return string
		 */
		protected function _getBestQuality(){ }


		/**
		 * Gets array with mime/types and their quality accepted by the browser/client from $_SERVER['HTTP_ACCEPT']
		 *
		 * @return array
		 */
		public function getAcceptableContent(){ }


		/**
		 * Gets best mime/type accepted by the browser/client from $_SERVER['HTTP_ACCEPT']
		 *
		 * @return array
		 */
		public function getBestAccept(){ }


		/**
		 * Gets charsets array and their quality accepted by the browser/client from $_SERVER['HTTP_ACCEPT_CHARSET']
		 *
		 * @return array
		 */
		public function getClientCharsets(){ }


		/**
		 * Gets best charset accepted by the browser/client from $_SERVER['HTTP_ACCEPT_CHARSET']
		 *
		 * @return string
		 */
		public function getBestCharset(){ }


		/**
		 * Gets languages array and their quality accepted by the browser/client from $_SERVER['HTTP_ACCEPT_LANGUAGE']
		 *
		 * @return array
		 */
		public function getLanguages(){ }


		/**
		 * Gets best language accepted by the browser/client from $_SERVER['HTTP_ACCEPT_LANGUAGE']
		 *
		 * @return string
		 */
		public function getBestLanguage(){ }

	}
}
