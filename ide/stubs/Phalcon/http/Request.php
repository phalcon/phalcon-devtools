<?php

namespace Phalcon\Http;

/**
 * Phalcon\Http\Request
 * Encapsulates request information for easy and secure access from application controllers.
 * The request object is a simple value object that is passed between the dispatcher and controller classes.
 * It packages the HTTP request environment.
 * <code>
 * use Phalcon\Http\Request;
 * $request = new Request();
 * if ($request->isPost()) {
 * if ($request->isAjax()) {
 * echo 'Request was made using POST and AJAX';
 * }
 * }
 * $request->getServer('HTTP_HOST'); // retrieve SERVER variables
 * $request->getMethod();            // GET, POST, PUT, DELETE, HEAD, OPTIONS, PATCH, PURGE, TRACE, CONNECT
 * $request->getLanguages();         // an array of languages the client accepts
 * </code>
 */
class Request implements \Phalcon\Http\RequestInterface, \Phalcon\Di\InjectionAwareInterface
{

    protected $_dependencyInjector;


    protected $_rawBody;


    protected $_filter;


    protected $_putCache;


    protected $_httpMethodParameterOverride = false;


    protected $_strictHostCheck = false;



    public function getHttpMethodParameterOverride() {}

    /**
     * @param mixed $httpMethodParameterOverride
     */
    public function setHttpMethodParameterOverride($httpMethodParameterOverride) {}

    /**
     * Sets the dependency injector
     *
     * @param mixed $dependencyInjector
     */
    public function setDI(\Phalcon\DiInterface $dependencyInjector) {}

    /**
     * Returns the internal dependency injector
     *
     * @return \Phalcon\DiInterface
     */
    public function getDI() {}

    /**
     * Gets a variable from the $_REQUEST superglobal applying filters if needed.
     * If no parameters are given the $_REQUEST superglobal is returned
     * <code>
     * //Returns value from $_REQUEST["user_email"] without sanitizing
     * $userEmail = $request->get("user_email");
     * //Returns value from $_REQUEST["user_email"] with sanitizing
     * $userEmail = $request->get("user_email", "email");
     * </code>
     *
     * @param string $name
     * @param mixed $filters
     * @param mixed $defaultValue
     * @param bool $notAllowEmpty
     * @param bool $noRecursive
     * @return mixed
     */
    public function get($name = null, $filters = null, $defaultValue = null, $notAllowEmpty = false, $noRecursive = false) {}

    /**
     * Gets a variable from the $_POST superglobal applying filters if needed
     * If no parameters are given the $_POST superglobal is returned
     * <code>
     * //Returns value from $_POST["user_email"] without sanitizing
     * $userEmail = $request->getPost("user_email");
     * //Returns value from $_POST["user_email"] with sanitizing
     * $userEmail = $request->getPost("user_email", "email");
     * </code>
     *
     * @param string $name
     * @param mixed $filters
     * @param mixed $defaultValue
     * @param bool $notAllowEmpty
     * @param bool $noRecursive
     * @return mixed
     */
    public function getPost($name = null, $filters = null, $defaultValue = null, $notAllowEmpty = false, $noRecursive = false) {}

    /**
     * Gets a variable from put request
     * <code>
     * //Returns value from $_PUT["user_email"] without sanitizing
     * $userEmail = $request->getPut("user_email");
     * //Returns value from $_PUT["user_email"] with sanitizing
     * $userEmail = $request->getPut("user_email", "email");
     * </code>
     *
     * @param string $name
     * @param mixed $filters
     * @param mixed $defaultValue
     * @param bool $notAllowEmpty
     * @param bool $noRecursive
     * @return mixed
     */
    public function getPut($name = null, $filters = null, $defaultValue = null, $notAllowEmpty = false, $noRecursive = false) {}

    /**
     * Gets variable from $_GET superglobal applying filters if needed
     * If no parameters are given the $_GET superglobal is returned
     * <code>
     * // Returns value from $_GET['id'] without sanitizing
     * $id = $request->getQuery('id');
     * // Returns value from $_GET['id'] with sanitizing
     * $id = $request->getQuery('id', 'int');
     * // Returns value from $_GET['id'] with a default value
     * $id = $request->getQuery('id', null, 150);
     * </code>
     *
     * @param string $name
     * @param mixed $filters
     * @param mixed $defaultValue
     * @param bool $notAllowEmpty
     * @param bool $noRecursive
     * @return mixed
     */
    public function getQuery($name = null, $filters = null, $defaultValue = null, $notAllowEmpty = false, $noRecursive = false) {}

    /**
     * Helper to get data from superglobals, applying filters if needed.
     * If no parameters are given the superglobal is returned.
     *
     * @param array $source
     * @param string $name
     * @param mixed $filters
     * @param mixed $defaultValue
     * @param bool $notAllowEmpty
     * @param bool $noRecursive
     * @return mixed
     */
    protected final function getHelper(array $source, $name = null, $filters = null, $defaultValue = null, $notAllowEmpty = false, $noRecursive = false) {}

    /**
     * Gets variable from $_SERVER superglobal
     *
     * @param string $name
     * @return string|null
     */
    public function getServer($name) {}

    /**
     * Checks whether $_REQUEST superglobal has certain index
     *
     * @param string $name
     * @return bool
     */
    public function has($name) {}

    /**
     * Checks whether $_POST superglobal has certain index
     *
     * @param string $name
     * @return bool
     */
    public function hasPost($name) {}

    /**
     * Checks whether the PUT data has certain index
     *
     * @param string $name
     * @return bool
     */
    public function hasPut($name) {}

    /**
     * Checks whether $_GET superglobal has certain index
     *
     * @param string $name
     * @return bool
     */
    public function hasQuery($name) {}

    /**
     * Checks whether $_SERVER superglobal has certain index
     *
     * @param string $name
     * @return bool
     */
    public final function hasServer($name) {}

    /**
     * Gets HTTP header from request data
     *
     * @param string $header
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
     * @return bool
     */
    public function isAjax() {}

    /**
     * Checks whether request has been made using SOAP
     *
     * @return bool
     */
    public function isSoap() {}

    /**
     * Alias of isSoap(). It will be deprecated in future versions
     *
     * @return bool
     */
    public function isSoapRequested() {}

    /**
     * Checks whether request has been made using any secure layer
     *
     * @return bool
     */
    public function isSecure() {}

    /**
     * Alias of isSecure(). It will be deprecated in future versions
     *
     * @return bool
     */
    public function isSecureRequest() {}

    /**
     * Gets HTTP raw request body
     *
     * @return string
     */
    public function getRawBody() {}

    /**
     * Gets decoded JSON HTTP raw request body
     *
     * @param bool $associative
     * @return array|bool|\stdClass
     */
    public function getJsonRawBody($associative = false) {}

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
     * Gets host name used by the request.
     * `Request::getHttpHost` trying to find host name in following order:
     * - `$_SERVER['HTTP_HOST']`
     * - `$_SERVER['SERVER_NAME']`
     * - `$_SERVER['SERVER_ADDR']`
     * Optionally `Request::getHttpHost` validates and clean host name.
     * The `Request::$_strictHostCheck` can be used to validate host name.
     * Note: validation and cleaning have a negative performance impact because they use regular expressions.
     * <code>
     * use Phalcon\Http\Request;
     * $request = new Request;
     * $_SERVER['HTTP_HOST'] = 'example.com';
     * $request->getHttpHost(); // example.com
     * $_SERVER['HTTP_HOST'] = 'example.com:8080';
     * $request->getHttpHost(); // example.com:8080
     * $request->setStrictHostCheck(true);
     * $_SERVER['HTTP_HOST'] = 'ex=am~ple.com';
     * $request->getHttpHost(); // UnexpectedValueException
     * $_SERVER['HTTP_HOST'] = 'ExAmPlE.com';
     * $request->getHttpHost(); // example.com
     * </code>
     *
     * @return string
     */
    public function getHttpHost() {}

    /**
     * Sets if the `Request::getHttpHost` method must be use strict validation of host name or not
     *
     * @param bool $flag
     * @return Request
     */
    public function setStrictHostCheck($flag = true) {}

    /**
     * Checks if the `Request::getHttpHost` method will be use strict validation of host name or not
     *
     * @return bool
     */
    public function isStrictHostCheck() {}

    /**
     * Gets information about the port on which the request is made.
     *
     * @return int
     */
    public function getPort() {}

    /**
     * Gets HTTP URI which request has been made
     *
     * @return string
     */
    public final function getURI() {}

    /**
     * Gets most possible client IPv4 Address. This method search in _SERVER['REMOTE_ADDR'] and optionally in _SERVER['HTTP_X_FORWARDED_FOR']
     *
     * @param bool $trustForwardedHeader
     * @return string|bool
     */
    public function getClientAddress($trustForwardedHeader = false) {}

    /**
     * Gets HTTP method which request has been made
     * If the X-HTTP-Method-Override header is set, and if the method is a POST,
     * then it is used to determine the "real" intended HTTP method.
     * The _method request parameter can also be used to determine the HTTP method,
     * but only if setHttpMethodParameterOverride(true) has been called.
     * The method is always an uppercased string.
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
     * @return bool
     */
    public function isValidHttpMethod($method) {}

    /**
     * Check if HTTP method match any of the passed methods
     * When strict is true it checks if validated methods are real HTTP methods
     *
     * @param mixed $methods
     * @param bool $strict
     * @return bool
     */
    public function isMethod($methods, $strict = false) {}

    /**
     * Checks whether HTTP method is POST. if _SERVER["REQUEST_METHOD"]==="POST"
     *
     * @return bool
     */
    public function isPost() {}

    /**
     * Checks whether HTTP method is GET. if _SERVER["REQUEST_METHOD"]==="GET"
     *
     * @return bool
     */
    public function isGet() {}

    /**
     * Checks whether HTTP method is PUT. if _SERVER["REQUEST_METHOD"]==="PUT"
     *
     * @return bool
     */
    public function isPut() {}

    /**
     * Checks whether HTTP method is PATCH. if _SERVER["REQUEST_METHOD"]==="PATCH"
     *
     * @return bool
     */
    public function isPatch() {}

    /**
     * Checks whether HTTP method is HEAD. if _SERVER["REQUEST_METHOD"]==="HEAD"
     *
     * @return bool
     */
    public function isHead() {}

    /**
     * Checks whether HTTP method is DELETE. if _SERVER["REQUEST_METHOD"]==="DELETE"
     *
     * @return bool
     */
    public function isDelete() {}

    /**
     * Checks whether HTTP method is OPTIONS. if _SERVER["REQUEST_METHOD"]==="OPTIONS"
     *
     * @return bool
     */
    public function isOptions() {}

    /**
     * Checks whether HTTP method is PURGE (Squid and Varnish support). if _SERVER["REQUEST_METHOD"]==="PURGE"
     *
     * @return bool
     */
    public function isPurge() {}

    /**
     * Checks whether HTTP method is TRACE. if _SERVER["REQUEST_METHOD"]==="TRACE"
     *
     * @return bool
     */
    public function isTrace() {}

    /**
     * Checks whether HTTP method is CONNECT. if _SERVER["REQUEST_METHOD"]==="CONNECT"
     *
     * @return bool
     */
    public function isConnect() {}

    /**
     * Checks whether request include attached files
     *
     * @param bool $onlySuccessful
     * @return long
     */
    public function hasFiles($onlySuccessful = false) {}

    /**
     * Recursively counts file in an array of files
     *
     * @param mixed $data
     * @param bool $onlySuccessful
     * @return long
     */
    protected final function hasFileHelper($data, $onlySuccessful) {}

    /**
     * Gets attached files as Phalcon\Http\Request\File instances
     *
     * @param bool $onlySuccessful
     * @return File[]
     */
    public function getUploadedFiles($onlySuccessful = false) {}

    /**
     * Smooth out $_FILES to have plain array with all files uploaded
     *
     * @param array $names
     * @param array $types
     * @param array $tmp_names
     * @param array $sizes
     * @param array $errors
     * @param string $prefix
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
     * @return array
     */
    protected final function _getQualityHeader($serverIndex, $name) {}

    /**
     * Process a request header and return the one with best quality
     *
     * @param array $qualityParts
     * @param string $name
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
     * Gets an array with mime/types and their quality accepted by the browser/client from _SERVER["HTTP_ACCEPT"]
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
     * @return mixed
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
