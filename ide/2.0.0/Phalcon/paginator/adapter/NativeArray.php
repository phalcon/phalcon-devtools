<?php

namespace Phalcon\Paginator\Adapter;

class NativeArray implements \Phalcon\Paginator\AdapterInterface
{
    /**
     * Number of rows to show in the paginator. By default is null
     */
    protected $_limitRows = null;

    /**
     * Configuration of the paginator
     */
    protected $_config = null;

    /**
     * Current page in paginate
     */
    protected $_page = null;


    /**
     * Phalcon\Paginator\Adapter\NativeArray constructor
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
     * @return NativeArray 
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
     * @return \stdClass 
     */
	public function getPaginate() {}

}
