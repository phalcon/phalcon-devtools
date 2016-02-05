<?php

namespace Phalcon\Paginator\Adapter;

/**
 * Phalcon\Paginator\Adapter\NativeArray
 * Pagination using a PHP array as source of data
 * <code>
 * $paginator = new \Phalcon\Paginator\Adapter\NativeArray(
 * array(
 * "data"  => array(
 * array('id' => 1, 'name' => 'Artichoke'),
 * array('id' => 2, 'name' => 'Carrots'),
 * array('id' => 3, 'name' => 'Beet'),
 * array('id' => 4, 'name' => 'Lettuce'),
 * array('id' => 5, 'name' => '')
 * ),
 * "limit" => 2,
 * "page"  => $currentPage
 * )
 * );
 * </code>
 */
class NativeArray extends \Phalcon\Paginator\Adapter implements \Phalcon\Paginator\AdapterInterface
{
    /**
     * Configuration of the paginator
     */
    protected $_config = null;


    /**
     * Phalcon\Paginator\Adapter\NativeArray constructor
     *
     * @param array $config 
     */
    public function __construct($config) {}

    /**
     * Returns a slice of the resultset to show in the pagination
     *
     * @return \stdClass 
     */
    public function getPaginate() {}

}
