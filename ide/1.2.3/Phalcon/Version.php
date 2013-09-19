<?php 

namespace Phalcon {

	/**
	 * Phalcon\Version
	 *
	 * This class allows to get the installed version of the framework
	 */
	
	class Version {

		/**
		 * Area where the version number is set. The format is as follows:
		 * ABBCCDE
		 *
		 * A - Major version
		 * B - Med version (two digits)
		 * C - Min version (two digits)
		 * D - Special release: 1 = Alpha, 2 = Beta, 3 = RC, 4 = Stable
		 * E - Special release version i.e. RC1, Beta2 etc. 
		 */
		protected static function _getVersion(){ }


		/**
		 * Returns the active version (string)
		 *
		 * <code>
		 * echo \Phalcon\Version::get();
		 * </code>
		 *
		 * @return string
		 */
		public static function get(){ }


		/**
		 * Returns the numeric active version
		 *
		 * <code>
		 * echo \Phalcon\Version::getId();
		 * </code>
		 *
		 * @return int
		 */
		public static function getId(){ }

	}
}
