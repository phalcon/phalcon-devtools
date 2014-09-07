<?php 

namespace Phalcon\Image {    abstract class Adapter implements \Phalcon\Image\AdapterInterface
    {

        protected $_image;

        protected static $_checked;

        protected $_file;

        protected $_realpath;

        protected $_width;

        protected $_height;

        protected $_type;

        protected $_mime;

        public function getRealPath()
        {
        }


        public function getWidth()
        {
        }


        public function getHeight()
        {
        }


        public function getType()
        {
        }


        public function getMime()
        {
        }


        public function getImage()
        {
        }


        /**
         * Resize the image to the given size
         *
         * @param int width
         * @param int height
         * @param int master
         * @return \Phalcon\Image\Adapter
         */
        public function resize($width=null, $height=null, $master=null)
        {
        }


        public function liquidRescale($width, $height, $delta_x=null, $rigidity=null)
        {
        }


        /**
         * Crop an image to the given size
         *
         * @param int width
         * @param int height
         * @param int offset_x
         * @param int offset_y
         * @return \Phalcon\Image\Adapter
         */
        public function crop($width, $height, $offset_x=null, $offset_y=null)
        {
        }


        /**
         * Rotate the image by a given amount
         *
         * @param int degrees
         * @return \Phalcon\Image\Adapter
         */
        public function rotate($degrees)
        {
        }


        /**
         * Flip the image along the horizontal or vertical axis
         *
         * @param int direction
         * @return \Phalcon\Image\Adapter
         */
        public function flip($direction)
        {
        }


        /**
         * Sharpen the image by a given amount
         *
         * @param int amount
         * @return \Phalcon\Image\Adapter
         */
        public function sharpen($amount)
        {
        }


        /**
         * Add a reflection to an image
         *
         * @param int height
         * @param int opacity
         * @param boolean fade_in
         * @return \Phalcon\Image\Adapter
         */
        public function reflection($height=null, $opacity=null, $fade_in=null)
        {
        }


        /**
         * Add a watermark to an image with a specified opacity
         *
         * @param \Phalcon\Image\Adapter watermark
         * @param int offset_x
         * @param int offset_y
         * @param int opacity
         * @return \Phalcon\Image\Adapter
         */
        public function watermark($watermark, $offset_x=null, $offset_y=null, $opacity=null)
        {
        }


        /**
         * Add a text to an image with a specified opacity
         *
         * @param string text
         * @param int offset_x
         * @param int offset_y
         * @param int opacity
         * @param string color
         * @param int size
         * @param string fontfile
         * @return \Phalcon\Image\Adapter
         */
        public function text($text, $offset_x=null, $offset_y=null, $opacity=null, $color=null, $size=null, $fontfile=null)
        {
        }


        /**
         * Composite one image onto another
         *
         * @param \Phalcon\Image\Adapter watermark
         * @return \Phalcon\Image\Adapter
         */
        public function mask($mask)
        {
        }


        /**
         * Set the background color of an image
         *
         * @param string color
         * @param int opacity
         * @return \Phalcon\Image\Adapter
         */
        public function background($color, $quality=null)
        {
        }


        /**
         * Blur image
         *
         * @param int radius
         * @return \Phalcon\Image\Adapter
         */
        public function blur($radius=null)
        {
        }


        /**
         * Pixelate image
         *
         * @param int amount
         * @return \Phalcon\Image\Adapter
         */
        public function pixelate($amount=null)
        {
        }


        /**
         * Save the image
         *
         * @param string file
         * @param int quality
         * @return \Phalcon\Image\Adapter
         */
        public function save($file=null, $quality=null)
        {
        }


        /**
         * Render the image and return the binary string
         *
         * @param string ext
         * @param int quality
         * @return string
         */
        public function render($type=null, $quality=null)
        {
        }


        abstract protected function _resize($width, $height)
        {
        }


        abstract protected function _liquidRescale($width, $height, $delta_x, $regidity)
        {
        }


        abstract protected function _crop($width, $height, $offset_x, $offset_y)
        {
        }


        abstract protected function _rotate($degrees)
        {
        }


        abstract protected function _flip($direction)
        {
        }


        abstract protected function _sharpen($amount)
        {
        }


        abstract protected function _reflection($height, $opacity, $fade_in)
        {
        }


        abstract protected function _watermark($watermark, $offset_x, $offset_y, $opacity)
        {
        }


        abstract protected function _text($text, $offset_x, $offset_y, $opacity, $r, $g, $b, $size, $fontfile)
        {
        }


        abstract protected function _mask($mask)
        {
        }


        abstract protected function _background($r, $g, $b, $opacity)
        {
        }


        abstract protected function _blur($radius)
        {
        }


        abstract protected function _pixelate($amount)
        {
        }


        abstract protected function _save($file, $quality)
        {
        }


        abstract protected function _render($type, $quality)
        {
        }

    }
}
