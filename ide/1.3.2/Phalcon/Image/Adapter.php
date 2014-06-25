<?php 

namespace Phalcon\Image {

	/**
	 * Phalcon\Image\Adapter
	 *
	 * Base class for Phalcon\Image adapters
	 */
	
	abstract class Adapter implements \Phalcon\Image\AdapterInterface {

		protected $_image;

		protected static $_checked;

		protected $_file;

		protected $_realpath;

		protected $_width;

		protected $_height;

		protected $_type;

		protected $_mime;

		/**
		 * Returns the real path of the image file
		 *
		 * @return string
		 */
		public function getRealPath(){ }


		/**
		 * Returns the width of images
		 *
		 * @return int
		 */
		public function getWidth(){ }


		/**
		 * Returns the height of images
		 *
		 * @return int
		 */
		public function getHeight(){ }


		/**
		 * Returns the type of images
		 *
		 * @return int
		 */
		public function getType(){ }


		/**
		 * Returns the mime of images
		 *
		 * @return string
		 */
		public function getMime(){ }


		/**
		 * Returns the image of images
		 *
		 * @return resource
		 */
		public function getImage(){ }


		/**
		 * Resize the image to the given size. Either the width or the height can
		 * be omitted and the image will be resized proportionally.
		 *
		 * @param int $width   new width
		 * @param int $height  new height
		 * @param int $master  master dimension, if $master is TENSILE, the width and height must be specified
		 * @return \Phalcon\Image\Adapter
		 */
		public function resize($width=null, $height=null, $master=null){ }


		/**
		 * This method scales the images using liquid rescaling method. Only support Imagick
		 *
		 * @param int $width   new width
		 * @param int $height  new height
		 * @param int $delta_x How much the seam can traverse on x-axis. Passing 0 causes the seams to be straight.
		 * @param int $rigidity Introduces a bias for non-straight seams. This parameter is typically 0.
		 * @return \Phalcon\Image\Adapter
		 */
		public function liquidRescale($width, $height, $delta_x=null, $rigidity=null){ }


		/**
		 * Crop an image to the given size. Either the width or the height can be
		 * omitted and the current width or height will be used.
		 *
		 * @param int $width new width
		 * @param int $height new height
		 * @param int $offset_x offset from the left, if it's true then will center
		 * @param int $offset_y offset from the top, if it's true then will middle
		 * @return \Phalcon\Image\Adapter
		 */
		public function crop($width, $height, $offset_x=null, $offset_y=null){ }


		/**
		 * Rotate the image by a given amount.
		 *
		 * @param int $degrees  degrees to rotate: -360-360
		 * @return \Phalcon\Image\Adapter
		 */
		public function rotate($degrees){ }


		/**
		 * Flip the image along the horizontal or vertical axis.
		 *
		 * @param $int $direction  direction: Image::HORIZONTAL, Image::VERTICAL
		 * @return \Phalcon\Image\Adapter
		 */
		public function flip($direction){ }


		/**
		 * Sharpen the image by a given amount.
		 *
		 * @param int $amount amount to sharpen: 1-100
		 * @return \Phalcon\Image\Adapter
		 */
		public function sharpen($amount){ }


		/**
		 * Add a reflection to an image. The most opaque part of the reflection
		 * will be equal to the opacity setting and fade out to full transparent.
		 * Alpha transparency is preserved.
		 *
		 * @param int $height reflection height
		 * @param int $opacity reflection opacity: 0-100
		 * @param boolean $fade_in TRUE to fade in, FALSE to fade out
		 * @return \Phalcon\Image\Adapter
		 */
		public function reflection($height=null, $opacity=null, $fade_in=null){ }


		/**
		 * Add a watermark to an image with a specified opacity. Alpha transparency
		 * will be preserved.
		 *
		 * @param \Phalcon\Image\Adapter $watermark  watermark Image instance
		 * @param int $offset_x offset from the left, If less than 0 offset from the right, If true right the x offset
		 * @param int $offset_y offset from the top, If less than 0 offset from the bottom, If true bottom the Y offset
		 * @param int $opacity opacity of watermark: 1-100
		 * @return \Phalcon\Image\AdapterInterface
		 */
		public function watermark($watermark, $offset_x=null, $offset_y=null, $opacity=null){ }


		/**
		 * Add a text to an image with a specified opacity.
		 *
		 * @param string text
		 * @param int $offset_x offset from the left, If less than 0 offset from the right, If true right the x offset
		 * @param int $offset_y offset from the top, If less than 0 offset from the bottom, If true bottom the Y offset
		 * @param int $opacity opacity of text: 1-100
		 * @param string $color hexadecimal color value
		 * @param int $size font pointsize
		 * @param string $fontfile font path
		 * @return \Phalcon\Image\Adapter
		 */
		public function text($text, $offset_x=null, $offset_y=null, $opacity=null, $color=null, $size=null, $fontfile=null){ }


		/**
		 * Composite one image onto another
		 *
		 * @param \Phalcon\Image\Adapter $mask  mask Image instance
		 * @return \Phalcon\Image\Adapter
		 */
		public function mask($mask){ }


		/**
		 * Set the background color of an image. This is only useful for images
		 * with alpha transparency.
		 *
		 * @param string $color hexadecimal color value
		 * @param int $opacity background opacity: 0-100
		 * @return \Phalcon\Image\Adapter
		 */
		public function background($color, $quality=null){ }


		/**
		 * Blur image
		 *
		 * @param int $radius Blur radius
		 * @return \Phalcon\Image\Adapter
		 */
		public function blur($radius=null){ }


		/**
		 * Pixelate image
		 *
		 * @param int $amount amount to pixelate
		 * @return \Phalcon\Image\Adapter
		 */
		public function pixelate($amount=null){ }


		/**
		 * Save the image. If the filename is omitted, the original image will
		 * be overwritten.
		 *
		 * @param string $file new image path
		 * @param int $quality quality of image: 1-100
		 * @return boolean
		 */
		public function save($file=null, $quality=null){ }


		/**
		 * Render the image and return the binary string.
		 *
		 * @param string $ext image type to return: png, jpg, gif, etc
		 * @param int $quality quality of image: 1-100
		 * @return \Phalcon\Image\Adapter
		 */
		public function render($type=null, $quality=null){ }


		abstract protected function _resize($width, $height){ }


		abstract protected function _liquidRescale($width, $height, $delta_x, $regidity){ }


		abstract protected function _crop($width, $height, $offset_x, $offset_y){ }


		abstract protected function _rotate($degrees){ }


		abstract protected function _flip($direction){ }


		abstract protected function _sharpen($amount){ }


		abstract protected function _reflection($height, $opacity, $fade_in){ }


		abstract protected function _watermark($watermark, $offset_x, $offset_y, $opacity){ }


		abstract protected function _text($text, $offset_x, $offset_y, $opacity, $r, $g, $b, $size, $fontfile){ }


		abstract protected function _mask($mask){ }


		abstract protected function _background($r, $g, $b, $opacity){ }


		abstract protected function _blur($radius){ }


		abstract protected function _pixelate($amount){ }


		abstract protected function _save($file, $quality){ }


		abstract protected function _render($type, $quality){ }

	}
}
