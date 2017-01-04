<?php

namespace Phalcon\Image\Adapter;

use Phalcon\Image\Adapter;
use Phalcon\Image\AdapterInterface;
use Phalcon\Image\Exception;


class Imagick extends Adapter implements AdapterInterface
{

	protected static $_version;

	protected static $_checked = false;



	/**
	 * Checks if Imagick is enabled
	 *
	 * @return boolean
	 */
	public static function check() {}

	/**
	 * \Phalcon\Image\Adapter\Imagick constructor
	 * 
	 * @param string $file
	 * @param int $width
	 * @param int $height
	 */
	public function __construct($file, $width=null, $height=null) {}

	/**
	 * Execute a resize.
	 * 
	 * @param int $width
	 * @param int $height
	 *
	 * @return void
	 */
	protected function _resize($width, $height) {}

	/**
	 * This method scales the images using liquid rescaling method. Only support Imagick
	 * 
	 * @param int $width
	 * @param int $height
	 * @param int $deltaX
	 * @param int $rigidity
	 *
	 *
	 * @return void
	 */
	protected function _liquidRescale($width, $height, $deltaX, $rigidity) {}

	/**
	 * Execute a crop.
	 * 
	 * @param int $width
	 * @param int $height
	 * @param int $offsetX
	 * @param int $offsetY
	 *
	 * @return void
	 */
	protected function _crop($width, $height, $offsetX, $offsetY) {}

	/**
	 * Execute a rotation.
	 * 
	 * @param int $degrees
	 *
	 * @return void
	 */
	protected function _rotate($degrees) {}

	/**
	 * Execute a flip.
	 * 
	 * @param int $direction
	 *
	 * @return void
	 */
	protected function _flip($direction) {}

	/**
	 * Execute a sharpen.
	 * 
	 * @param int $amount
	 *
	 * @return void
	 */
	protected function _sharpen($amount) {}

	/**
	 * Execute a reflection.
	 * 
	 * @param int $height
	 * @param int $opacity
	 * @param boolean $fadeIn
	 *
	 * @return void
	 */
	protected function _reflection($height, $opacity, $fadeIn) {}

	/**
	 * Execute a watermarking.
	 * 
	 * @param Adapter $image
	 * @param int $offsetX
	 * @param int $offsetY
	 * @param int $opacity
	 *
	 * @return void
	 */
	protected function _watermark(Adapter $image, $offsetX, $offsetY, $opacity) {}

	/**
	 * Execute a text
	 * 
	 * @param string $text
	 * @param int $offsetX
	 * @param int $offsetY
	 * @param int $opacity
	 * @param int $r
	 * @param int $g
	 * @param int $b
	 * @param int $size
	 * @param string $fontfile
	 *
	 * @return void
	 */
	protected function _text($text, $offsetX, $offsetY, $opacity, $r, $g, $b, $size, $fontfile) {}

	/**
	 * Composite one image onto another
	 * 
	 * @param Adapter $image
	 *
	 *
	 * @return void
	 */
	protected function _mask(Adapter $image) {}

	/**
	 * Execute a background.
	 * 
	 * @param int $r
	 * @param int $g
	 * @param int $b
	 * @param int $opacity
	 *
	 * @return void
	 */
	protected function _background($r, $g, $b, $opacity) {}

	/**
	 * Blur image
	 * 
	 * @param int $radius
	 *
	 *
	 * @return void
	 */
	protected function _blur($radius) {}

	/**
	 * Pixelate image
	 * 
	 * @param int $amount
	 *
	 *
	 * @return void
	 */
	protected function _pixelate($amount) {}

	/**
	 * Execute a save.
	 * 
	 * @param string $file
	 * @param int $quality
	 *
	 * @return mixed
	 */
	protected function _save($file, $quality) {}

	/**
	 * Execute a render.
	 * 
	 * @param string $extension
	 * @param int $quality
	 *
	 * @return string
	 */
	protected function _render($extension, $quality) {}

	/**
	 * Destroys the loaded image to free up resources.
	 *
	 * @return void
	 */
	public function __destruct() {}

	/**
	 * Get instance
	 *
	 * @return \Imagick
	 */
	public function getInternalImInstance() {}

	/**
	 * Sets the limit for a particular resource in megabytes
	 * 
	 * @param int $type
	 * @param int $limit
	 * @param \int type Refer to the list of resourcetype $constants
	 *
	 * @return void
	 */
	public function setResourceLimit($type, $limit) {}

}
