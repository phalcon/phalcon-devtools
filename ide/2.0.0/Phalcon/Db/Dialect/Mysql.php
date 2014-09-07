<?php 

namespace Phalcon\Db\Dialect {    class Mysql extends \Phalcon\Db\Dialect implements \Phalcon\Db\DialectInterface
    {

        protected $_escapeChar;

        public function getColumnDefinition($column)
        {
        }


        public function addColumn($tableName, $schemaName, $column)
        {
        }


        public function modifyColumn($tableName, $schemaName, $column)
        {
        }


        public function dropColumn($tableName, $schemaName, $columnName)
        {
        }


        public function addIndex($tableName, $schemaName, $index)
        {
        }


        public function dropIndex($tableName, $schemaName, $indexName)
        {
        }


        public function addPrimaryKey($tableName, $schemaName, $index)
        {
        }


        public function dropPrimaryKey($tableName, $schemaName)
        {
        }


        public function addForeignKey($tableName, $schemaName, $reference)
        {
        }


        public function dropForeignKey($tableName, $schemaName, $referenceName)
        {
        }


        protected function _getTableOptions()
        {
        }


        public function createTable($tableName, $schemaName, $definition)
        {
        }


        public function dropTable($tableName, $schemaName)
        {
        }


        public function createView($viewName, $definition, $schemaName)
        {
        }


        public function dropView($viewName, $schemaName, $ifExists=null)
        {
        }


        public function tableExists($tableName, $schemaName=null)
        {
        }


        public function viewExists($viewName, $schemaName=null)
        {
        }


        public function describeColumns($table, $schema=null)
        {
        }


        public function listTables($schemaName=null)
        {
        }


        public function listViews($schemaName=null)
        {
        }


        public function describeIndexes($table, $schema=null)
        {
        }


        public function describeReferences($table, $schema=null)
        {
        }


        public function tableOptions($table, $schema=null)
        {
        }

    }
}
