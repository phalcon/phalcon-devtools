<?php

namespace Phalcon\Paginator\Adapter;

class Model implements \Phalcon\Paginator\AdapterInterface
{
    /**
     * Number of rows to show in the paginator. By default is null
     */
    protected $_limitRows = null;

    /**
     * Configuration of paginator by model
     */
    protected $_config = null;

    /**
     * Current page in paginate
     */
    protected $_page = null;


    /**
     * Phalcon\Paginator\Adapter\Model constructor
     *
     * @param array $config 
     */
	public function __construct($config) {}

    /**
     * Set the current page number
     *
     * @param int $page 
     */
	public function setCurrentPage($page) {}

    /**
     * Set current rows limit
     *
     * @param int $limitRows 
     * @return Model 
     */
	public function setLimit($limitRows) {}

    /**
     * Get current rows limit
     *
     * @return int 
     */
	public function getLimit() {}

    /**
     * Returns a slice of the resultset to show in the pagination
     *
     * @return \stdclass 
     */
	public function getPaginate() {}

}
