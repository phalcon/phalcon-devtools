<?php

namespace Phalcon\Paginator;

/**
 * Phalcon\Paginator\Adapter
 */
abstract class Adapter implements \Phalcon\Paginator\AdapterInterface
{
    /**
     * Number of rows to show in the paginator. By default is null
     */
    protected $_limitRows = null;

    /**
     * Current page in paginate
     */
    protected $_page = null;


    /**
     * Set the current page number
     *
     * @param int $page
     * @return Adapter
     */
    public function setCurrentPage($page) {}

    /**
     * Set current rows limit
     *
     * @param int $limitRows
     * @return Adapter
     */
    public function setLimit($limitRows) {}

    /**
     * Get current rows limit
     *
     * @return int
     */
    public function getLimit() {}

}
