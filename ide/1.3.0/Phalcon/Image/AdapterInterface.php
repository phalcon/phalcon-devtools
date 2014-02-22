<?php 

namespace Phalcon\Image {

	/**
	 * Phalcon\Image\AdapterInterface initializer
	 */
	
	interface AdapterInterface {

		/**
		 * Resize the image to the given size. Either the width or the height can
		 * be omitted and the image will be resized proportionally.
		 *
		 * @param int $width   new width
		 * @param int $height  new height
		 * @param int $master  master dimension
		 * @return \Phalcon\Image\Adapter
		 */
		public function resize($width=null, $height=null, $master=null);


		public function liquidRescale($width, $height, $delta_x=null, $rigidity=null);


		/**
		 * Crop an image to the given size. Either the width or the height can be
		 * omitted and the current width or height will be used.
		 *
		 * @param int $width new width
		 * @param int $height new height
		 * @param int $offset_x  offset from the left
		 * @param int $offset_y  offset from the top
		 * @return \Phalcon\Image\Adapter
		 */
		public function crop($width, $height, $offset_x=null, $offset_y=null);


		/**
		 * Rotate the image by a given amount.
		 *
		 * @param int $degrees  degrees to rotate: -360-360
		 * @return \Phalcon\Image\Adapter
		 */
		public function rotate($degrees);


		/**
		 * Flip the image along the horizontal or vertical axis.
		 *
		 * @param $int $direction  direction: Image::HORIZONTAL, Image::VERTICAL
		 * @return \Phalcon\Image\Adapter
		 */
		public function flip($direction);


		/**
		 * Sharpen the image by a given amount.
		 *
		 * @param int $amount  amount to sharpen: 1-100
		 * @return \Phalcon\Image\Adapter
		 */
		public function sharpen($amount);


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
		public function reflection($height=null, $opacity=null, $fade_in=null);


		/**
		 * Add a watermark to an image with a specified opacity. Alpha transparency
		 * will be preserved.
		 *
		 * @param \Phalcon\Image\Adapter $watermark  watermark Image instance
		 * @param int $offset_x offset from the left
		 * @param int $offset_y offset from the top
		 * @param int $opacity opacity of watermark: 1-100
		 * @return \Phalcon\Image\Adapter
		 */
		public function watermark($watermark, $offset_x=null, $offset_y=null, $opacity=null);


		public function text($text, $offset_x=null, $offset_y=null, $opacity=null, $color=null, $size=null, $fontfile=null);


		public function mask($mask);


		/**
		 * Set the background color of an image. This is only useful for images
		 * with alpha transparency.
		 *
		 * @param string $color hexadecimal color value
		 * @param int $opacity background opacity: 0-100
		 * @return \Phalcon\Image\Adapter
		 */
		public function background($color, $quality=null);


		public function blur($radius=null);


		public function pixelate($amount=null);


		/**
		 * Save the image. If the filename is omitted, the original image will
		 * be overwritten.
		 *
		 * @param string $file new image path
		 * @param int $quality quality of image: 1-100
		 * @return \Phalcon\Image\Adapter
		 */
		public function save($file=null, $quality=null);


		/**
		 * Render the image and return the binary string.
		 *
		 * @param string $type image type to return: png, jpg, gif, etc
		 * @param int $quality quality of image: 1-100
		 * @return \Phalcon\Image\Adapter
		 */
		public function render($type=null, $quality=null);

	}
}
