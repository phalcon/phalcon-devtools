<?php 

namespace Phalcon\Image {

    /**
     * Lacks of documentation
     */
    interface AdapterInterface
        {

        public function resize($width=null, $height=null, $master=null);


        public function crop($width, $height, $offset_x=null, $offset_y=null);


        public function rotate($degrees);


        public function flip($direction);


        public function sharpen($amount);


        public function reflection($height, $opacity=null, $fade_in=null);


        public function watermark($watermark, $offset_x=null, $offset_y=null, $opacity=null);


        public function text($text, $offset_x=null, $offset_y=null, $opacity=null, $color=null, $size=null, $fontfile=null);


        public function mask($watermark);


        public function background($color, $opacity=null);


        public function blur($radius);


        public function pixelate($amount);


        public function save($file=null, $quality=null);


        public function render($ext=null, $quality=null);

    }
}
