<?php 

namespace Phalcon\Db\Dialect {

	/**
	 * Phalcon\Db\Dialect\Oracle
	 *
	 * Generates database specific SQL for the Oracle RBDM
	 */
	
	class Oracle extends \Phalcon\Db\Dialect implements \Phalcon\Db\DialectInterface {

		protected $_escapeChar;

		/**
		 * Gets the column name in Oracle
		 *
		 * @param \Phalcon\Db\ColumnInterface $column
		 * @return string
		 */
		public function getColumnDefinition($column){ }


		/**
		 * Generates SQL to add a column to a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param \Phalcon\Db\ColumnInterface $column
		 * @return string
		 */
		public function addColumn($tableName, $schemaName, $column){ }


		/**
		 * Generates SQL to modify a column in a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param \Phalcon\Db\ColumnInterface $column
		 * @return string
		 */
		public function modifyColumn($tableName, $schemaName, $column){ }


		/**
		 * Generates SQL to delete a column from a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param string $columnName
		 * @return 	string
		 */
		public function dropColumn($tableName, $schemaName, $columnName){ }


		/**
		 * Generates SQL to add an index to a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param \Phalcon\Db\Index $index
		 * @return string
		 */
		public function addIndex($tableName, $schemaName, $index){ }


		/**
		 * Generates SQL to delete an index from a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param string $indexName
		 * @return string
		 */
		public function dropIndex($tableName, $schemaName, $indexName){ }


		/**
		 * Generates SQL to add the primary key to a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param \Phalcon\Db\Index $index
		 * @return string
		 */
		public function addPrimaryKey($tableName, $schemaName, $index){ }


		/**
		 * Generates SQL to delete primary key from a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @return string
		 */
		public function dropPrimaryKey($tableName, $schemaName){ }


		/**
		 * Generates SQL to add an index to a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param \Phalcon\Db\ReferenceInterface $reference
		 * @return string
		 */
		public function addForeignKey($tableName, $schemaName, $reference){ }


		/**
		 * Generates SQL to delete a foreign key from a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param string $referenceName
		 * @return string
		 */
		public function dropForeignKey($tableName, $schemaName, $referenceName){ }


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
		public function createTable($tableName, $schemaName, $definition){ }


		/**
		 * Generates SQL to drop a table
		 *
		 * @param  string $tableName
		 * @param  string $schemaName
		 * @param  boolean $ifExists
		 * @return boolean
		 */
		public function dropTable($tableName, $schemaName, $ifExists=null){ }


		/**
		 * Generates SQL to create a view
		 *
		 * @param string $viewName
		 * @param array $definition
		 * @param string $schemaName
		 * @return string
		 */
		public function createView($viewName, $definition, $schemaName){ }


		/**
		 * Generates SQL to drop a view
		 *
		 * @param string $viewName
		 * @param string $schemaName
		 * @param boolean $ifExists
		 * @return string
		 */
		public function dropView($viewName, $schemaName, $ifExists=null){ }


		/**
		 * Generates SQL checking for the existence of a schema.table
		 *
		 *<code>
		 *	var_dump($dialect->tableExists("posts", "blog"));
		 *	var_dump($dialect->tableExists("posts"));
		 *</code>
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @return string
		 */
		public function tableExists($tableName, $schemaName=null){ }


		/**
		 * Generates SQL checking for the existence of a schema.view
		 *
		 * @param string $viewName
		 * @param string $schemaName
		 * @return string
		 */
		public function viewExists($viewName, $schemaName=null){ }


		/**
		 * Generates a SQL describing a table
		 *
		 *<code>
		 *	print_r($dialect->describeColumns("posts")); ?>
		 *</code>
		 *
		 * @param string $table
		 * @param string $schema
		 * @return string
		 */
		public function describeColumns($table, $schema=null){ }


		/**
		 * List all tables on database
		 *
		 *<code>
		 *	print_r($dialect->listTables("blog")) ?>
		 *</code>
		 *
		 * @param       string $schemaName
		 * @return      array
		 */
		public function listTables($schemaName=null){ }


		/**
		 * Generates the SQL to list all views of a schema or user
		 *
		 * @param string $schemaName
		 * @return array
		 */
		public function listViews($schemaName=null){ }


		/**
		 * Generates SQL to query indexes on a table
		 *
		 * @param string $table
		 * @param string $schema
		 * @return string
		 */
		public function describeIndexes($table, $schema=null){ }


		/**
		 * Generates SQL to query foreign keys on a table
		 *
		 * @param string $table
		 * @param string $schema
		 * @return string
		 */
		public function describeReferences($table, $schema=null){ }


		/**
		 * Generates the SQL to describe the table creation options
		 *
		 * @param string $table
		 * @param string $schema
		 * @return string
		 */
		public function tableOptions($table, $schema=null){ }


		/**
		 * Transform an intermediate representation for a schema/table into a database system valid expression
		 *
		 * @param array $table
		 * @param string $escapeChar
		 * @return string
		 */
		public function getSqlTable($table, $escapeChar=null){ }


		/**
		 * Generates the SQL for LIMIT clause
		 *
		 *<code>
		 * $sql = $dialect->limit('SELECT * FROM robots', 10);
		 * echo $sql; // SELECT * FROM robots LIMIT 10
		 *</code>
		 *
		 * @param string $sqlQuery
		 * @param int $number
		 * @return string
		 */
		public function limit($sqlQuery, $number){ }


		/**
		 * Builds a SELECT statement
		 *
		 * @param array $definition
		 * @return string
		 */
		public function select($definition){ }


		/**
		 * Checks whether the platform supports savepoints
		 *
		 * @return boolean
		 */
		public function supportsSavepoints(){ }


		/**
		 * Checks whether the platform supports releasing savepoints.
		 *
		 * @return boolean
		 */
		public function supportsReleaseSavepoints(){ }

	}
}
