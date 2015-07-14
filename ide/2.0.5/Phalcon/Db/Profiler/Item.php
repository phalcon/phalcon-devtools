<?php

namespace Phalcon\Db\Profiler;

class Item
{

	/**
	 * SQL statement related to the profile
	 *
	 * @var string
	 */
	protected $_sqlStatement;

	public function setSqlStatement($value) {
		$this->_sqlStatement = $value;
	}

	public function getSqlStatement() {
		return $this->_sqlStatement;
	}

	/**
	 * SQL variables related to the profile
	 *
	 * @var array
	 */
	protected $_sqlVariables;

	public function setSqlVariables($value) {
		$this->_sqlVariables = $value;
	}

	public function getSqlVariables() {
		return $this->_sqlVariables;
	}

	/**
	 * SQL bind types related to the profile
	 *
	 * @var array
	 */
	protected $_sqlBindTypes;

	public function setSqlBindTypes($value) {
		$this->_sqlBindTypes = $value;
	}

	public function getSqlBindTypes() {
		return $this->_sqlBindTypes;
	}

	/**
	 * Timestamp when the profile started
	 *
	 * @var double
	 */
	protected $_initialTime;

	public function setInitialTime($value) {
		$this->_initialTime = $value;
	}

	public function getInitialTime() {
		return $this->_initialTime;
	}

	/**
	 * Timestamp when the profile ended
	 *
	 * @var double
	 */
	protected $_finalTime;

	public function setFinalTime($value) {
		$this->_finalTime = $value;
	}

	public function getFinalTime() {
		return $this->_finalTime;
	}



	/**
	 * Returns the total time in seconds spent by the profile
	 *
	 * @return double
	 */
	public function getTotalElapsedSeconds() {}

}
