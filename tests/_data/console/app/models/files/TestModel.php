<?php

class TestModel extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="id", type="integer", length=10, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(column="some-col", type="string", length=20, nullable=false)
     */
    public $someCol;

    /**
     *
     * @var string
     * @Column(column="someCol2", type="string", length=20, nullable=false)
     */
    public $someCol2;

    /**
     *
     * @var string
     * @Column(column="SomeCol3", type="string", length=20, nullable=false)
     */
    public $someCol3;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("devtools");
        $this->setSource("testModel");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'testModel';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return TestModel[]|TestModel|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return TestModel|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
