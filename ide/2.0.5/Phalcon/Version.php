<?php

namespace Phalcon;

class Version
{

	const VERSION_MAJOR = 0;

	const VERSION_MEDIUM = 1;

	const VERSION_MINOR = 2;

	const VERSION_SPECIAL = 3;

	const VERSION_SPECIAL_NUMBER = 4;



	/**
	 * Area where the version number is set. The format is as follows:
	 * ABBCCDE
	 *
	 * A - Major version
	 * B - Med version (two digits)
	 * C - Min version (two digits)
	 * D - Special release: 1 = Alpha, 2 = Beta, 3 = RC, 4 = Stable
	 * E - Special release version i.e. RC1, Beta2 etc.
	 *
	 * @return array
	 */
	protected static function _getVersion() {}

	/**
	 * Translates a number to a special release
	 *
	 * If Special release = 1 this function will return ALPHA
	 * 
	 * @param int $special
	 *
	 * @return string
	 */
	protected final static function _getSpecial($special) {}

	/**
	 * Returns the active version (string)
	 *
	 * <code>
	 * echo Phalcon\Version::get();
	 * </code>
	 *
	 * @return string
	 */
	public static function get() {}

	/**
	 * Returns the numeric active version
	 *
	 * <code>
	 * echo Phalcon\Version::getId();
	 * </code>
	 *
	 * @return string
	 */
	public static function getId() {}

	/**
	 * Returns a specific part of the version. If the wrong parameter is passed
	 * it will return the full version
	 *
	 * <code>
	 * echo Phalcon\Version::getPart(Phalcon\Version::VERSION_MAJOR);
	 * </code>
	 * 
	 * @param int $part
	 *
	 * @return string
	 */
	public static function getPart($part) {}

}
