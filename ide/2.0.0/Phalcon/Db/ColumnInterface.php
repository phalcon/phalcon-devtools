<?php 

namespace Phalcon\Db {    interface ColumnInterface
        {

        public function getSchemaName();


        public function getName();


        public function getType();


        public function getSize();


        public function getScale();


        public function isUnsigned();


        public function isNotNull();


        public function isPrimary();


        public function isAutoIncrement();


        public function isNumeric();


        public function isFirst();


        public function getAfterPosition();


        public function getBindType();

    }
}
