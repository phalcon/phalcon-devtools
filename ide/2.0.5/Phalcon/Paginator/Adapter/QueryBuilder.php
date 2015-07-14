<?php

namespace Phalcon\Paginator\Adapter;

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Paginator\Adapter;
use Phalcon\Paginator\AdapterInterface;
use Phalcon\Paginator\Exception;


class QueryBuilder extends Adapter implements AdapterInterface
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
	 * @param Builder $builder
	 *
	 * @return QueryBuilder
	 */
	public function setQueryBuilder(Builder $builder) {}

	/**
	 * Get query builder object
	 *
	 * @return Builder
	 */
	public function getQueryBuilder() {}

	/**
	 * Returns a slice of the resultset to show in the pagination
	 *
	 * @return \stdClass
	 */
	public function getPaginate() {}

}
