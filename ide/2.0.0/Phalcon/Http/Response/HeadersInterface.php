<?php 

namespace Phalcon\Http\Response {    interface HeadersInterface
        {

        public function set($name, $value);


        public function get($name);


        public function setRaw($header);


        public function send();


        public function reset();


        public function toArray();

    }
}
