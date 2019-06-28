<?php

namespace Phalcon\Test\Builder;

use Phalcon\Config;
use Phalcon\Builder\Model;
use Phalcon\Exception\RuntimeException;
use Phalcon\Test\Module\UnitTest;

/**
 * @coversDefaultClass \Phalcon\Builder\Model
 */
class ModelTest extends UnitTest
{

    public function testConstructor()
    {
        $this->specify('should set default options', function() {

            $model = new Model(
                [
                    'name' => 'test',
                    'config' => [],
                ]
            );

            $options = $model->getModelOptions()->getOptions();

            $this->assertSame($options['camelize'], false);
            $this->assertSame($options['force'], false);
            $this->assertSame($options['className'], 'Test');
            $this->assertSame($options['fileName'], 'Test');
            $this->assertSame($options['abstract'], false);
            $this->assertSame($options['annotate'], false);
        });
    }

    public function testGetSchema()
    {
        $this->specify('should get schema from modelOptions if exists and not empty', function() {
            $model = new Model(
                [
                    'name' => 'test',
                    'schema' => 'correct_schema',
                    'config' => new Config([
                        'database' => [
                            'schema' => 'wrong_schema'
                        ]
                    ]),
                ]
            );
            $this->assertSame('correct_schema', $model->getSchema());
        });

        $this->specify('should get schema from config->database if modelOptions schema is empty', function() {
            $model = new Model(
                [
                    'name' => 'test',
                    'schema' => '',
                    'config' => new Config([
                        'database' => [
                            'schema' => 'correct_schema'
                        ]
                    ]),
                ]
            );
            $this->assertSame('correct_schema', $model->getSchema());
        });

        $this->specify('should get schema from config->database if modelOptions schema is empty', function() {
            $model = new Model(
                [
                    'name' => 'test',
                    'schema' => null,
                    'config' => new Config([
                        'database' => [
                            'schema' => 'correct_schema'
                        ]
                    ]),
                ]
            );
            $this->assertSame('correct_schema', $model->getSchema());
        });
    }

    /**
     * @expectedException RuntimeException
     */
    public function testGetSchemaThrows()
    {
        $model = new Model(
            [
                'name' => 'test',
                'schema' => '',
                'config' => new Config([
                    'database' => [
                        'schema' => ''
                    ]
                ]),
            ]
        );
        $model->getSchema();
    }

    public function testShouldInitSchema()
    {
        $this->specify('should not init if modelOption schema is ""', function (){
            $model = new Model(
                [
                    'name' => 'test',
                    'schema' => '',
                    'config' => new Config([
                        'database' => [
                            'schema' => 'correct_schema'
                        ]
                    ]),
                ]
            );
            $this->assertFalse($model->shouldInitSchema());
        });

        $this->specify('should init schema when modelOption schema is not ""', function() {
            $model = new Model(
                [
                    'name' => 'test',
                    'schema' => 'correct_schema',
                    'config' => new Config([
                        'database' => [
                            'schema' => 'correct_schema'
                        ]
                    ]),
                ]
            );

            $this->assertTrue($model->shouldInitSchema());

            $model = new Model(
                [
                    'name' => 'test',
                    'schema' => null,
                    'config' => new Config([
                        'database' => [
                            'schema' => 'correct_schema'
                        ]
                    ]),
                ]
            );

            $this->assertTrue($model->shouldInitSchema());

            $model = new Model(
                [
                    'name' => 'test',
                    'config' => new Config([
                        'database' => [
                            'schema' => 'correct_schema'
                        ]
                    ]),
                ]
            );

            $this->assertTrue($model->shouldInitSchema());
        });
    }
}
