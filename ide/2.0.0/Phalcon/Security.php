<?php 

namespace Phalcon {

    /**
     * Phalcon\Security
     *
     * This component provides a set of functions to improve the security in Phalcon applications
     *
     *<code>
     *	$login = $this->request->getPost('login');
     *	$password = $this->request->getPost('password');
     *
     *	$user = Users::findFirstByLogin($login);
     *	if ($user) {
     *		if ($this->security->checkHash($password, $user->password)) {
     *			//The password is valid
     *		}
     *	}
     *</code>
     */
    class Security implements \Phalcon\DI\InjectionAwareInterface
    {

        const CRYPT_DEFAULT = 0;

        const CRYPT_STD_DES = 1;

        const CRYPT_EXT_DES = 2;

        const CRYPT_MD5 = 3;

        const CRYPT_BLOWFISH = 4;

        const CRYPT_BLOWFISH_X = 5;

        const CRYPT_BLOWFISH_Y = 6;

        const CRYPT_SHA256 = 7;

        const CRYPT_SHA512 = 8;

        protected $_dependencyInjector;

        protected $_workFactor;

        protected $_numberBytes;

        protected $_csrf;

        protected $_defaultHash;

        /**
         * Sets the dependency injector
         *
         * @param \Phalcon\DiInterface $dependencyInjector
         */
        public function setDI($dependencyInjector)
        {
        }


        /**
         * Returns the internal dependency injector
         *
         * @return \Phalcon\DiInterface
         */
        public function getDI()
        {
        }


        /**
         * Sets a number of bytes to be generated by the openssl pseudo random generator
         *
         * @param long randomBytes
         */
        public function setRandomBytes($randomBytes)
        {
        }


        /**
         * Returns a number of bytes to be generated by the openssl pseudo random generator
         *
         * @return string
         */
        public function getRandomBytes()
        {
        }


        public function setWorkFactor($workFactor)
        {
        }


        public function getWorkFactor()
        {
        }


        /**
         * Generate a >22-length pseudo random string to be used as salt for passwords
         *
         * @return string
         */
        public function getSaltBytes()
        {
        }


        /**
         * Creates a password hash using bcrypt with a pseudo random salt
         *
         * @param string password
         * @param int workFactor
         * @return string
         */
        public function hash($password, $workFactor=null)
        {
        }


        /**
         * Checks a plain text password and its hash version to check if the password matches
         *
         * @param string password
         * @param string passwordHash
         * @param int maxPasswordLength
         * @return boolean
         */
        public function checkHash($password, $passwordHash, $maxPasswordLength=null)
        {
        }


        /**
         * Checks if a password hash is a valid bcrypt's hash
         *
         * @param string password
         * @param string passwordHash
         * @return boolean
         */
        public function isLegacyHash($passwordHash)
        {
        }


        /**
         * Generates a pseudo random token key to be used as input's name in a CSRF check
         *
         * @param int numberBytes
         * @return string
         */
        public function getTokenKey($numberBytes=null)
        {
        }


        /**
         * Generates a pseudo random token value to be used as input's value in a CSRF check
         *
         * @param int numberBytes
         * @return string
         */
        public function getToken($numberBytes=null)
        {
        }


        /**
         * Check if the CSRF token sent in the request is the same that the current in session
         *
         * @param string tokenKey
         * @param string tokenValue
         * @return boolean
         */
        public function checkToken($tokenKey=null, $tokenValue=null)
        {
        }


        /**
         * Returns the value of the CSRF token in session
         *
         * @return string
         */
        public function getSessionToken()
        {
        }


        /**
         * string \Phalcon\Security::computeHmac(string $data, string $key, string $algo, bool $raw = false)
         *
         *
         * @param string data
         * @param string key
         * @param string algo
         * @param boolean raw
         */
        public static function computeHmac($data, $key, $algo, $raw=null)
        {
        }


        public static function deriveKey($password, $salt, $hash=null, $iterations=null, $size=null)
        {
        }


        public static function pbkdf2($password, $salt, $hash=null, $iterations=null, $size=null)
        {
        }


        public function getDefaultHash()
        {
        }


        public function setDefaultHash($hash)
        {
        }

    }
}
