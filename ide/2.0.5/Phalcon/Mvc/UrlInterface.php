<?php

namespace Phalcon\Mvc;

interface UrlInterface
{

	/**
	 * Sets a prefix to all the urls generated
	 * 
	 * @param string $baseUri
	 */
	public function setBaseUri($baseUri);

	/**
	 * Returns the prefix for all the generated urls. By default /
	 *
	 * @return string
	 */
	public function getBaseUri();

	/**
	 * Sets a base paths for all the generated paths
	 * 
	 * @param string $basePath
	 */
	public function setBasePath($basePath);

	/**
	 * Returns a base path
	 *
	 * @return string
	 */
	public function getBasePath();

	/**
	 * Generates a URL
	 *
	 * @param string|array $uri
	 * @param $args
	 * @param boolean $local
	 * @param array|\object args Optional arguments to be appended to the query $string
	 * 
	 * @return string
	 */
	public function get($uri=null, $args=null, $local=null);

	/**
	 * Generates a local path
	 *
	 * @param string $path
	 * 
	 * @return string
	 */
	public function path($path=null);

}
