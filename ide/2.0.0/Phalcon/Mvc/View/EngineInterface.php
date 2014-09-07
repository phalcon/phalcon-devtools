<?php 

namespace Phalcon\Mvc\View {    interface EngineInterface
        {

        public function getContent();


        public function partial($partialPath);


        public function render($path, $params, $mustClean=null);

    }
}
