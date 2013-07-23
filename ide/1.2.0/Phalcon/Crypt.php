<?php 

namespace Phalcon {

	/**
	 * Phalcon\Crypt
	 *
	 * Provides encryption facilities to phalcon applications
	 *
	 *<code>
	 *	$crypt = new Phalcon\Crypt();
	 *
	 *	$key = 'le password';
	 *	$text = 'This is a secret text';
	 *
	 *	$encrypted = $crypt->encrypt($text, $key);
	 *
	 *	echo $crypt->decrypt($encrypted, $key);
	 *</code>
	 */
	
	class Crypt implements \Phalcon\CryptInterface {

		protected $_key;

		protected $_mode;

		protected $_cipher;

		/**
		 * Sets the cipher algorithm
		 *
		 * @param string $cipher
		 * @return \Phalcon\Encrypt
		 */
		public function setCipher($cipher){ }


		/**
		 * Returns the current cipher
		 *
		 * @return string
		 */
		public function getCipher(){ }


		/**
		 * Sets the encrypt/decrypt mode
		 *
		 * @param string $cipher
		 * @return \Phalcon\Encrypt
		 */
		public function setMode($mode){ }


		/**
		 * Returns the current encryption mode
		 *
		 * @return string
		 */
		public function getMode(){ }


		/**
		 * Sets the encryption key
		 *
		 * @param string $key
		 * @return \Phalcon\Encrypt
		 */
		public function setKey($key){ }


		/**
		 * Returns the encryption key
		 *
		 * @return string
		 */
		public function getKey(){ }


		/**
		 * Encrypts a text
		 *
		 *<code>
		 *	$encrypted = $crypt->encrypt("Ultra-secret text", "encrypt password");
		 *</code>
		 *
		 * @param string $text
		 * @param string $key
		 * @return string
		 */
		public function encrypt($text, $key=null){ }


		/**
		 * Decrypts an encrypted text
		 *
		 *<code>
		 *	echo $crypt->decrypt($encrypted, "decrypt password");
		 *</code>
		 *
		 * @param string $text
		 * @param string $key
		 * @return string
		 */
		public function decrypt($text, $key=null){ }


		/**
		 * Encrypts a text returning the result as a base64 string
		 *
		 * @param string $text
		 * @param string $key
		 * @return string
		 */
		public function encryptBase64($text, $key=null){ }


		/**
		 * Decrypt a text that is coded as a base64 string
		 *
		 * @param string $text
		 * @param string $key
		 * @return string
		 */
		public function decryptBase64($text, $key=null){ }


		/**
		 * Returns a list of available cyphers
		 *
		 * @return array
		 */
		public function getAvailableCiphers(){ }


		/**
		 * Returns a list of available modes
		 *
		 * @return array
		 */
		public function getAvailableModes(){ }

	}
}
