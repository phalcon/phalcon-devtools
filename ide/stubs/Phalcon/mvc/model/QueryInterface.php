<?php

namespace Phalcon\Mvc\Model;

/**
 * Phalcon\Mvc\Model\QueryInterface
 *
 * Interface for Phalcon\Mvc\Model\Query
 */
interface QueryInterface
{

    /**
     * Parses the intermediate code produced by Phalcon\Mvc\Model\Query\Lang generating another
     * intermediate representation that could be executed by Phalcon\Mvc\Model\Query
     *
     * @return array
     */
    public function parse();

    /**
     * Sets the cache parameters of the query
     *
     * @param array $cacheOptions
     * @return \Phalcon\Mvc\Model\Query
     */
    public function cache($cacheOptions);

    /**
     * Returns the current cache options
     *
     * @param array
     */
    public function getCacheOptions();

    /**
     * Tells to the query if only the first row in the resultset must be returned
     *
     * @param boolean $uniqueRow
     * @return \Phalcon\Mvc\Model\Query
     */
    public function setUniqueRow($uniqueRow);

    /**
     * Check if the query is programmed to get only the first row in the resultset
     *
     * @return boolean
     */
    public function getUniqueRow();

    /**
     * Executes a parsed PHQL statement
     *
     * @param array $bindParams
     * @param array $bindTypes
     * @return mixed
     */
    public function execute($bindParams = null, $bindTypes = null);

}
