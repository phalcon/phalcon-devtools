<?php

namespace Phalcon\Mvc;

/**
 * Phalcon\Mvc\Url
<<<<<<< HEAD
 * This components helps in the generation of: URIs, URLs and Paths
=======
 * This components aids in the generation of: URIs, URLs and Paths
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146
 * <code>
 * //Generate a URL appending the URI to the base URI
 * echo $url->get('products/edit/1');
 * //Generate a URL for a predefined route
 * echo $url->get(array('for' => 'blog-post', 'title' => 'some-cool-stuff', 'year' => '2012'));
 * </code>
 */
class Url implements \Phalcon\Mvc\UrlInterface, \Phalcon\Di\InjectionAwareInterface
{

    protected $_dependencyInjector;


    protected $_baseUri = null;


    protected $_staticBaseUri = null;


    protected $_basePath = null;


    protected $_router;


    /**
     * Sets the DependencyInjector container
     *
     * @param mixed $dependencyInjector 
     */
    public function setDI(\Phalcon\DiInterface $dependencyInjector) {}

    /**
     * Returns the DependencyInjector container
     *
     * @return \Phalcon\DiInterface 
     */
    public function getDI() {}

    /**
     * Sets a prefix for all the URIs to be generated
     * <code>
     * $url->setBaseUri('/invo/');
     * $url->setBaseUri('/invo/index.php/');
     * </code>
     *
     * @param string $baseUri 
     * @return Url 
     */
    public function setBaseUri($baseUri) {}

    /**
     * Sets a prefix for all static URLs generated
     * <code>
     * $url->setStaticBaseUri('/invo/');
     * </code>
     *
     * @param string $staticBaseUri 
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
     * <code>
     * $url->setBasePath('/var/www/htdocs/');
     * </code>
     *
     * @param string $basePath 
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
     * <code>
     * //Generate a URL appending the URI to the base URI
     * echo $url->get('products/edit/1');
     * //Generate a URL for a predefined route
<<<<<<< HEAD
     * echo $url->get(array('for' => 'blog-post', 'title' => 'some-cool-stuff', 'year' => '2015'));
     * </code>
     *
     * @param mixed $uri 
     * @param mixed $args 
     * @param mixed $local 
     * @param mixed $baseUri 
     * @return string 
     */
    public function get($uri = null, $args = null, $local = null, $baseUri = null) {}

    /**
     * Generates a URL for a static resource
     * <code>
     * // Generate a URL for a static resource
     * echo $url->getStatic("img/logo.png");
     * // Generate a URL for a static predefined route
     * echo $url->getStatic(array('for' => 'logo-cdn'));
     * </code>
     *
     * @param mixed $uri 
=======
     * echo $url->get(array('for' => 'blog-post', 'title' => 'some-cool-stuff', 'year' => '2012'));
     * </code>
     *
     * @param string|array $uri 
     * @param array|object $args Optional arguments to be appended to the query string
     * @param bool $local 
     * @param bool $$local 
     * @return string 
     */
    public function get($uri = null, $args = null, $local = null) {}

    /**
     * Generates a URL for a static resource
     *
     * @param string|array $uri 
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146
     * @return string 
     */
    public function getStatic($uri = null) {}

    /**
     * Generates a local path
     *
     * @param string $path 
     * @return string 
     */
    public function path($path = null) {}

}
