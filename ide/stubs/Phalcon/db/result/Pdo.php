<?php

namespace Phalcon\Db\Result;

/**
 * Phalcon\Db\Result\Pdo
 *
 * Encapsulates the resultset internals
 *
 * <code>
 * $result = $connection->query("SELECT FROM robots ORDER BY name");
 *
 * $result->setFetchMode(
 *     \Phalcon\Db::FETCH_NUM
 * );
 *
 * while ($robot = $result->fetchArray()) {
 *     print_r($robot);
 * }
 * </code>
 */
class Pdo implements \Phalcon\Db\ResultInterface
{

    protected $_connection;


    protected $_result;

    /**
     * Active fetch mode
     */
    protected $_fetchMode = Db::FETCH_OBJ;

    /**
     * Internal resultset
     *
     * @var \PDOStatement
     */
    protected $_pdoStatement;


    protected $_sqlStatement;


    protected $_bindParams;


    protected $_bindTypes;


    protected $_rowCount = false;


    /**
     * Phalcon\Db\Result\Pdo constructor
     *
     * @param \Phalcon\Db\AdapterInterface $connection
     * @param \PDOStatement $result
     * @param string $sqlStatement
     * @param array $bindParams
     * @param array $bindTypes
     */
    public function __construct(Db\AdapterInterface $connection, \PDOStatement $result, $sqlStatement = null, $bindParams = null, $bindTypes = null) {}

    /**
     * Allows to execute the statement again. Some database systems don't support scrollable cursors,
     * So, as cursors are forward only, we need to execute the cursor again to fetch rows from the begining
     *
     * @return bool
     */
    public function execute() {}

    /**
     * Fetches an array/object of strings that corresponds to the fetched row, or FALSE if there are no more rows.
     * This method is affected by the active fetch flag set using Phalcon\Db\Result\Pdo::setFetchMode
     *
     * <code>
     * $result = $connection->query("SELECT FROM robots ORDER BY name");
     *
     * $result->setFetchMode(
     *     \Phalcon\Db::FETCH_OBJ
     * );
     *
     * while ($robot = $result->fetch()) {
     *     echo $robot->name;
     * }
     * </code>
     *
     * @param mixed $fetchStyle
     * @param mixed $cursorOrientation
     * @param mixed $cursorOffset
     */
    public function fetch($fetchStyle = null, $cursorOrientation = null, $cursorOffset = null) {}

    /**
     * Returns an array of strings that corresponds to the fetched row, or FALSE if there are no more rows.
     * This method is affected by the active fetch flag set using Phalcon\Db\Result\Pdo::setFetchMode
     *
     * <code>
     * $result = $connection->query("SELECT FROM robots ORDER BY name");
     *
     * $result->setFetchMode(
     *     \Phalcon\Db::FETCH_NUM
     * );
     *
     * while ($robot = result->fetchArray()) {
     *     print_r($robot);
     * }
     * </code>
     */
    public function fetchArray() {}

    /**
     * Returns an array of arrays containing all the records in the result
     * This method is affected by the active fetch flag set using Phalcon\Db\Result\Pdo::setFetchMode
     *
     * <code>
     * $result = $connection->query(
     *     "SELECT FROM robots ORDER BY name"
     * );
     *
     * $robots = $result->fetchAll();
     * </code>
     *
     * @param mixed $fetchStyle
     * @param mixed $fetchArgument
     * @param mixed $ctorArgs
     * @return array
     */
    public function fetchAll($fetchStyle = null, $fetchArgument = null, $ctorArgs = null) {}

    /**
     * Gets number of rows returned by a resultset
     *
     * <code>
     * $result = $connection->query(
     *     "SELECT FROM robots ORDER BY name"
     * );
     *
     * echo "There are ", $result->numRows(), " rows in the resultset";
     * </code>
     *
     * @return int
     */
    public function numRows() {}

    /**
     * Moves internal resultset cursor to another position letting us to fetch a certain row
     *
     * <code>
     * $result = $connection->query(
     *     "SELECT FROM robots ORDER BY name"
     * );
     *
     * // Move to third row on result
     * $result->dataSeek(2);
     *
     * // Fetch third row
     * $row = $result->fetch();
     * </code>
     *
     * @param long $number
     */
    public function dataSeek($number) {}

    /**
     * Changes the fetching mode affecting Phalcon\Db\Result\Pdo::fetch()
     *
     * <code>
     * // Return array with integer indexes
     * $result->setFetchMode(
     *     \Phalcon\Db::FETCH_NUM
     * );
     *
     * // Return associative array without integer indexes
     * $result->setFetchMode(
     *     \Phalcon\Db::FETCH_ASSOC
     * );
     *
     * // Return associative array together with integer indexes
     * $result->setFetchMode(
     *     \Phalcon\Db::FETCH_BOTH
     * );
     *
     * // Return an object
     * $result->setFetchMode(
     *     \Phalcon\Db::FETCH_OBJ
     * );
     * </code>
     *
     * @param int $fetchMode
     * @param mixed $colNoOrClassNameOrObject
     * @param mixed $ctorargs
     * @return bool
     */
    public function setFetchMode($fetchMode, $colNoOrClassNameOrObject = null, $ctorargs = null) {}

    /**
     * Gets the internal PDO result object
     *
     * @return \PDOStatement
     */
    public function getInternalResult() {}

}
