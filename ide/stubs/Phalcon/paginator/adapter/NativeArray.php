<?php

namespace Phalcon\Paginator\Adapter;

/**
 * Phalcon\Paginator\Adapter\NativeArray
 * Pagination using a PHP array as source of data
 * <code>
 * use Phalcon\Paginator\Adapter\NativeArray;
 * $paginator = new NativeArray(
 * [
 * 'data'  => array(
 * ['id' => 1, 'name' => 'Artichoke'],
 * ['id' => 2, 'name' => 'Carrots'],
 * ['id' => 3, 'name' => 'Beet'],
 * ['id' => 4, 'name' => 'Lettuce'],
 * ['id' => 5, 'name' => '']
 * ],
 * 'limit' => 2,
 * 'page'  => $currentPage,
 * ]
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
    public function __construct(array $config) {}

    /**
     * Returns a slice of the resultset to show in the pagination
     *
     * @return \stdClass 
     */
    public function getPaginate() {}

}
