<?php

namespace Phalcon\Image;

/**
 * Phalcon\Image\Adapter
 *
 * All image adapters must use this class
 */
abstract class Adapter implements \Phalcon\Image\AdapterInterface
{

    protected $_image;


    protected $_file;


    protected $_realpath;

    /**
     * Image width
     *
     * @var int
     */
    protected $_width;

    /**
     * Image height
     *
     * @var int
     */
    protected $_height;

    /**
     * Image type
     *
     * Driver dependent
     *
     * @var int
     */
    protected $_type;

    /**
     * Image mime type
     *
     * @var string
     */
    protected $_mime;


    static protected $_checked = false;



    public function getImage() {}


    public function getRealpath() {}

    /**
     * Image width
     *
     * @return int
     */
    public function getWidth() {}

    /**
     * Image height
     *
     * @return int
     */
    public function getHeight() {}

    /**
     * Image type
     *
     * Driver dependent
     *
     * @return int
     */
    public function getType() {}

    /**
     * Image mime type
     *
     * @return string
     */
    public function getMime() {}

    /**
     * Resize the image to the given size
     *
     * @param int $width
     * @param int $height
     * @param int $master
     * @return Adapter
     */
    public function resize($width = null, $height = null, $master = Image::AUTO) {}

    /**
     * This method scales the images using liquid rescaling method. Only support Imagick
     *
     * @param int $width
     * @param int $height
     * @param int $deltaX
     * @param int $rigidity
     * @param int $$width new width
     * @param int $$height new height
     * @param int $$deltaX How much the seam can traverse on x-axis. Passing 0 causes the seams to be straight.
     * @param int $$rigidity Introduces a bias for non-straight seams. This parameter is typically 0.
     * @return Adapter
     */
    public function liquidRescale($width, $height, $deltaX = 0, $rigidity = 0) {}

    /**
     * Crop an image to the given size
     *
     * @param int $width
     * @param int $height
     * @param int $offsetX
     * @param int $offsetY
     * @return Adapter
     */
    public function crop($width, $height, $offsetX = null, $offsetY = null) {}

    /**
     * Rotate the image by a given amount
     *
     * @param int $degrees
     * @return Adapter
     */
    public function rotate($degrees) {}

    /**
     * Flip the image along the horizontal or vertical axis
     *
     * @param int $direction
     * @return Adapter
     */
    public function flip($direction) {}

    /**
     * Sharpen the image by a given amount
     *
     * @param int $amount
     * @return Adapter
     */
    public function sharpen($amount) {}

    /**
     * Add a reflection to an image
     *
     * @param int $height
     * @param int $opacity
     * @param bool $fadeIn
     * @return Adapter
     */
    public function reflection($height, $opacity = 100, $fadeIn = false) {}

    /**
     * Add a watermark to an image with the specified opacity
     *
     * @param Adapter $watermark
     * @param int $offsetX
     * @param int $offsetY
     * @param int $opacity
     * @return Adapter
     */
    public function watermark(Adapter $watermark, $offsetX = 0, $offsetY = 0, $opacity = 100) {}

    /**
     * Add a text to an image with a specified opacity
     *
     * @param string $text
     * @param mixed $offsetX
     * @param mixed $offsetY
     * @param int $opacity
     * @param string $color
     * @param int $size
     * @param string $fontfile
     * @return Adapter
     */
    public function text($text, $offsetX = false, $offsetY = false, $opacity = 100, $color = "000000", $size = 12, $fontfile = null) {}

    /**
     * Composite one image onto another
     *
     * @param Adapter $watermark
     * @return Adapter
     */
    public function mask(Adapter $watermark) {}

    /**
     * Set the background color of an image
     *
     * @param string $color
     * @param int $opacity
     * @return Adapter
     */
    public function background($color, $opacity = 100) {}

    /**
     * Blur image
     *
     * @param int $radius
     * @return Adapter
     */
    public function blur($radius) {}

    /**
     * Pixelate image
     *
     * @param int $amount
     * @return Adapter
     */
    public function pixelate($amount) {}

    /**
     * Save the image
     *
     * @param string $file
     * @param int $quality
     * @return Adapter
     */
    public function save($file = null, $quality = -1) {}

    /**
     * Render the image and return the binary string
     *
     * @param string $ext
     * @param int $quality
     * @return string
     */
    public function render($ext = null, $quality = 100) {}

}
