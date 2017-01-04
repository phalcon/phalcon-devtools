<?php

namespace Phalcon\Acl;

use Phalcon\Acl\Exception;


class Role implements RoleInterface
{

	/**
	 * Role name
	 * @var string
	 */
	protected $_name;

	public function getName() {
		return $this->_name;
	}

	public function __toString() {
		return $this->_name;
	}

	/**
	 * Role description
	 * @var string
	 */
	protected $_description;

	public function getDescription() {
		return $this->_description;
	}



	/**
	 * Phalcon\Acl\Role constructor
	 * 
	 * @param string $name
	 * @param string $description
	 */
	public function __construct($name, $description=null) {}

}
