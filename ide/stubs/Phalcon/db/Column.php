<?php

namespace Phalcon\Db;

/**
 * Phalcon\Db\Column
 * Allows to define columns to be used on create or alter table operations
 * <code>
 * use Phalcon\Db\Column as Column;
 * //column definition
 * $column = new Column("id", array(
 * "type" => Column::TYPE_INTEGER,
 * "size" => 10,
 * "unsigned" => true,
 * "notNull" => true,
 * "autoIncrement" => true,
 * "first" => true
 * ));
 * //add column to existing table
 * $connection->addColumn("robots", null, $column);
 * </code>
 */
class Column implements \Phalcon\Db\ColumnInterface
{
    /**
     * Integer abstract type
     */
    const TYPE_INTEGER = 0;

    /**
     * Date abstract type
     */
    const TYPE_DATE = 1;

    /**
     * Varchar abstract type
     */
    const TYPE_VARCHAR = 2;

    /**
     * Decimal abstract type
     */
    const TYPE_DECIMAL = 3;

    /**
     * Datetime abstract type
     */
    const TYPE_DATETIME = 4;

    /**
     * Char abstract type
     */
    const TYPE_CHAR = 5;

    /**
     * Text abstract data type
     */
    const TYPE_TEXT = 6;

    /**
     * Float abstract data type
     */
    const TYPE_FLOAT = 7;

    /**
     * Boolean abstract data type
     */
    const TYPE_BOOLEAN = 8;

    /**
     * Double abstract data type
     */
    const TYPE_DOUBLE = 9;

    /**
     * Tinyblob abstract data type
     */
    const TYPE_TINYBLOB = 10;

    /**
     * Blob abstract data type
     */
    const TYPE_BLOB = 11;

    /**
     * Mediumblob abstract data type
     */
    const TYPE_MEDIUMBLOB = 12;

    /**
     * Longblob abstract data type
     */
    const TYPE_LONGBLOB = 13;

    /**
     * Big integer abstract type
     */
    const TYPE_BIGINTEGER = 14;

    /**
     * Json abstract type
     */
    const TYPE_JSON = 15;

    /**
     * Jsonb abstract type
     */
    const TYPE_JSONB = 16;

    /**
     * Datetime abstract type
     */
    const TYPE_TIMESTAMP = 17;

    /**
     * Bind Type Null
     */
    const BIND_PARAM_NULL = 0;

    /**
     * Bind Type Integer
     */
    const BIND_PARAM_INT = 1;

    /**
     * Bind Type String
     */
    const BIND_PARAM_STR = 2;

    /**
     * Bind Type Blob
     */
    const BIND_PARAM_BLOB = 3;

    /**
     * Bind Type Bool
     */
    const BIND_PARAM_BOOL = 5;

    /**
     * Bind Type Decimal
     */
    const BIND_PARAM_DECIMAL = 32;

    /**
     * Skip binding by type
     */
    const BIND_SKIP = 1024;

    /**
     * Column's name
     *
     * @var string
     */
    protected $_name;

    /**
     * Schema which table related is
     *
     * @var string
     */
    protected $_schemaName;

    /**
     * Column data type
     *
     * @var int|string
     */
    protected $_type;

    /**
     * Column data type reference
     *
     * @var int
     */
    protected $_typeReference = -1;

    /**
     * Column data type values
     *
     * @var array|string
     */
    protected $_typeValues;

    /**
     * The column have some numeric type?
     */
    protected $_isNumeric = false;

    /**
     * Integer column size
     *
     * @var int
     */
    protected $_size = 0;

    /**
     * Integer column number scale
     *
     * @var int
     */
    protected $_scale = 0;

    /**
     * Default column value
     */
    protected $_default = null;

    /**
     * Integer column unsigned?
     *
     * @var boolean
     */
    protected $_unsigned = false;

    /**
     * Column not nullable?
     *
     * @var boolean
     */
    protected $_notNull = false;

    /**
     * Column is part of the primary key?
     */
    protected $_primary = false;

    /**
     * Column is autoIncrement?
     *
     * @var boolean
     */
    protected $_autoIncrement = false;

    /**
     * Position is first
     *
     * @var boolean
     */
    protected $_first = false;

    /**
     * Column Position
     *
     * @var string
     */
    protected $_after;

    /**
     * Bind Type
     */
    protected $_bindType = 2;


    /**
     * Column's name
     *
     * @return string 
     */
    public function getName() {}

    /**
     * Schema which table related is
     *
     * @return string 
     */
    public function getSchemaName() {}

    /**
     * Column data type
     *
     * @return int|string 
     */
    public function getType() {}

    /**
     * Column data type reference
     *
     * @return int 
     */
    public function getTypeReference() {}

    /**
     * Column data type values
     *
     * @return array|string 
     */
    public function getTypeValues() {}

    /**
     * Integer column size
     *
     * @return int 
     */
    public function getSize() {}

    /**
     * Integer column number scale
     *
     * @return int 
     */
    public function getScale() {}

    /**
     * Default column value
     */
    public function getDefault() {}

    /**
     * Phalcon\Db\Column constructor
     *
     * @param string $name 
     * @param array $definition 
     */
    public function __construct($name, array $definition) {}

    /**
     * Returns true if number column is unsigned
     *
     * @return bool 
     */
    public function isUnsigned() {}

    /**
     * Not null
     *
     * @return bool 
     */
    public function isNotNull() {}

    /**
     * Column is part of the primary key?
     *
     * @return bool 
     */
    public function isPrimary() {}

    /**
     * Auto-Increment
     *
     * @return bool 
     */
    public function isAutoIncrement() {}

    /**
     * Check whether column have an numeric type
     *
     * @return bool 
     */
    public function isNumeric() {}

    /**
     * Check whether column have first position in table
     *
     * @return bool 
     */
    public function isFirst() {}

    /**
     * Check whether field absolute to position in table
     *
     * @return string 
     */
    public function getAfterPosition() {}

    /**
     * Returns the type of bind handling
     *
     * @return int 
     */
    public function getBindType() {}

    /**
     * Restores the internal state of a Phalcon\Db\Column object
     *
     * @param array $data 
     * @return Column 
     */
    public static function __set_state(array $data) {}

    /**
     * Check whether column has default value
     *
     * @return bool 
     */
    public function hasDefault() {}

}
