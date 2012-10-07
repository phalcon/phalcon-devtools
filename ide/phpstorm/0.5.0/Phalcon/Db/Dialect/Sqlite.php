<?php 

namespace Phalcon\Db\Dialect {

	/**
	 * Phalcon\Db\Dialect\Sqlite
	 *
	 * Generates database specific SQL for the Sqlite RBDM
	 */
	
	class Sqlite extends \Phalcon\Db\Dialect {

		/**
		 * Gets a list of columns
		 *
		 * @param array $columnList
		 * @return string
		 */
		public function getColumnList($columnList){ }


		/**
		 * Gets the column name in Sqlite
		 *
		 * @param \Phalcon\Db\Column $column
		 */
		public function getColumnDefinition($column){ }


		/**
		 * Generates SQL to add a column to a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param \Phalcon\Db\Column $column
		 * @return string
		 */
		public function addColumn(){ }


		/**
		 * Generates SQL to modify a column in a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param \Phalcon\Db\Column $column
		 * @return string
		 */
		public function modifyColumn(){ }


		/**
		 * Generates SQL to delete a column from a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param string $columnName
		 * @return 	string
		 */
		public function dropColumn(){ }


		/**
		 * Generates SQL to add an index to a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param \Phalcon\Db\Index $index
		 * @return string
		 */
		public function addIndex(){ }


		/**
		  * Generates SQL to delete an index from a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param string $indexName
		 * @return string
		 */
		public function dropIndex(){ }


		/**
		 * Generates SQL to add the primary key to a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param \Phalcon\Db\Index $index
		 * @return string
		 */
		public function addPrimaryKey(){ }


		/**
		 * Generates SQL to delete primary key from a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @return string
		 */
		public function dropPrimaryKey(){ }


		/**
		 * Generates SQL to add an index to a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param \Phalcon\Db\Reference $reference
		 * @return string
		 */
		public function addForeignKey(){ }


		/**
		 * Generates SQL to delete a foreign key from a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param string $referenceName
		 * @return string
		 */
		public function dropForeignKey(){ }


		/**
		 * Generates SQL to add the table creation options
		 *
		 * @param array $definition
		 * @return array
		 */
		protected function _getTableOptions(){ }


		/**
		 * Generates SQL to create a table in PostgreSQL
		 *
		 * @param 	string $tableName
		 * @param string $schemaName
		 * @param array $definition
		 * @return 	string
		 */
		public function createTable(){ }


		/**
		 * Generates SQL to drop a table
		 *
		 * @param  string $tableName
		 * @param  string $schemaName
		 * @param  boolean $ifExists
		 * @return boolean
		 */
		public function dropTable($tableName, $schemaName, $ifExists){ }


		/**
		 * Generates SQL checking for the existence of a schema.table
		 *
		 * <code>echo $dialect->tableExists("posts", "blog")</code>
		 * <code>echo $dialect->tableExists("posts")</code>
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @return string
		 */
		public function tableExists($tableName, $schemaName){ }


		/**
		 * Generates a SQL describing a table
		 *
		 * <code>print_r($dialect->describeColumns("posts") ?></code>
		 *
		 * @param string $table
		 * @param string $schema
		 * @return string
		 */
		public function describeColumns($table, $schema){ }


		/**
		 * List all tables on database
		 *
		 * <code>print_r($dialect->listTables("blog") ?></code>
		 *
		 * @param       string $schemaName
		 * @return      array
		 */
		public function listTables($schemaName){ }


		/**
		 * Generates SQL to query indexes on a table
		 *
		 * @param string $table
		 * @param string $schema
		 * @return string
		 */
		public function describeIndexes($table, $schema){ }


		/**
		 * Generates SQL to query indexes detail on a table
		 *
		 * @param string $indexName
		 * @return string
		 */
		public function describeIndex($indexName){ }


		/**
		 * Generates SQL to query foreign keys on a table
		 *
		 * @param string $table
		 * @param string $schema
		 * @return string
		 */
		public function describeReferences($table, $schema){ }


		/**
		 * Generates the SQL to describe the table creation options
		 *
		 * @param string $table
		 * @param string $schema
		 * @return string
		 */
		public function tableOptions($table, $schema){ }

	}
}
