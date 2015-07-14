<?php

namespace Phalcon\Mvc;

use Phalcon\DiInterface;
use Phalcon\Mvc\RouterInterface;
use Phalcon\Mvc\Router\RouteInterface;
use Phalcon\Mvc\Url\Exception;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Mvc\UrlInterface;


class Url implements UrlInterface, InjectionAwareInterface
{

	protected $_dependencyInjector;

	protected $_baseUri = null;

	protected $_staticBaseUri = null;

	protected $_basePath = null;

	protected $_router;



	/**
	 * Sets the DependencyInjector container
	 * 
	 * @param DiInterface $dependencyInjector
	 *
	 * @return void
	 */
	public function setDI(DiInterface $dependencyInjector) {}

	/**
	 * Returns the DependencyInjector container
	 *
	 * @return DiInterface
	 */
	public function getDI() {}

	/**
	 * Sets a prefix for all the URIs to be generated
	 *
	 *<code>
	 *	$url->setBaseUri('/invo/');
	 *	$url->setBaseUri('/invo/index.php/');
	 *</code>
	 * 
	 * @param string $baseUri
	 *
	 * @return Url
	 */
	public function setBaseUri($baseUri) {}

	/**
	 * Sets a prefix for all static URLs generated
	 *
	 *<code>
	 *	$url->setStaticBaseUri('/invo/');
	 *</code>
	 * 
	 * @param string $staticBaseUri
	 *
	 * @return Url
	 */
	public function setStaticBaseUri($staticBaseUri) {}

	/**
	 * Returns the prefix for all the generated urls. By default /
	 *
	 * @return string
	 */
	public function getBaseUri() {}

	/**
	 * Returns the prefix for all the generated static urls. By default /
	 *
	 * @return string
	 */
	public function getStaticBaseUri() {}

	/**
	 * Sets a base path for all the generated paths
	 *
	 *<code>
	 *	$url->setBasePath('/var/www/htdocs/');
	 *</code>
	 * 
	 * @param string $basePath
	 *
	 * @return Url
	 */
	public function setBasePath($basePath) {}

	/**
	 * Returns the base path
	 *
	 * @return string
	 */
	public function getBasePath() {}

	/**
	 * Generates a URL
	 *
	 *<code>
	 * //Generate a URL appending the URI to the base URI
	 * echo $url->get('products/edit/1');
	 *
	 * //Generate a URL for a predefined route
	 * echo $url->get(array('for' => 'blog-post', 'title' => 'some-cool-stuff', 'year' => '2015'));
	 *</code>
	 * 
	 * @param mixed $uri
	 * @param mixed $args
	 * @param mixed $local
	 * @param mixed $baseUri
	 *
	 * @return string
	 */
	public function get($uri=null, $args=null, $local=null, $baseUri=null) {}

	/**
			 * Check if the router has not previously set
	 * 
	 * @param mixed $uri
			 *
	 * @return string
	 */
	public function getStatic($uri=null) {}

	/**
	 * Generates a local path
	 * 
	 * @param string $path
	 *
	 * @return string
	 */
	public function path($path=null) {}

}
