<?php 

namespace Phalcon\Annotations {

    /**
     * Lacks of documentation
     */
    interface ReaderInterface
        {

        public function parse($className);


        public static function parseDocBlock($docBlock, $file=null, $line=null);

    }
}
