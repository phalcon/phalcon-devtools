<?php

namespace Phalcon\Paginator\Adapter;

/**
 * Phalcon\Paginator\Adapter\QueryBuilder
 * Pagination using a PHQL query builder as source of data
 * <code>
 * use Phalcon\Paginator\Adapter\QueryBuilder;
 * $builder = $this->modelsManager->createBuilder()
 * ->columns('id, name')
 * ->from('Robots')
 * ->orderBy('name');
 * $paginator = new QueryBuilder(
 * [
 * 'builder' => $builder,
 * 'limit'   => 20,
 * 'page'    => 1,
 * ]
 * );
 * </code>
 */
class QueryBuilder extends \Phalcon\Paginator\Adapter implements \Phalcon\Paginator\AdapterInterface
{
    /**
     * Configuration of paginator by model
     */
    protected $_config;

    /**
     * Paginator's data
     */
    protected $_builder;


    /**
     * Phalcon\Paginator\Adapter\QueryBuilder
     *
     * @param array $config 
     */
    public function __construct(array $config) {}

    /**
     * Get the current page number
     *
     * @return int 
     */
    public function getCurrentPage() {}

    /**
     * Set query builder object
     *
     * @param mixed $builder 
     * @return QueryBuilder 
     */
    public function setQueryBuilder(\Phalcon\Mvc\Model\Query\Builder $builder) {}

    /**
     * Get query builder object
     *
     * @return \Phalcon\Mvc\Model\Query\Builder 
     */
    public function getQueryBuilder() {}

    /**
     * Returns a slice of the resultset to show in the pagination
     *
     * @return \stdClass 
     */
    public function getPaginate() {}

}
