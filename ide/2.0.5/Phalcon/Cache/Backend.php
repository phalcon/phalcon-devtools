<?php

namespace Phalcon\Cache;

use Phalcon\Cache\FrontendInterface;


abstract class Backend
{

	protected $_frontend;

	public function getFrontend() {
		return $this->_frontend;
	}

	public function setFrontend($value) {
		$this->_frontend = $value;
	}

	protected $_options;

	public function getOptions() {
		return $this->_options;
	}

	public function setOptions($value) {
		$this->_options = $value;
	}

	protected $_prefix = '';

	protected $_lastKey = '';

	public function getLastKey() {
		return $this->_lastKey;
	}

	public function setLastKey($value) {
		$this->_lastKey = $value;
	}

	protected $_lastLifetime = null;

	protected $_fresh = false;

	protected $_started = false;



	/**
	 * Phalcon\Cache\Backend constructor
	 * 
	 * @param FrontendInterface $frontend
	 * @param array $options
	 *
	 */
	public function __construct(FrontendInterface $frontend, $options=null) {}

	/**
		 * A common option is the prefix
	 * 
	 * @param mixed $keyName
	 * @param $lifetime
		 *
	 * @return mixed
	 */
	public function start($keyName, $lifetime=null) {}

	/**
		 * Get the cache content verifying if it was expired
	 * 
	 * @param boolean $stopBuffer
		 *
	 * @return void
	 */
	public function stop($stopBuffer=true) {}

	/**
	 * Checks whether the last cache is fresh or cached
	 *
	 * @return boolean
	 */
	public function isFresh() {}

	/**
	 * Checks whether the cache has starting buffering or not
	 *
	 * @return boolean
	 */
	public function isStarted() {}

	/**
	 * Gets the last lifetime set
	 *
	 * @return int
	 */
	public function getLifetime() {}

}
