<?php 

namespace Phalcon\Image\Adapter {

	class Imagick extends \Phalcon\Image\Adapter implements \Phalcon\Image\AdapterInterface {

		protected $_version;

		public static function check(){ }


		public function __construct($file, $width=null, $height=null){ }


		protected function _resize($width, $height){ }


		protected function _crop($width, $height, $offset_x, $offset_y){ }


		protected function _rotate($degrees){ }


		protected function _flip($direction){ }


		protected function _sharpen($amount){ }


		protected function _reflection($height, $opacity, $fade_in){ }


		protected function _watermark(\Phalcon\Image\Adapter $image, $offset_x, $offset_y, $opacity){ }


		protected function _text($text, $offset_x, $offset_y, $opacity, $r, $g, $b, $size, $fontfile){ }


		protected function _mask(\Phalcon\Image\Adapter $image){ }


		protected function _background($r, $g, $b, $opacity){ }


		protected function _blur($radius){ }


		protected function _pixelate($amount){ }


		protected function _save($file, $quality){ }


		protected function _render($ext, $quality){ }


		public function __destruct(){ }

	}
}
