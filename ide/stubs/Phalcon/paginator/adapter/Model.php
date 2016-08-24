<?php

namespace Phalcon\Paginator\Adapter;

/**
 * Phalcon\Paginator\Adapter\Model
 * This adapter allows to paginate data using a Phalcon\Mvc\Model resultset as a base.
 * <code>
 * use Phalcon\Paginator\Adapter\Model;
 * $paginator = new Model(
 * [
 * 'data'  => Robots::find(),
 * 'limit' => 25,
 * 'page'  => $currentPage
 * ]
 * );
 * $paginate = $paginator->getPaginate();
 * </code>
 */
class Model extends \Phalcon\Paginator\Adapter implements \Phalcon\Paginator\AdapterInterface
{
    /**
     * Configuration of paginator by model
     */
    protected $_config = null;


    /**
     * Phalcon\Paginator\Adapter\Model constructor
     *
     * @param array $config 
     */
    public function __construct(array $config) {}

    /**
     * Returns a slice of the resultset to show in the pagination
     *
     * @return \stdClass 
     */
    public function getPaginate() {}

}
