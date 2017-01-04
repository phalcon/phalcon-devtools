<?php

namespace Phalcon\Mvc\View\Engine\Volt;

use Phalcon\DiInterface;
use Phalcon\Mvc\ViewBaseInterface;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Mvc\View\Exception;


class Compiler implements InjectionAwareInterface
{

	protected $_dependencyInjector;

	protected $_view;

	protected $_options;

	protected $_arrayHelpers;

	protected $_level;

	protected $_foreachLevel;

	protected $_blockLevel;

	protected $_exprLevel;

	protected $_extended = false;

	protected $_autoescape = false;

	protected $_extendedBlocks;

	protected $_currentBlock;

	protected $_blocks;

	protected $_forElsePointers;

	protected $_loopPointers;

	protected $_extensions;

	protected $_functions;

	protected $_filters;

	protected $_macros;

	protected $_prefix;

	protected $_currentPath;

	protected $_compiledTemplatePath;



	/**
	 * Phalcon\Mvc\View\Engine\Volt\Compiler
	 * 
	 * @param ViewBaseInterface $view
	 */
	public function __construct(ViewBaseInterface $view=null) {}

	/**
	 * Sets the dependency injector
	 * 
	 * @param DiInterface $dependencyInjector
	 *
	 * @return void
	 */
	public function setDI(DiInterface $dependencyInjector) {}

	/**
	 * Returns the internal dependency injector
	 *
	 * @return DiInterface
	 */
	public function getDI() {}

	/**
	 * Sets the compiler options
	 * 
	 * @param array $options
	 *
	 * @return void
	 */
	public function setOptions(array $options) {}

	/**
	 * Sets a single compiler option
	 * 
	 * @param string $option
	 * @param mixed $value
	 *
	 *
	 * @return void
	 */
	public function setOption($option, $value) {}

	/**
	 * Returns a compiler's option
	 *
	 * @param string $option
	 * 
	 * @return mixed
	 */
	public function getOption($option) {}

	/**
	 * Returns the compiler options
	 *
	 * @return array
	 */
	public function getOptions() {}

	/**
	 * Fires an event to registered extensions
	 *
	 * @param string $name
	 * @param array $arguments
	 * 
	 * @return mixed
	 */
	public final function fireExtensionEvent($name, $arguments=null) {}

	/**
				 * Check if the extension implements the required event name
	 * 
	 * @param $extension
				 *
	 * @return Compiler
	 */
	public function addExtension($extension) {}

	/**
		 * Initialize the extension
		 *
	 * @return array
	 */
	public function getExtensions() {}

	/**
	 * Register a new function in the compiler
	 * 
	 * @param string $name
	 * @param mixed $definition
	 *
	 * @return Compiler
	 */
	public function addFunction($name, $definition) {}

	/**
	 * Register the user registered functions
	 *
	 * @return array
	 */
	public function getFunctions() {}

	/**
	 * Register a new filter in the compiler
	 * 
	 * @param string $name
	 * @param mixed $definition
	 *
	 * @return Compiler
	 */
	public function addFilter($name, $definition) {}

	/**
	 * Register the user registered filters
	 *
	 * @return array
	 */
	public function getFilters() {}

	/**
	 * Set a unique prefix to be used as prefix for compiled variables
	 * 
	 * @param string $prefix
	 *
	 * @return Compiler
	 */
	public function setUniquePrefix($prefix) {}

	/**
	 * Return a unique prefix to be used as prefix for compiled variables and contexts
	 *
	 * @return string
	 */
	public function getUniquePrefix() {}

	/**
		 * If the unique prefix is not set we use a hash using the modified Berstein algotithm
	 * 
	 * @param array $expr
		 *
	 * @return string
	 */
	public function attributeReader(array $expr) {}

	/**
			 * Check if the variable is the loop context
	 * 
	 * @param array $expr
			 *
	 * @return string
	 */
	public function functionCall(array $expr) {}

	/**
		 * Check if it's a single function
	 * 
	 * @param array $test
	 * @param string $left
		 *
	 * @return string
	 */
	public function resolveTest(array $test, $left) {}

	/**
		 * Check if right part is a single identifier
	 * 
	 * @param array $filter
	 * @param string $left
		 *
	 * @return string
	 */
	final protected function resolveFilter(array $filter, $left) {}

	/**
		 * Check if the filter is a single identifier
	 * 
	 * @param array $expr
		 *
	 * @return string
	 */
	final public function expression(array $expr) {}

	/**
		 * Check if any of the registered extensions provide compilation for this expression
	 * 
	 * @param mixed $statements
		 *
	 * @return mixed
	 */
	final protected function _statementListOrExtends($statements) {}

	/**
		 * Resolve the statement list as normal
	 * 
	 * @param array $statement
	 * @param boolean $extendsMode
		 *
	 * @return string
	 */
	public function compileForeach(array $statement, $extendsMode=false) {}

	/**
		 * A valid expression is required
		 *
	 * @return string
	 */
	public function compileForElse() {}

	/**
	 * Compiles a 'if' statement returning PHP code
	 * 
	 * @param array $statement
	 * @param boolean $extendsMode
	 *
	 * @return string
	 */
	public function compileIf(array $statement, $extendsMode=false) {}

	/**
		 * A valid expression is required
	 * 
	 * @param array $statement
		 *
	 * @return string
	 */
	public function compileElseIf(array $statement) {}

	/**
		 * A valid expression is required
	 * 
	 * @param array $statement
	 * @param boolean $extendsMode
		 *
	 * @return string
	 */
	public function compileCache(array $statement, $extendsMode=false) {}

	/**
		 * A valid expression is required
	 * 
	 * @param array $statement
		 *
	 * @return string
	 */
	public function compileSet(array $statement) {}

	/**
		 * A valid assigment list is required
	 * 
	 * @param array $statement
		 *
	 * @return string
	 */
	public function compileDo(array $statement) {}

	/**
		 * A valid expression is required
	 * 
	 * @param array $statement
		 *
	 * @return string
	 */
	public function compileReturn(array $statement) {}

	/**
		 * A valid expression is required
	 * 
	 * @param array $statement
	 * @param boolean $extendsMode
		 *
	 * @return string
	 */
	public function compileAutoEscape(array $statement, $extendsMode) {}

	/**
		 * A valid option is required
	 * 
	 * @param array $statement
		 *
	 * @return string
	 */
	public function compileEcho(array $statement) {}

	/**
		 * A valid expression is required
	 * 
	 * @param array $statement
		 *
	 * @return string
	 */
	public function compileInclude(array $statement) {}

	/**
		 * Include statement
		 * A valid expression is required
	 * 
	 * @param array $statement
	 * @param boolean $extendsMode
		 *
	 * @return string
	 */
	public function compileMacro(array $statement, $extendsMode) {}

	/**
		 * A valid name is required
	 * 
	 * @param array $statement
	 * @param boolean $extendsMode
		 *
	 * @return void
	 */
	public function compileCall(array $statement, $extendsMode) {}

	/**
	 * Traverses a statement list compiling each of its nodes
	 * 
	 * @param array $statements
	 * @param boolean $extendsMode
	 *
	 * @return string
	 */
	final protected function _statementList(array $statements, $extendsMode=false) {}

	/**
		 * Nothing to compile
	 * 
	 * @param string $viewCode
	 * @param boolean $extendsMode
		 *
	 * @return string
	 */
	protected function _compileSource($viewCode, $extendsMode=false) {}

	/**
		 * Check for compilation options
	 * 
	 * @param string $viewCode
	 * @param boolean $extendsMode
		 *
	 * @return string
	 */
	public function compileString($viewCode, $extendsMode=false) {}

	/**
	 * Compiles a template into a file forcing the destination path
	 *
	 *<code>
	 *	$compiler->compile('views/layouts/main.volt', 'views/layouts/main.volt.php');
	 *</code>
	 *
	 * @param string $path
	 * @param string $compiledPath
	 * @param boolean $extendsMode
	 * 
	 * @return mixed
	 */
	public function compileFile($path, $compiledPath, $extendsMode=false) {}

	/**
		 * Check if the template does exist
	 * 
	 * @param string $templatePath
	 * @param boolean $extendsMode
		 *
	 * @return mixed
	 */
	public function compile($templatePath, $extendsMode=false) {}

	/**
		 * Re-initialize some properties already initialized when the object is cloned
		 *
	 * @return string
	 */
	public function getTemplatePath() {}

	/**
	 * Returns the path to the last compiled template
	 *
	 * @return string
	 */
	public function getCompiledTemplatePath() {}

	/**
	 * Parses a Volt template returning its intermediate representation
	 *
	 *<code>
	 *	print_r($compiler->parse('{{ 3 + 2 }}'));
	 *</code>
	 *
	 * @param string $viewCode
	 * 
	 * @return mixed
	 */
	public function parse($viewCode) {}

}
