<?php 

namespace Phalcon\Db {    interface ReferenceInterface
        {

        public function getName();


        public function getSchemaName();


        public function getReferencedSchema();


        public function getColumns();


        public function getReferencedTable();


        public function getReferencedColumns();

    }
}
