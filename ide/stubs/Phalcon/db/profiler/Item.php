<?php

namespace Phalcon\Db\Profiler;

/**
 * Phalcon\Db\Profiler\Item
 * This class identifies each profile in a Phalcon\Db\Profiler
 */
class Item
{
    /**
     * SQL statement related to the profile
     *
     * @var string
     */
    protected $_sqlStatement;

    /**
     * SQL variables related to the profile
     *
     * @var array
     */
    protected $_sqlVariables;

    /**
     * SQL bind types related to the profile
     *
     * @var array
     */
    protected $_sqlBindTypes;

    /**
     * Timestamp when the profile started
     *
     * @var double
     */
    protected $_initialTime;

    /**
     * Timestamp when the profile ended
     *
     * @var double
     */
    protected $_finalTime;


    /**
     * SQL statement related to the profile
     *
     * @param string $sqlStatement 
     */
    public function setSqlStatement($sqlStatement) {}

    /**
     * SQL statement related to the profile
     *
     * @return string 
     */
    public function getSqlStatement() {}

    /**
     * SQL variables related to the profile
     *
     * @param array $sqlVariables 
     */
    public function setSqlVariables(array $sqlVariables) {}

    /**
     * SQL variables related to the profile
     *
     * @return array 
     */
    public function getSqlVariables() {}

    /**
     * SQL bind types related to the profile
     *
     * @param array $sqlBindTypes 
     */
    public function setSqlBindTypes(array $sqlBindTypes) {}

    /**
     * SQL bind types related to the profile
     *
     * @return array 
     */
    public function getSqlBindTypes() {}

    /**
     * Timestamp when the profile started
     *
     * @param double $initialTime 
     */
    public function setInitialTime($initialTime) {}

    /**
     * Timestamp when the profile started
     *
     * @return double 
     */
    public function getInitialTime() {}

    /**
     * Timestamp when the profile ended
     *
     * @param double $finalTime 
     */
    public function setFinalTime($finalTime) {}

    /**
     * Timestamp when the profile ended
     *
     * @return double 
     */
    public function getFinalTime() {}

    /**
     * Returns the total time in seconds spent by the profile
     *
     * @return double 
     */
    public function getTotalElapsedSeconds() {}

}
