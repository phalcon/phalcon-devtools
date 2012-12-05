<?php

if(!extension_loaded('phalcon')){
	die("phalcon extension isn't installed");
}

/**
 * This scripts generates the stubs to be used on IDEs
 *
 * Change the CPHALCON_DIR constant to point to the dev/ directory in the Phalcon source code
 *
 * php ide/gen-stubs.php
 */

define('CPHALCON_DIR', '/Users/kenjikobe/cphalcon/');

class Stubs_Generator
{

	protected $_docs = array();

	public function __construct($directory)
	{
		$this->_scanSources($directory);
	}

	protected function _scanSources($directory)
	{
		$iterator = new DirectoryIterator($directory);
		foreach ($iterator as $item) {
			if ($item->isDir()) {
				if ($item->getFileName() != '.' && $item->getFileName() != '..') {
					$this->_scanSources($item->getPathname());
				}
			} else {
				if (preg_match('/\.c$/', $item->getPathname())) {
					if (strpos($item->getPathname(), 'kernel')===false) {
						$this->_getDocs($item->getPathname());
					}
				}
			}
		}
	}

	protected function _getDocs($file)
	{
		$firstDoc = true;
		$openComment = false;
		$nextLineMethod = false;
		$comment = '';
		foreach (file($file) as $line) {
			if(trim($line)=='/**'){
				$openComment = true;
			}
			if ($openComment===true){
				$comment.=$line;
			} else {
				if ($nextLineMethod===true) {
					if (preg_match('/^PHP_METHOD\(([a-zA-Z\_]+), (.*)\)/', $line, $matches)) {
						$this->_docs[$matches[1]][$matches[2]] = trim($comment);
						$className = $matches[1];
					} else {
						if (preg_match('/^PHALCON_DOC_METHOD\(([a-zA-Z\_]+), (.*)\)/', $line, $matches)) {
							$this->_docs[$matches[1]][$matches[2]] = trim($comment);
							$className = $matches[1];
						} else {
							if($firstDoc===true){
								$classDoc = $comment;
								$firstDoc = false;
								$comment = '';
							}
						}
					}
					$nextLineMethod = false;
				} else {
					$comment = '';
				}
			}
			if($openComment===true){
				if(trim($line)=='*/'){
					$openComment = false;
					$nextLineMethod = true;
				}
			}
		}
		if (isset($classDoc)) {
			if (isset($className)) {
				if(!isset($this->_classDocs[$className])){
					$this->_classDocs[$className] = $classDoc;
				}
			}
		}
	}

	public function getDocs()
	{
		return $this->_docs;
	}

	public function getClassDocs()
	{
		return $this->_classDocs;
	}

}

$version = Phalcon\Version::get();
$versionPieces = explode(' ', $version);
$genVersion = $versionPieces[0];

$api = new Stubs_Generator(CPHALCON_DIR);

$classDocs = $api->getClassDocs();
$docs = $api->getDocs();

$allClasses = array_merge(get_declared_classes(), get_declared_interfaces());

foreach($allClasses as $className){

	if (!preg_match('#^Phalcon#', $className)) {
		continue;
	}

	$pieces = explode("\\", $className);
	$namespaceName = join("\\", array_slice($pieces, 0, count($pieces)-1));
	$normalClassName = join('', array_slice($pieces, -1));

	$source ='<?php '.PHP_EOL.PHP_EOL;
	$source.='namespace '.$namespaceName.' {'.PHP_EOL.PHP_EOL;

	$simpleClassName = str_replace("\\", "_", $className);
	if (isset($classDocs[$simpleClassName])) {
		foreach (explode("\n", $classDocs[$simpleClassName]) as $commentPiece) {
			$source.="\t".$commentPiece."\n";
		}
	}

	$reflector = new ReflectionClass($className);

	$typeClass = '';
	if ($reflector->isInterface()) {
		if ($reflector->isAbstract() == true) {
			$typeClass = 'abstract ';
		}
		if ($reflector->isFinal() == true) {
			$typeClass = 'final ';
		}
	}

	$extends = $reflector->getParentClass();
	if ($reflector->isInterface()) {
		if ($extends) {
			$source.="\t".'interface '.$normalClassName.' extends \\'.$extends->name.' {'.PHP_EOL;
		} else {
			$source.="\t".'interface '.$normalClassName.' {'.PHP_EOL;
		}
	} else {
		if ($extends) {
			$source.="\t".$typeClass.'class '.$normalClassName.' extends \\'.$extends->name.' {'.PHP_EOL;
		} else {
			$source.="\t".$typeClass.'class '.$normalClassName.' {'.PHP_EOL;
		}
	}

	if (isset($docs[$simpleClassName])) {
		$docMethods = $docs[$simpleClassName];
	} else {
		$docMethods = array();
	}

	// constants
	foreach ($reflector->getConstants() as $constant => $value){
		$source.= PHP_EOL."\t\t".'const '.$constant.' = '.$value.';'.PHP_EOL;
	}

	// public and protected properties
	foreach ($reflector->getProperties() as $property){
		if($property->getDeclaringClass()->name == $className){
			$source.= PHP_EOL."\t\t".implode(' ', Reflection::getModifierNames($property->getModifiers())).' $'.$property->name.';'.PHP_EOL;
		}
	}

	if ($className == 'Phalcon\DI\Injectable') {
		$source .= '
		/**
 		 * @var \Phalcon\Mvc\ViewInterface
 		 */
		public $view;

		/**
		 * @var \Phalcon\Mvc\RouterInterface
	 	 */
		public $router;

		/**
		 * @var \Phalcon\Mvc\DispatcherInterface
	 	 */
		public $dispatcher;

		/**
		 * @var \Phalcon\Mvc\UrlInterface
	 	 */
		public $url;

		/**
		 * @var \Phalcon\DiInterface
	 	 */
		public $di;

		/**
		 * @var \Phalcon\HTTP\RequestInterface
	 	 */
		public $request;

		/**
		 * @var \Phalcon\HTTP\ResponseInterface
	 	 */
		public $response;

		/**
		 * @var \Phalcon\Flash\Direct
	 	 */
		public $flash;

		/**
		 * @var \Phalcon\Flash\Session
	 	 */
		public $flashSession;

		/**
		 * @var \Phalcon\Session\AdapterInterface
	 	 */
		public $session;

		/**
		 * @var \Phalcon\Session\Bag
	 	 */
		public $persistent;

		/**
		 * @var \Phalcon\Mvc\Model\ManagerInterface
	 	 */
		public $modelsManager;

		/**
		 * @var \Phalcon\Mvc\Model\MetadataInterface
	 	 */
		public $modelsMetadata;

		/**
		 * @var \Phalcon\Mvc\Model\Transaction\Manager
	 	 */
		public $transactionManager;

		/**
		 * @var \Phalcon\FilterInterface
	 	 */
		public $filter;
		';
	}

	// methods
	foreach ($reflector->getMethods() as $method) {
		if ($method->getDeclaringClass()->name == $reflector->name) {

			$source.=PHP_EOL;
			if (isset($docMethods[$method->name])) {
				$docMethods[$method->name] = str_replace(' Phalcon', ' \Phalcon', $docMethods[$method->name]);
				foreach (explode("\n", $docMethods[$method->name]) as $commentPiece) {
					$source.="\t\t".$commentPiece."\n";
				}
			}

			if ($reflector->isInterface()) {
				$source.= "\t\t".'public function '.$method->name.'(';
			} else {
				$source.= "\t\t".implode(' ', Reflection::getModifierNames($method->getModifiers())).' function '.$method->name.'(';
			}

			$parameters = array();
			foreach($method->getParameters() as $parameter){
				if ($parameter->isOptional()) {
					if($parameter->isDefaultValueAvailable()){
						$parameters[] = '$'.$parameter->name.'='.$parameter->getDefaultValue();
					} else {
						$parameters[] = '$'.$parameter->name.'=null';
					}
				} else {
					$parameters[] = '$'.$parameter->name;
				}
			}
			if ($reflector->isInterface()) {
				$source.=join(', ', $parameters).');'.PHP_EOL.PHP_EOL;
			} else {
				$source.=join(', ', $parameters).'){ }'.PHP_EOL.PHP_EOL;
			}
		}
	}

	$source.="\t".'}'.PHP_EOL;

	$source.='}'.PHP_EOL;

	$path = 'ide/phpstorm/'.$genVersion.'/'.str_replace("\\", DIRECTORY_SEPARATOR, $namespaceName);
	if(!is_dir($path)){
		mkdir($path, 0777, true);
	}
	file_put_contents($path.DIRECTORY_SEPARATOR.$normalClassName.'.php', $source);

}
