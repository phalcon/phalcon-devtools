<?php

namespace Phalcon\Db;

/**
 * Phalcon\Db\Reference
 *
 * Interface for Phalcon\Db\Reference
 */
interface ReferenceInterface
{

    /**
     * Gets the index name
     *
     * @return string
     */
    public function getName();

    /**
     * Gets the schema where referenced table is
     *
     * @return string
     */
    public function getSchemaName();

    /**
     * Gets the schema where referenced table is
     *
     * @return string
     */
    public function getReferencedSchema();

    /**
     * Gets local columns which reference is based
     *
     * @return array
     */
    public function getColumns();

    /**
     * Gets the referenced table
     *
     * @return string
     */
    public function getReferencedTable();

    /**
     * Gets referenced columns
     *
     * @return array
     */
    public function getReferencedColumns();

    /**
     * Gets the referenced on delete
     *
     * @return string
     */
    public function getOnDelete();

    /**
     * Gets the referenced on update
     *
     * @return string
     */
    public function getOnUpdate();

    /**
     * Restore a Phalcon\Db\Reference object from export
     *
     * @param array $data
     * @return ReferenceInterface
     */
    public static function __set_state(array $data);

}
