<?php

namespace Phalcon\Image\Adapter;

use Phalcon\Image\Adapter;
use Phalcon\Image\AdapterInterface;
use Phalcon\Image\Exception;


class Gd extends Adapter implements AdapterInterface
{

	protected static $_checked = false;



	/**
	 *
	 * @return boolean
	 */
	public static function check() {}

	/**
	 * 
	 * @param string $file
	 * @param int $width
	 * @param int $height
	 */
	public function __construct($file, $width=null, $height=null) {}

	/**
	 * 
	 * @param int $width
	 * @param int $height
	 *
	 * @return void
	 */
	protected function _resize($width, $height) {}

	/**
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
	 * 
	 * @param int $degrees
	 *
	 * @return void
	 */
	protected function _rotate($degrees) {}

	/**
	 * 
	 * @param int $direction
	 *
	 * @return void
	 */
	protected function _flip($direction) {}

	/**
	 * 
	 * @param int $amount
	 *
	 * @return void
	 */
	protected function _sharpen($amount) {}

	/**
	 * 
	 * @param int $height
	 * @param int $opacity
	 * @param boolean $fadeIn
	 *
	 * @return void
	 */
	protected function _reflection($height, $opacity, $fadeIn) {}

	/**
	 * 
	 * @param Adapter $watermark
	 * @param int $offsetX
	 * @param int $offsetY
	 * @param int $opacity
	 *
	 * @return void
	 */
	protected function _watermark(Adapter $watermark, $offsetX, $offsetY, $opacity) {}

	/**
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
	 * 
	 * @param Adapter $mask
	 *
	 * @return void
	 */
	protected function _mask(Adapter $mask) {}

	/**
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
	 * 
	 * @param int $radius
	 *
	 * @return void
	 */
	protected function _blur($radius) {}

	/**
	 * 
	 * @param int $amount
	 *
	 * @return void
	 */
	protected function _pixelate($amount) {}

	/**
	 * 
	 * @param string $file
	 * @param int $quality
	 *
	 * @return mixed
	 */
	protected function _save($file, $quality) {}

	/**
	 * 
	 * @param string $ext
	 * @param int $quality
	 *
	 * @return mixed
	 */
	protected function _render($ext, $quality) {}

	/**
	 * 
	 * @param int $width
	 * @param int $height
	 *
	 * @return mixed
	 */
	protected function _create($width, $height) {}

	/**
	 *
	 * @return void
	 */
	public function __destruct() {}

}
