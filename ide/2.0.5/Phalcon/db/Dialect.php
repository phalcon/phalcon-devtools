<?php

namespace Phalcon\Db;

/**
 * Phalcon\Db\Dialect
 * This is the base class to each database dialect. This implements
 * common methods to transform intermediate code into its RDBMS related syntax
 */
abstract class Dialect implements \Phalcon\Db\DialectInterface
{

    protected $_escapeChar;


    protected $_customFunctions;


    /**
     * Registers custom SQL functions
     *
     * @param string $name 
     * @param callable $customFunction 
     * @return Dialect 
     */
    public function registerCustomFunction($name, $customFunction) {}

    /**
     * Returns registered functions
     *
     * @return array 
     */
    public function getCustomFunctions() {}

    /**
     * Escape identifiers
     *
     * @param string $str 
     * @param string $escapeChar 
     * @return string 
     */
    public final function escape($str, $escapeChar = null) {}

    /**
     * Generates the SQL for LIMIT clause
     * <code>
     * $sql = $dialect->limit('SELECTFROM robots', 10);
     * echo $sql; // SELECTFROM robots LIMIT 10
     * $sql = $dialect->limit('SELECTFROM robots', [10, 50]);
     * echo $sql; // SELECTFROM robots LIMIT 10 OFFSET 50
     * </code>
     *
     * @param string $sqlQuery 
     * @param mixed $number 
     * @return string 
     */
    public function limit($sqlQuery, $number) {}

    /**
     * Returns a SQL modified with a FOR UPDATE clause
     * <code>
     * $sql = $dialect->forUpdate('SELECTFROM robots');
     * echo $sql; // SELECTFROM robots FOR UPDATE
     * </code>
     *
     * @param string $sqlQuery 
     * @return string 
     */
    public function forUpdate($sqlQuery) {}

    /**
     * Returns a SQL modified with a LOCK IN SHARE MODE clause
     * <code>
     * $sql = $dialect->sharedLock('SELECTFROM robots');
     * echo $sql; // SELECTFROM robots LOCK IN SHARE MODE
     * </code>
     *
     * @param string $sqlQuery 
     * @return string 
     */
    public function sharedLock($sqlQuery) {}

    /**
     * Gets a list of columns with escaped identifiers
     * <code>
     * echo $dialect->getColumnList(array('column1', 'column'));
     * </code>
     *
     * @param array $columnList 
     * @param string $escapeChar 
     * @param mixed $bindCounts 
     * @return string 
     */
    public final function getColumnList($columnList, $escapeChar = null, $bindCounts = null) {}

    /**
     * Resolve Column expressions
     *
     * @param mixed $column 
     * @param string $escapeChar 
     * @param mixed $bindCounts 
     * @return string 
     */
    public final function getSqlColumn($column, $escapeChar = null, $bindCounts = null) {}

    /**
     * Transforms an intermediate representation for a expression into a database system valid expression
     *
     * @param array $expression 
     * @param string $escapeChar 
     * @param mixed $bindCounts 
     * @return string 
     */
    public function getSqlExpression($expression, $escapeChar = null, $bindCounts = null) {}

    /**
     * Transform an intermediate representation of a schema/table into a database system valid expression
     *
     * @param mixed $table 
     * @param string $escapeChar 
     * @return string 
     */
    public final function getSqlTable($table, $escapeChar = null) {}

    /**
     * Builds a SELECT statement
     *
     * @param array $definition 
     * @return string 
     */
    public function select($definition) {}

    /**
     * Checks whether the platform supports savepoints
     *
     * @return bool 
     */
    public function supportsSavepoints() {}

    /**
     * Checks whether the platform supports releasing savepoints.
     *
     * @return bool 
     */
    public function supportsReleaseSavepoints() {}

    /**
     * Generate SQL to create a new savepoint
     *
     * @param string $name 
     * @return string 
     */
    public function createSavepoint($name) {}

    /**
     * Generate SQL to release a savepoint
     *
     * @param string $name 
     * @return string 
     */
    public function releaseSavepoint($name) {}

    /**
     * Generate SQL to rollback a savepoint
     *
     * @param string $name 
     * @return string 
     */
    public function rollbackSavepoint($name) {}

    /**
     * Resolve Column expressions
     *
     * @param array $expression 
     * @param string $escapeChar 
     * @param mixed $bindCounts 
     * @return string 
     */
    protected final function getSqlExpressionScalar($expression, $escapeChar = null, $bindCounts = null) {}

    /**
     * Resolve object expressions
     *
     * @param array $expression 
     * @param string $escapeChar 
     * @param mixed $bindCounts 
     * @return string 
     */
    protected final function getSqlExpressionObject($expression, $escapeChar = null, $bindCounts = null) {}

    /**
     * Resolve qualified expressions
     *
     * @param array $expression 
     * @param string $escapeChar 
     * @return string 
     */
    protected final function getSqlExpressionQualified($expression, $escapeChar = null) {}

    /**
     * Resolve binary operations expressions
     *
     * @param array $expression 
     * @param string $escapeChar 
     * @param mixed $bindCounts 
     * @return string 
     */
    protected final function getSqlExpressionBinaryOperations($expression, $escapeChar = null, $bindCounts = null) {}

    /**
     * Resolve unary operations expressions
     *
     * @param array $expression 
     * @param string $escapeChar 
     * @param mixed $bindCounts 
     * @return string 
     */
    protected final function getSqlExpressionUnaryOperations($expression, $escapeChar = null, $bindCounts = null) {}

    /**
     * Resolve function calls
     *
     * @param array $expression 
     * @param string $escapeChar 
     * @param mixed $bindCounts 
     * @return string 
     */
    protected final function getSqlExpressionFunctionCall($expression, $escapeChar = null, $bindCounts) {}

    /**
     * Resolve Lists
     *
     * @param array $expression 
     * @param string $escapeChar 
     * @param mixed $bindCounts 
     * @return string 
     */
    protected final function getSqlExpressionList($expression, $escapeChar = null, $bindCounts = null) {}

    /**
     * Resolve
     *
     * @param array $expression 
     * @param string $escapeChar 
     * @return string 
     */
    protected final function getSqlExpressionAll($expression, $escapeChar = null) {}

    /**
     * Resolve CAST of values
     *
     * @param array $expression 
     * @param string $escapeChar 
     * @param mixed $bindCounts 
     * @return string 
     */
    protected final function getSqlExpressionCastValue($expression, $escapeChar = null, $bindCounts = null) {}

    /**
     * Resolve CONVERT of values encodings
     *
     * @param array $expression 
     * @param string $escapeChar 
     * @param mixed $bindCounts 
     * @return string 
     */
    protected final function getSqlExpressionConvertValue($expression, $escapeChar = null, $bindCounts = null) {}

    /**
     * Resolve CASE expressions
     *
     * @param array $expression 
     * @param string $escapeChar 
     * @param mixed $bindCounts 
     * @return string 
     */
    protected final function getSqlExpressionCase($expression, $escapeChar = null, $bindCounts = null) {}

    /**
     * Resolve a FROM clause
     *
     * @param mixed $expression 
     * @param string $escapeChar 
     * @return string 
     */
    protected final function getSqlExpressionFrom($expression, $escapeChar = null) {}

    /**
     * Resolve a JOINs clause
     *
     * @param mixed $expression 
     * @param string $escapeChar 
     * @param mixed $bindCounts 
     * @return string 
     */
    protected final function getSqlExpressionJoins($expression, $escapeChar = null, $bindCounts = null) {}

    /**
     * Resolve a WHERE clause
     *
     * @param mixed $expression 
     * @param string $escapeChar 
     * @param mixed $bindCounts 
     * @return string 
     */
    protected final function getSqlExpressionWhere($expression, $escapeChar = null, $bindCounts = null) {}

    /**
     * Resolve a GROUP BY clause
     *
     * @param mixed $expression 
     * @param string $escapeChar 
     * @param mixed $bindCounts 
     * @return string 
     */
    protected final function getSqlExpressionGroupBy($expression, $escapeChar = null, $bindCounts = null) {}

    /**
     * Resolve a HAVING clause
     *
     * @param mixed $expression 
     * @param string $escapeChar 
     * @param mixed $bindCounts 
     * @return string 
     */
    protected final function getSqlExpressionHaving($expression, $escapeChar = null, $bindCounts = null) {}

    /**
     * Resolve a ORDER BY clause
     *
     * @param mixed $expression 
     * @param string $escapeChar 
     * @param mixed $bindCounts 
     * @return string 
     */
    protected final function getSqlExpressionOrderBy($expression, $escapeChar = null, $bindCounts = null) {}

    /**
     * Resolve a LIMIT clause
     *
     * @param mixed $expression 
     * @param string $escapeChar 
     * @param mixed $bindCounts 
     * @return string 
     */
    protected final function getSqlExpressionLimit($expression, $escapeChar = null, $bindCounts = null) {}

    /**
     * Prepares column for this RDBMS
     *
     * @param string $qualified 
     * @param string $alias 
     * @param string $escapeChar 
     * @return string 
     */
    protected function prepareColumnAlias($qualified, $alias = null, $escapeChar = null) {}

    /**
     * Prepares table for this RDBMS
     *
     * @param string $table 
     * @param string $schema 
     * @param string $alias 
     * @param string $escapeChar 
     * @return string 
     */
    protected function prepareTable($table, $schema = null, $alias = null, $escapeChar = null) {}

    /**
     * Prepares qualified for this RDBMS
     *
     * @param string $column 
     * @param string $domain 
     * @param string $escapeChar 
     * @return string 
     */
    protected function prepareQualified($column, $domain = null, $escapeChar = null) {}

}
