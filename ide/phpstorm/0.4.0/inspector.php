<?php if(!extension_loaded("phalcon")){

/**
 * Phalcon_Acl
 *
 * This component allows to manage ACL lists. An access control list (ACL) is a list
 * of permissions attached to an object. An ACL specifies which users or system processes
 * are granted access to objects, as well as what operations are allowed on given objects.
 *
 *<code>
 *$acl = new Phalcon_Acl('Memory');
 *
 * //Default action is deny access
 *$acl->setDefaultAction(Phalcon_Acl::DENY);
 *
 * //Create some roles
 *$roleAdmins = new Phalcon_Acl_Role('Administrators', 'Super-User role');
 *$roleGuests = new Phalcon_Acl_Role('Guests');
 *
 * //Add "Guests" role to acl
 *acl->addRole($roleGuests);
 *
 * //Add "Designers" role to acl
 *$acl->addRole('Designers'));
 *
 * //Define the "Customers" resource
 *$customersResource = new Phalcon_Acl_Resource('Customers', 'Customers management');
 *
 * //Add "customers" resource with a couple of operations
 *$acl->addResource($customersResource, 'search');
 *$acl->addResource($customersResource, array('create', 'update'));
 *
 * //Set access level for roles into resources
 *$acl->allow('Guests', 'Customers', 'search');
 *$acl->allow('Guests', 'Customers', 'create');
 *$acl->deny('Guests', 'Customers', 'update');
 *
 * //Check whether role has access to the operations
 *$acl->isAllowed('Guests', 'Customers', 'edit') //Returns 0
 *$acl->isAllowed('Guests', 'Customers', 'search'); //Returns 1
 *$acl->isAllowed('Guests', 'Customers', 'create'); //Returns 1
 *</code>
 */
class Phalcon_Acl
{
	const ALLOW = 1;
	const DENY = 0;
	/**
	 * Phalcon_Acl Constructor
	 *
	 * @param string $adapterName
	 * @param array $options
	 */
	public function __construct($adapterName='Memory', $options=array ()){
	}

	/**
	 * Pass any call to the internal adapter object
	 *
	 * @param  string $method
	 * @param  array $arguments
	 * @return mixed
	 */
	public function __call($method, $arguments=array ()){
	}

}

/**
 * Phalcon_Cache
 *
 * Phalcon_Cache can be used to cache output fragments to improve performance
 *
 *<code>
 * //Cache the file for 2 days
 *$frontendOptions = array(
 *	'lifetime' => 172800
 *);
 *
 * //Set the cache directory
 *$backendOptions = array(
 *	'cacheDir' => '../app/cache/'
 *);
 *
 *$cache = Phalcon_Cache::factory('Output', 'File', $frontendOptions, $backendOptions);
 *
 *$content = $cache->start('my-cache');
 *if($content===null){
 *	echo time();
 *  $cache->save();
 *} else {
 *	echo $content;
 *}
 *</code>
 */
class Phalcon_Cache
{
	/**
	 * Factories different caches backends from its adapters
	 *
	 * @param	string $frontendAdapter
	 * @param	string $backendAdapter
	 * @param	array $frontendOptions
	 * @param	array $backendOptions
	 * @return  Phalcon_Cache_Backend_File
	 * @static
	 */
	public static function factory($frontendAdapter, $backendAdapter, $frontendOptions=array (), $backendOptions=array ()){
	}

}

/**
 * Phalcon_Config
 *
 * Phalcon_Config is designed to simplify the access to, and the use of, configuration data within applications.
 * It provides a nested object property based user interface for accessing this configuration data within
 * application code.
 *
 * <code>$config = new Phalcon_Config(array(
 *  "database" => array(
 *    "adapter" => "Mysql",
 *    "host" => "localhost",
 *    "username" => "scott",
 *    "password" => "cheetah",
 *    "name" => "test_db"
 *  ),
 *  "phalcon" => array(
 *    "controllersDir" => "../app/controllers/",
 *    "modelsDir" => "../app/models/",
 *    "viewsDir" => "../app/views/"
 *  )
 * ));</code>
 *
 */
class Phalcon_Config
{
	/**
	 * Phalcon_Config constructor
	 *
	 * @param	array $arrayConfig
	 * @return	Phalcon_Config
	 */
	public function __construct($arrayConfig=array ()){
	}

}

/**
 * Phalcon_Controller
 *
 * Every application controller should extend this class that encapsulates all the controller functionality
 *
 * The controllers provide the “flow” between models and views. Controllers are responsible
 * for processing the incoming requests from the web browser, interrogating the models for data,
 * and passing that data on to the views for presentation.
 *
 *<code>
 *
 *
 * class PeopleController extends Phalcon_Controller {
 *
 *  //This action will be executed by default
 *  public function indexAction(){
 *
 *  }
 *
 *  public function findAction(){
 *
 *  }
 *
 *  public function saveAction(){
 *   //Forwards flow to the index action
 *   return $this->_forward('people/index');
 *  }
 *
 *  //This action will be executed when a non existent action is requested
 *  public function notFoundAction(){
 *
 *  }
 *
 * }
 *
 *</code>
 */
class Phalcon_Controller
{
	/**
	 * @var Phalcon_Dispatcher
	 */
	public $dispatcher;

	/**
	 * @var Phalcon_Request
	 */
	public $request;

	/**
	 * @var Phalcon_Response
	 */
	public $response;

	/**
	 * @var Phalcon_View
	 */
	public $view;

	/**
	 * @var Phalcon_Model_Manager
	 */
	public $model;

	/**
	 * Constructor for Phalcon_Controller
	 *
	 * @param Phalcon_Dispatcher $dispatcher
	 * @param Phalcon_Request $request
	 * @param Phalcon_Response $response
	 * @param Phalcon_View $view
	 * @param Phalcon_Model_Manager $model
	 */
	final public function __construct($dispatcher, $request, $response, $view=NULL, $model=NULL){
	}

	/**
	 * Forwards execution flow to another controller/action.
	 *
	 * @param string $uri
	 */
	protected function _forward($uri){
	}

	/**
	 * Returns a param from the dispatching params
	 *
	 * @param mixed $index
	 */
	protected function _getParam($index){
	}

	/**
	 * Magic method __get
	 *
	 * @param string $propertyName
	 */
	public function __get($propertyName){
	}

}

/**
 * Phalcon_Db
 *
 * Phalcon_Db and its related classes provide a simple SQL database interface for Phalcon Framework.
 * The Phalcon_Db is the basic class you use to connect your PHP application to a RDBMS.
 * There is a different adapter class for each brand of RDBMS.
 *
 * This component is intended to low level database operations. If you want to interact with databases using
 * high level abstraction use Phalcon_Model.
 *
 * Phalcon_Db is an abstract class. You only can use it with a database adapter like Phalcon_Db_Mysql
 *
 * <code>
 *
 *$config = new stdClass();
 *$config->host = 'localhost';
 *$config->username = 'machine';
 *$config->password = 'sigma';
 *$config->name = 'swarm';
 *
 *try {
 *
 *  $connection = Phalcon_Db::factory('Mysql', $config);
 *
 *  $connection->setFetchMode(Phalcon_Db::DB_NUM);
 *  $result = $connection->query("SELECT * FROM robots LIMIT 5");
 *  while($robot = $connection->fetchArray($result)){
 *    print_r($robot);
 *  }
 *
 *}
 *catch(Phalcon_Db_Exception $e){
 *	echo $e->getMessage(), PHP_EOL;
 *}
 *
 * </code>
 */
abstract class Phalcon_Db
{
	const DB_ASSOC = 1;
	const DB_BOTH = 2;
	const DB_NUM = 3;
	/**
	 * Phalcon_Db constructor, this method should not be called directly. Use Phalcon_Db::factory instead
	 *
	 * @param stdClass $descriptor
	 */
	protected function __construct($descriptor){
	}

	/**
	 * Sets a logger class to log all SQL operations sent to database server
	 *
	 * @param Phalcon_Logger $logger
	 */
	public function setLogger($logger){
	}

	/**
	 * Returns the active logger
	 *
	 * @return Phalcon_Logger
	 */
	public function getLogger(){
	}

	/**
	 * Sends arbitrary text to a related logger in the instance
	 *
	 * @param string $sqlStatement
	 * @param int $type
	 */
	protected function log($sqlStatement, $type){
	}

	/**
	 * Sets a database profiler to the connection
	 *
	 * @param Phalcon_Db_Profiler $profiler
	 */
	public function setProfiler($profiler){
	}

	/**
	 * Returns the first row in a SQL query result
	 *
	 * <code>
	 * //Getting first robot
	 * $robot = $connection->fecthOne("SELECT * FROM robots");
	 * print_r($robot);
	 * </code>
	 *
	 * @param string $sqlQuery
	 * @return array
	 */
	public function fetchOne($sqlQuery){
	}

	/**
	 * Dumps the complete result of a query into an array
	 *
	 * <code>
	 * //Getting all robots
	 * $robots = $connection->fetchAll("SELECT * FROM robots");
	 * foreach($robots as $robot){
	 *    print_r($robot);
	 * }
	 * </code>
	 *
	 * @param string $sqlQuery
	 * @return array
	 */
	public function fetchAll($sqlQuery){
	}

	/**
	 * Inserts data into a table using custom RBDM SQL syntax
	 *
	 * <code>
	 * //Inserting a new robot
	 * $success = $connection->insert(
	 *     "robots",
	 *     array("Astro Boy", 1952),
	 *     array("name", "year")
	 * );
	 *
	 * //Next SQL sentence is sent to the database system
	 * INSERT INTO `robots` (`name`, `year`) VALUES ("Astro boy", 1952);
	 * </code>
	 *
	 * @param string $tables
	 * @param array $values
	 * @param array $fields
	 * @param boolean $automaticQuotes
	 * @return boolean
	 */
	public function insert($table, $values, $fields=NULL, $automaticQuotes=false){
	}

	/**
	 * Updates data on a table using custom RBDM SQL syntax
	 *
	 * <code>
	 * //Updating existing robot
	 * $success = $connection->update(
	 *     "robots",
	 *     array("name")
	 *     array("New Astro Boy"),
	 *     "id = 101"
	 * );
	 *
	 * //Next SQL sentence is sent to the database system
	 * UPDATE `robots` SET `name` = "Astro boy" WHERE id = 101
	 * </code>
	 *
	 * @param string $tables
	 * @param array $fields
	 * @param array $values
	 * @param string $whereCondition
	 * @param boolean $automaticQuotes
	 * @return boolean
	 */
	public function update($table, $fields, $values, $whereCondition=NULL, $automaticQuotes=false){
	}

	/**
	 * Deletes data from a table using custom RBDM SQL syntax
	 *
	 * <code>
	 * //Deleting existing robot
	 * $success = $connection->delete(
	 *     "robots",
	 *     "id = 101"
	 * );
	 *
	 * //Next SQL sentence is generated
	 * DELETE FROM `robots` WHERE id = 101
	 * </code>
	 *
	 * @param string $tables
	 * @param string $whereCondition
	 * @return boolean
	 */
	public function delete($table, $whereCondition=''){
	}

	/**
     * Starts a transaction in the connection
     *
     * @return boolean
     */
	public function begin(){
	}

	/**
     * Rollbacks the active transaction in the connection
     *
     * @return boolean
     */
	public function rollback(){
	}

	/**
     * Commits the active transaction in the connection
     *
     * @return boolean
     */
	public function commit(){
	}

	/**
	 * Manually sets a "under transaction" state for the connection
	 *
	 * @param boolean $underTransaction
	 */
	protected function setUnderTransaction($underTransaction){
	}

	/**
	 * Checks whether connection is under database transaction
	 *
	 * @return boolean
	 */
	public function isUnderTransaction(){
	}

	/**
	 * Checks whether connection have auto commit
	 *
	 * @return boolean
	 */
	public function getHaveAutoCommit(){
	}

	/**
	 * Returns database name in the internal connection
	 *
	 * @return string
	 */
	public function getDatabaseName(){
	}

	/**
	 * Returns active schema name in the internal connection
	 *
	 * @return string
	 */
	public function getDefaultSchema(){
	}

	/**
	 * Returns the username which has connected to the database
	 *
	 * @return string
	 */
	public function getUsername(){
	}

	/**
	 * Returns the username which has connected to the database
     *
	 * @return string
	 */
	public function getHostName(){
	}

	/**
	 * Gets an active connection unique identifier
	 *
	 * @return string
	 */
	public function getConnectionId($asString=false){
	}

	/**
	 * This method is executed before every SQL statement sent to the database system
	 *
	 * @param string $sqlStatement
	 */
	protected function _beforeQuery($sqlStatement){
	}

	/**
	 * This method is executed after every SQL statement sent to the database system
	 *
	 * @param string $sqlStatement
	 */
	protected function _afterQuery($sqlStatement){
	}

	/**
	 * Instantiates Phalcon_Db adapter using given parameters
	 *
	 * @param string $adapterName
	 * @param stdClass $options
	 * @return Phalcon_Db
	 */
	public static function factory($adapterName, $options){
	}

}

/**
 * Phalcon_Dispatcher
 *
 * Dispatching is the process of taking the request object, extracting the module name,
 * controller name, action name, and optional parameters contained in it, and then
 * instantiating a controller and calling an action of that controller.
 *
 * <code>
 *
 *$dispatcher = new Phalcon_Dispatcher();
 *
 *$request = Phalcon_Request::getInstance();
 *$response = Phalcon_Response::getInstance();
 *
 *$dispatcher->setBasePath('./');
 *$dispatcher->setControllersDir('tests/controllers/');
 *
 *$dispatcher->setControllerName('posts');
 *$dispatcher->setActionName('index');
 *$dispatcher->setParams(array());
 *$controller = $dispatcher->dispatch($request, $response);
 *
 *</code>
 */
class Phalcon_Dispatcher
{
	/**
	 * Sets default controllers directory. Depending of your platform, always add a trailing slash or backslash
	 *
	 * @param string $controllersDir
	 */
	public function setControllersDir($controllersDir){
	}

	/**
	 * Gets active controllers directory
	 *
	 * @return string
	 */
	public function getControllersDir(){
	}

	/**
	 * Sets base path for controllers dir. Depending of your platform, always add a trailing slash or backslash
	 *
	 * @param string $basePath
	 */
	public function setBasePath($basePath){
	}

	/**
	 * Gets base path for controllers dir
	 *
	 * @return string
	 */
	public function getBasePath(){
	}

	/**
	 * Sets the controller name to be dispatched
	 *
	 * @param string $controllerName
	 */
	public function setControllerName($controllerName){
	}

	/**
	 * Gets last dispatched controller name
	 *
	 * @return string
	 */
	public function getControllerName(){
	}

	/**
	 * Sets the action name to be dispatched
	 *
	 * @param string $actionName
	 */
	public function setActionName($actionName){
	}

	/**
	 * Gets last dispatched action name
	 *
	 * @return string
	 */
	public function getActionName(){
	}

	/**
	 * Sets action params to be dispatched
	 *
	 * @param array $params
	 */
	public function setParams($params){
	}

	/**
	 * Gets action params
	 *
	 * @return array
	 */
	public function getParams(){
	}

	/**
	 * Gets a param by its name or numeric index
     *
     * @param  mixed $param
	 * @return mixed
	 */
	public function getParam($index){
	}

	/**
	 * Dispatches a controller action taking into account the routing parameters
	 *
	 * @param Phalcon_Request $request
	 * @param Phalcon_Response $response
	 * @param Phalcon_View $view
	 * @param Phalcon_Model_Manager $model
	 * @return Phalcon_Controller
	 */
	public function dispatch($request, $response, $view=NULL, $model=NULL){
	}

	/**
	 * Throws an internal exception
	 *
	 * @param Phalcon_Response $response
	 * @param string $message
	 */
	protected function _throwDispatchException($response, $message){
	}

	/**
	 * Routes to a controller/action using a string or array uri
	 *
	 * @param string $uri
	 */
	public function forward($uri){
	}

	/**
	 * Returns all instantiated controllers whitin the dispatcher
	 *
	 * @return array
	 */
	public function getControllers(){
	}

	/**
	 * Returns last dispatched controller
	 *
	 * @return Phalcon_Controller
	 */
	public function getLastController(){
	}

	/**
	 * Returns value returned by last dispacthed action
	 *
	 * @return mixed
	 */
	public function getReturnedValue(){
	}

}

/**
 * Phalcon_Exception
 *
 * All framework exceptions should use this exception
 */
class Phalcon_Exception extends Exception
{
	
	final private function __clone(){
	}

	
	public function __construct($message, $code, $previous){
	}

	
	final public function getMessage(){
	}

	
	final public function getCode(){
	}

	
	final public function getFile(){
	}

	
	final public function getLine(){
	}

	
	final public function getTrace(){
	}

	
	final public function getPrevious(){
	}

	
	final public function getTraceAsString(){
	}

	
	public function __toString(){
	}

}

/**
 * Phalcon_Filter
 *
 * The Phalcon_Filter component provides a set of commonly needed data filters. It provides
 * object oriented wrappers to the php filter extension
 *
 *<code>
 *$filter = new Phalcon_Filter();
 *$filter->sanitize("some(one)@exa\\mple.com", "email"); // returns "someone@example.com"
 *$filter->sanitize("hello<<", "string"); // returns "hello"
 *$filter->sanitize("!100a019", "int"); // returns "!100a019"
 *$filter->sanitize("!100a019.01a", "float"); // returns "100019.01"
 *</code>
 *
 */
class Phalcon_Filter
{
	/**
	 * Sanizites a value with a specified single or set of filters
	 *
	 * @param  mixed $value
	 * @param  mixed $filters
	 * @param  boolean $silent
	 * @return mixed
	 */
	public function sanitize($value, $filters, $silent=false){
	}

	/**
	 * Filters a value with a specified single or set of filters
	 *
	 * @param  mixed $value
	 * @param  array $filters
	 * @param  boolean $silent
	 * @return mixed
	 */
	public function filter($value, $filters, $silent=false){
	}

	/**
	 * Sanitize and Filter a value with a specified single or set of filters
	 *
	 * @param  mixed $value
	 * @param  array $filters
	 * @return mixed
	 */
	public function sanitizeAndFilter($value, $filters){
	}

	/**
	 * Internal sanizite wrapper to filter_var
	 *
	 * @param  mixed $value
	 * @param  mixed $filters
	 * @param  boolean $silent
	 * @return mixed
	 */
	protected function _sanitize($value, $filter, $silent=false){
	}

	/**
	 * Internal filter function
	 *
	 * @param	mixed $value
	 * @param	array $filters
	 * @param  boolean $silent
	 * @return	mixed
	 */
	protected function _filter($value, $filter, $silent=false){
	}

}

/**
 * Phalcon_Flash
 *
 * Shows HTML notifications related to different circumstances. Classes can be stylized using CSS
 */
class Phalcon_Flash
{
	
	private static function _showMessage($message, $classes){
	}

	/**
	 * Shows a HTML error message
	 *
	 * <code>Phalcon_Flash::error('This is an error'); </code>
	 *
	 * @param string $message
	 * @param string $classes
	 * @return string
	 */
	public static function error($message, $classes='errorMessage'){
	}

	/**
	 * Shows a HTML notice/information message
	 *
     * <code>Phalcon_Flash::notice('This is an information'); </code>
	 *
	 * @param string $message
	 * @param string $classes
	 * @return string
	 */
	public static function notice($message, $classes='noticeMessage'){
	}

	/**
	 * Shows a HTML success message
	 *
	 * <code>Phalcon_Flash::success('The process was finished successfully'); </code>
	 *
	 * @param string $message
	 * @param string $classes
	 * @return string
	 */
	public static function success($message, $classes='successMessage'){
	}

	/**
	 * Shows a HTML warning message
	 *
	 * <code>Phalcon_Flash::warning('Hey, this is important'); </code>
	 * <code>Phalcon_Flash::warning('Hey, this is important', 'alert alert-warning'); </code>
	 *
	 * @param string $message
	 * @param string $classes
	 * @return string
	 */
	public static function warning($message, $classes='warningMessage'){
	}

}

/**
 * Phalcon_Loader
 *
 * This component helps to load your project classes automatically based on some conventions
 *
 *<code>
 * //Creates the autoloader
 *$loader = new Phalcon_Loader();
 *
 * //Register some namespaces
 *$loader->registerNamespaces(array(
 *   'Example\\Base' => 'vendor/example/base/',
 *   'Example\\Adapter' => 'vendor/example/adapter/'
 *   'Example' => 'vendor/example/'
 *));
 *
 * //register autoloader
 * $loader->register();
 *
 * //Requiring class will automatically include file vendor/example/adapter/Some.php
 * $adapter = Example\Adapter\Some();
 *</code>
 */
class Phalcon_Loader
{
	/**
	 * Register namespaces and its related directories
	 *
	 * @param array $directories
	 */
	public function registerNamespaces($namespaces){
	}

	/**
	 * Register directories on which not found classes could be found
	 *
	 * @param array $directories
	 */
	public function registerDirs($directories){
	}

	/**
	 * Register the autoload method
	 */
	public function register(){
	}

	/**
	 * Makes the work of autoload registered classes
	 *
	 * @param string $className
	 */
	public function autoLoad($className){
	}

}

/**
 * Phalcon_Logger
 *
 * Phalcon_Logger is a component whose purpose is to create logs using
 * different backends via adapters, generating options, formats and filters
 * also implementing transactions.
 *
 *<code>
 *$logger = new Phalcon_Logger("File", "app/logs/test.log");
 *$logger->log("This is a message");
 *$logger->log("This is an error", Phalcon_Logger::ERROR);
 *$logger->error("This is another error");
 *$logger->close();
 * </code>
 */
class Phalcon_Logger
{
	const SPECIAL = 9;
	const CUSTOM = 8;
	const DEBUG = 7;
	const INFO = 6;
	const NOTICE = 5;
	const WARNING = 4;
	const ERROR = 3;
	const ALERT = 2;
	const CRITICAL = 1;
	const EMERGENCE = 0;
	/**
	 * Phalcon_Logger constructor
	 *
	 * @param string $adapter
	 * @param string $name
	 * @param array $options
	 */
	public function __construct($adapter='File', $name=NULL, $options=array ()){
	}

	/**
 	 * Sends/Writes a message to the log
 	 *
 	 * @param string $message
 	 * @param ing $type
 	 */
	public function log($message, $type=7){
	}

	/**
 	 * Sends/Writes a debug message to the log
 	 *
 	 * @param string $message
 	 * @param ing $type
 	 */
	public function debug($message){
	}

	/**
 	 * Sends/Writes an error message to the log
 	 *
 	 * @param string $message
 	 * @param ing $type
 	 */
	public function error($message){
	}

	/**
 	 * Sends/Writes an info message to the log
 	 *
 	 * @param string $message
 	 * @param ing $type
 	 */
	public function info($message){
	}

	/**
 	 * Sends/Writes a notice message to the log
 	 *
 	 * @param string $message
 	 * @param ing $type
 	 */
	public function notice($message){
	}

	/**
 	 * Sends/Writes a warning message to the log
 	 *
 	 * @param string $message
 	 * @param ing $type
 	 */
	public function warning($message){
	}

	/**
 	 * Sends/Writes an alert message to the log
 	 *
 	 * @param string $message
 	 * @param ing $type
 	 */
	public function alert($message){
	}

	/**
	 * Pass any call to the internal adapter object
	 *
	 * @param  string $method
	 * @param  array $arguments
	 * @return mixed
	 */
	public function __call($method, $arguments=array ()){
	}

}

/**
 * Phalcon_Paginator
 *
 * Phalcon_Paginator is designed to simplify building of pagination on views
 *
 * <code>
 *
 * 
 *  use Tag as Phalcon_Tag;
 *
 *  $numberPage = (int) $_GET['page'];
 *
 *  $paginator = Phalcon_Paginator::factory('Model', array(
 *     'data' => $robots,
 *     'limit' => 10,
 *     'page' => $numberPage
 *  ));
 *  $page = $paginator->getPaginate();
 * ?>
 *
 *  <table>
 *   <tr>
 *     <th>Id</th>
 *     <th>Name</th>
 *     <th>Type</th>
 *   </tr>
 *   foreach($page->items as $item){ ?>
 *    <tr>
 *     <td> echo $item->id ?></td>
 *     <td> echo $item->name ?></td>
 *     <td> echo $item->type ?></td>
 *    </tr>
 *   } ?>
 *  </table>
 *
 *  <table>
 *    <tr>
 *       <td><?= Tag::linkTo("robots/search", "First") ?></td>
 *       <td><?= Tag::linkTo("robots/search?page=".$page->before, "Previous") ?></td>
 *       <td><?= Tag::linkTo("robots/search?page=".$page->next, "Next") ?></td>
 *       <td><?= Tag::linkTo("robots/search?page=".$page->last, "Last") ?></td>
 *       <td> echo $page->current, "/", $page->total_pages ?></td>
 *    </tr>
 *  </table>
 * </code>
 *
 */
abstract class Phalcon_Paginator
{
	/**
     * Factories a paginator adapter
     *
     * @param   string $adapterName
     * @param   array $options
     * @return  Object
     */
	public static function factory($adapterName, $options=array ()){
	}

}

/**
 * Phalcon_Request
 *
 * <p>Encapsulates request information for easy and secure access from application controllers.</p>
 *
 * <p>The request object is a simple value object that is passed between the dispatcher and controller classes.
 * It packages the HTTP request environment.</p>
 *
 * <code>
 *$request = Phalcon_Request::getInstance();
 *if ($request->isPost() == true){
 * if ($request->isAjax() == true){
 *   echo 'Request was made using POST and AJAX';
 * }
 *}
 * </code>
 *
 */
class Phalcon_Request
{
	/**
	 * Gets the singleton instance of Phalcon_Request
	 *
	 * @return Phalcon_Request
	 */
	public static function getInstance(){
	}

	/**
	 * Overwrites Phalcon_Filter object used to sanitize input data
	 *
	 * @param Phalcon_Filter $filter
	 */
	public function setFilter($filter){
	}

	/**
	 * Returns the active filter object used to sanitize input data
	 *
	 * @return Phalcon_Filter
	 */
	protected function getFilter(){
	}

	/**
	 * Gets variable from $_POST superglobal applying filters if needed
	 *
	 * @param string $name
	 * @param string|array $filters
	 * @return mixed
	 */
	public function getPost($name, $filters=NULL){
	}

	/**
	 * Gets variable from $_GET superglobal applying filters if needed
	 *
	 * @param string $name
	 * @param string|array $filters
	 * @return mixed
	 */
	public function getQuery($name, $filters=NULL){
	}

	/**
	 * Gets variable from $_SERVER superglobal
	 *
	 * @param string $name
	 * @return mixed
	 */
	public function getServer($name){
	}

	/**
	 * Checks whether $_POST superglobal has certain index
	 *
	 * @param string $name
	 * @return boolean
	 */
	public function hasPost($name){
	}

	/**
	 * Checks whether $_SERVER superglobal has certain index
	 *
	 * @param string $name
	 * @return boolean
	 */
	public function hasQuery($name){
	}

	/**
	 * Checks whether $_SERVER superglobal has certain index
	 *
	 * @param string $name
	 * @return mixed
	 */
	public function hasServer($name){
	}

	/**
	 * Gets HTTP header from request data
	 *
	 * @param string $header
	 * @return string
	 */
	public function getHeader($header){
	}

	/**
	 * Gets HTTP schema (http/https)
	 *
	 * @return string
	 */
	public function getScheme(){
	}

	/**
	 * Checks whether request has been made using ajax
	 *
	 * @return boolean
	 */
	public function isAjax(){
	}

	/**
	 * Checks whether request has been made using SOAP
	 *
	 * @return boolean
	 */
	public function isSoapRequested(){
	}

	/**
	 * Checks whether request has been made using any secure layer
	 *
	 * @return boolean
	 */
	public function isSecureRequest(){
	}

	/**
	 * Gets HTTP raws request body
	 *
	 * @return string
	 */
	public function getRawBody(){
	}

	/**
	 * Gets active server address IP
	 *
	 * @return string
	 */
	public function getServerAddress(){
	}

	/**
	 * Gets active server name
	 *
	 * @return string
	 */
	public function getServerName(){
	}

	/**
	 * Gets information about schema, host and port used by the request
	 *
	 * @return string
	 */
	public function getHttpHost(){
	}

	/**
	 * Gets most possibly client IPv4 Address
	 *
	 * @return string
	 */
	public function getClientAddress(){
	}

	/**
	 * Gets HTTP method which request has been made
	 *
	 * @return string
	 */
	public function getMethod(){
	}

	/**
	 * Gets HTTP user agent used to made the request
	 *
	 * @return string
	 */
	public function getUserAgent(){
	}

	/**
	 * Checks whether HTTP method is POST
	 *
	 * @return boolean
	 */
	public function isPost(){
	}

	/**
	 * Checks whether HTTP method is GET
	 *
	 * @return boolean
	 */
	public function isGet(){
	}

	/**
	 * Checks whether HTTP method is PUT
	 *
	 * @return boolean
	 */
	public function isPut(){
	}

	/**
	 * Checks whether HTTP method is HEAD
	 *
	 * @return boolean
	 */
	public function isHead(){
	}

	/**
	 * Checks whether HTTP method is DELETE
	 *
	 * @return boolean
	 */
	public function isDelete(){
	}

	/**
	 * Checks whether HTTP method is OPTIONS
	 *
	 * @return boolean
	 */
	public function isOptions(){
	}

	/**
	 * Checks whether request include attached files
	 *
	 * @return boolean
	 */
	public function hasFiles(){
	}

	/**
	 * Gets attached files as Phalcon_Request_File instances
	 *
	 * @return array
	 */
	public function getUploadedFiles(){
	}

	/**
	 * Gets web page that refers active request. ie: http://www.google.com
	 *
	 * @return string
	 */
	public function getHTTPReferer(){
	}

	
	protected function _getQualityHeader($serverIndex, $name){
	}

	
	protected function _getBestQuality($qualityParts, $name){
	}

	/**
	 * Gets array with mime/types and their quality accepted by the browser/client from $_SERVER['HTTP_ACCEPT']
	 *
	 * @return array
	 */
	public function getAcceptableContent(){
	}

	/**
	 * Gets best mime/type accepted by the browser/client from $_SERVER['HTTP_ACCEPT']
	 *
	 * @return array
	 */
	public function getBestAccept(){
	}

	/**
	 * Gets charsets array and their quality accepted by the browser/client from $_SERVER['HTTP_ACCEPT_CHARSET']
	 *
	 * @return array
	 */
	public function getClientCharsets(){
	}

	/**
	 * Gets best charset accepted by the browser/client from $_SERVER['HTTP_ACCEPT_CHARSET']
	 *
	 * @return string
	 */
	public function getBestCharset(){
	}

	/**
	 * Gets languages array and their quality accepted by the browser/client from $_SERVER['HTTP_ACCEPT_LANGUAGE']
	 *
	 * @return array
	 */
	public function getLanguages(){
	}

	/**
	 * Gets best language accepted by the browser/client from $_SERVER['HTTP_ACCEPT_LANGUAGE']
	 *
	 * @return string
	 */
	public function getBestLanguage(){
	}

}

/**
 * Phalcon_Response
 *
 * Encapsulates the HTTP response message.
 *
 *<code>
 *$response = Phalcon_Response::getInstance();
 *$response->setStatusCode(200, "OK");
 *$response->setContent("<html><body>Hello</body></html>");
 *$response->send();
 *</code>
 */
class Phalcon_Response
{
	/**
	 * Returns singleton Phalcon_Response instance
	 *
	 * @return Phalcon_Response
	 */
	public static function getInstance(){
	}

	/**
	 * Sets the HTTP response code
	 *
	 * @param int $code
	 * @param strign $message
	 */
	public function setStatusCode($code, $message){
	}

	/**
	 * Overwrites a header in the response
	 *
	 *<code>
	 *$response->setHeader("Content-Type", "text/plain");
	 *</code>
	 *
	 * @param string $name
	 * @param string $value
	 */
	public function setHeader($name, $value){
	}

	/**
	 * Send a raw header to the response
	 *
	 *<code>
	 *$response->setRawHeader("HTTP/1.1 404 Not Found");
	 *</code>
	 */
	public function setRawHeader($header){
	}

	/**
	 * Sets HTTP response body
     *
	 *<code>
	 *$response->setContent("<h1>Hello!</h1>");
	 *</code>
	 *
	 * @param string $content
	 */
	public function setContent($content){
	}

	/**
	 * Appends a string to the HTTP response body
	 *
	 * @param string $content
	 */
	public function appendContent($content){
	}

	/**
	 * Gets HTTP response body
	 *
	 * @return string
	 */
	public function getContent(){
	}

	/**
	 * Sends HTTP response to the client
	 *
	 */
	public function send(){
	}

}

/**
 * Phalcon_Session
 *
 * Session client-server persistent state data management.
 */
abstract class Phalcon_Session
{
	/**
	 * Starts session, optionally using an adapter
	 *
	 * @param array $options
	 */
	public static function start($options=array ()){
	}

	/**
	 * Sets session options
	 *
	 * @param array $options
	 */
	public static function setOptions($options){
	}

	/**
	 * Gets a session variable from an application context
	 *
	 * @param string $index
	 */
	public static function get($index){
	}

	/**
	 * Sets a session variable in an application context
	 *
	 * @param string $index
	 * @param string $value
	 */
	public static function set($index, $value){
	}

	/**
	 * Check whether a session variable is set in an application context
	 *
	 * @param string $index
	 */
	public static function has($index){
	}

	/**
	 * Removes a session variable from an application context
	 *
	 * @param string $index
	 */
	public static function remove($index){
	}

	/**
	 * Returns active session id
	 *
	 * @return string
	 */
	public static function getId(){
	}

}

/**
 * Phalcon_Tag
 *
 * Phalcon_Tag is designed to simplify building of HTML tags.
 * It provides a set of helpers to generate HTML in a dynamic way.
 * This component is an abstract class that you can extend to add more helpers.
 */
abstract class Phalcon_Tag
{
	/**
	 * Sets the request dispatcher. A valid dispatcher is required to generate absolute paths
	 *
	 * @param Phalcon_Dispatcher $dispatcher
	 */
	public static function setDispatcher($dispatcher){
	}

	/**
	 * Internally gets the request dispatcher
	 *
	 * @return Phalcon_Dispatcher
	 */
	protected static function _getDispatcher(){
	}

	/**
	 * Assigns default values to generated tags by helpers
	 *
	 * <code>
	 * //Assigning "peter" to "name" component
	 * Phalcon_Tag::setDefault("name", "peter");
	 *
	 * //Later in the view
	 * echo Phalcon_Tag::textField("name"); //Will have the value "peter" by default
	 * </code>
	 *
	 * @param string $id
	 * @param string $value
	 */
	public static function setDefault($id, $value){
	}

	/**
	 * Alias of Phalcon_Tag::setDefault
	 *
	 * @param string $id
	 * @param string $value
	 */
	public static function displayTo($id, $value){
	}

	/**
	 * Every helper calls this function to check whether a component has a predefined
	 * value using Phalcon_Tag::displayTo or value from $_POST
	 *
	 * @param string $name
	 * @return mixed
	 */
	public static function getValue($name){
	}

	/**
	 * Resets the request and internal values to avoid those fields will have any default value
	 */
	public static function resetInput(){
	}

	/**
	 * Builds a HTML A tag using framework conventions
	 *
	 * <code>echo Phalcon_Tag::linkTo('signup/register', 'Register Here!')</code>
	 *
	 * @param	array $parameters
	 * @return	string
	 */
	public static function linkTo($parameters, $text=NULL){
	}

	/**
	 * Builds generic INPUT tags
	 *
	 * @param   string $type
	 * @param	array $parameters
	 * @return	string
	 */
	protected static function _inputField($type, $parameters){
	}

	/**
	 * Builds a HTML input[type="text"] tag
	 *
	 * <code>echo Phalcon_Tag::textField(array("name", "size" => 30))</code>
	 *
	 * @param	array $parameters
	 * @return	string
	 */
	public static function textField($parameters){
	}

	/**
	 * Builds a HTML input[type="password"] tag
	 *
	 * <code>echo Phalcon_Tag::passwordField(array("name", "size" => 30))</code>
	 *
	 * @param	array $parameters
	 * @return	string
	 */
	public static function passwordField($parameters){
	}

	/**
	 * Builds a HTML input[type="hidden"] tag
	 *
	 * <code>echo Phalcon_Tag::hiddenField(array("name", "value" => "mike"))</code>
	 *
	 * @param	array $parameters
	 * @return	string
	 */
	public static function hiddenField($parameters){
	}

	/**
	 * Builds a HTML input[type="file"] tag
	 *
	 * <code>echo Phalcon_Tag::fileField("file")</code>
	 *
	 * @param	array $parameters
	 * @return	string
	 */
	public static function fileField($parameters){
	}

	/**
	 * Builds a HTML input[type="check"] tag
	 *
	 * <code>echo Phalcon_Tag::checkField(array("name", "size" => 30))</code>
	 *
	 * @param	array $parameters
	 * @return	string
	 */
	public static function checkField($parameters){
	}

	/**
	 * Builds a HTML input[type="submit"] tag
	 *
	 * <code>echo Phalcon_Tag::submitButton("Save")</code>
	 *
	 * @param	array $params
	 * @return	string
	 */
	public static function submitButton($parameters){
	}

	/**
	 * Builds a HTML SELECT tag using a PHP array for options
	 *
	 * <code>echo Phalcon_Tag::selectStatic("status", array("A" => "Active", "I" => "Inactive"))</code>
	 *
	 * @param	array $parameters
	 * @return	string
	 */
	public static function selectStatic($parameters, $data=NULL){
	}

	/**
	 * Builds a HTML SELECT tag using a Phalcon_Model resultset as options
	 *
	 * <code>echo Phalcon_Tag::selectStatic(array(
	 *	"robotId",
	 *	Robots::find("type = 'mechanical'"),
	 *	"using" => array("id", "name")
	 * ))</code>
	 *
	 * @param	array $params
	 * @return	string
	 */
	public static function select($parameters, $data=NULL){
	}

	/**
	 * Builds a HTML TEXTAREA tag
	 *
	 * <code>echo Phalcon_Tag::textArea(array("comments", "cols" => 10, "rows" => 4))</code>
	 *
	 * @param	array $parameters
	 * @return	string
	 */
	public static function textArea($parameters){
	}

	/**
	 * Builds a HTML FORM tag
	 *
	 * <code>
	 * echo Phalcon_Tag::form("posts/save");
	 * echo Phalcon_Tag::form(array("posts/save", "method" => "post"));
	 * </code>
	 *
	 * @param	array $parameters
	 * @return	string
	 */
	public static function form($parameters=NULL){
	}

	/**
	 * Builds a HTML close FORM tag
	 *
	 * @return	string
	 */
	public static function endForm(){
	}

	/**
	 * Set the title of view content
	 *
	 * @param string $title
	 */
	public static function setTitle($title){
	}

	/**
	 * Add to title of view content
	 *
	 * @param string $title
	 */
	public static function appendTitle($title){
	}

	/**
	 * Add before the title of view content
	 *
	 * @param string $title
	 */
	public static function prependTitle($title){
	}

	/**
	 * Get the title of view content
	 *
	 * @return string
	 */
	public static function getTitle(){
	}

	/**
	 * Builds a LINK[rel="stylesheet"] tag
	 *
	 * <code>
	 * echo Phalcon_Tag::stylesheetLink("http://fonts.googleapis.com/css?family=Rosario", false);
	 * echo Phalcon_Tag::stylesheetLink("css/style.css");
	 * </code>
	 *
	 * @param	array $parameters
	 * @param   boolean $local
	 * @return	string
	 */
	public static function stylesheetLink($parameters=NULL, $local=true){
	}

	/**
	 * Builds a SCRIPT[type="javascript"] tag
	 *
	 * <code>
	 * echo Phalcon_Tag::javascriptInclude("http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false);
	 * echo Phalcon_Tag::javascriptInclude("javascript/jquery.js");
	 * </code>
	 *
	 * @param	array $parameters
	 * @param   boolean $local
	 * @return	string
	 */
	public static function javascriptInclude($parameters=NULL, $local=true){
	}

	/**
	 * Builds HTML IMG tags
	 *
	 * @param  array $parameters
	 * @return string
	 */
	public static function image($parameters=NULL){
	}

}


class Phalcon_Text
{
	/**
	 * Converts strings to camelize style
	 *
	 * <code>Phalcon_Utils::camelize('coco_bongo'); //CocoBongo</code>
	 *
	 * @param string $str
	 * @return string
	 */
	public static function camelize($str){
	}

	/**
	 * Uncamelize strings which are camelized
	 *
	 * <code>Phalcon_Utils::camelize('CocoBongo'); //coco_bongo</code>
	 *
	 * @param string $str
	 * @return string
	 */
	public static function uncamelize($str){
	}

	/**
     * Changes only first letter to lowercase
     *
     * @param 	string $str
     * @return 	string
     * @static
     **/
	public static function lcfirst($str){
	}

}

/**
 * Phalcon_Transaction
 *
 * Transactions are protective blocks where SQL statements are only permanent if they can
 * all succeed as one atomic action. Phalcon_Transaction is intended to be used with Phalcon_Model_Base.
 * Phalcon Transactions should be created using Phalcon_Transaction_Manager.
 *
 *<code>
 *try {
 *
 *  $transaction = Phalcon_Transaction_Manager::get();
 *
 *  $robot = new Robots();
 *  $robot->setTransaction($transaction);
 *  $robot->name = 'WALL·E';
 *  $robot->created_at = date('Y-m-d');
 *  if($robot->save()==false){
 *    $transaction->rollback("Can't save robot");
 *  }
 *
 *  $robotPart = new RobotParts();
 *  $robotPart->setTransaction($transaction);
 *  $robotPart->type = 'head';
 *  if($robotPart->save()==false){
 *    $transaction->rollback("Can't save robot part");
 *  }
 *
 *  $transaction->commit();
 *
 *}
 *catch(Phalcon_Transaction_Failed $e){
 *  echo 'Failed, reason: ', $e->getMessage();
 *}
 *
 *</code>
 */
class Phalcon_Transaction
{
	/**
	 * Phalcon_Transaction constructor
	 *
	 * @param boolean $autoBegin
	 */
	public function __construct($autoBegin=false){
	}

	/**
	 * Sets transaction manager related to the transaction
	 *
	 * @param Phalcon_Transaction_Manager $manager
	 */
	public function setTransactionManager($manager){
	}

	/**
	 * Starts the transaction
	 */
	public function begin(){
	}

	/**
	 * Commits the transaction
	 *
	 * @return boolean
	 */
	public function commit(){
	}

	/**
	 * Rollbacks the transaction
	 *
	 * @param  string $rollbackMessage
	 * @param  Phalcon_Model_Base $rollbackRecord
	 * @return boolean
	 */
	public function rollback($rollbackMessage=NULL, $rollbackRecord=NULL){
	}

	/**
	 * Returns connection related to transaction
	 *
	 * @return Phalcon_Db
	 */
	public function getConnection(){
	}

	/**
	 * Sets if is a reused transaction or new once
	 *
	 * @param boolean $isNew
	 */
	public function setIsNewTransaction($isNew){
	}

	/**
	 * Sets flag to rollback on abort the HTTP connection
	 *
	 * @param boolean $rollbackOnAbort
	 */
	public function setRollbackOnAbort($rollbackOnAbort){
	}

	/**
	 * Checks whether transaction is managed by a transaction manager
	 *
	 * @return boolean
	 */
	public function isManaged(){
	}

	/**
	 * Changes dependency internal pointer
	 *
	 * @param int $pointer
	 */
	public function setDependencyPointer($pointer){
	}

	/**
	 * Attaches Phalcon_Model_Base object to the active transaction
	 *
	 * @param int $pointer
	 * @param Phalcon_Model_Base $object
	 */
	public function attachDependency($pointer, $object){
	}

	/**
	 * Make a bulk save on all attached objects
	 *
	 * @return boolean
	 */
	public function save(){
	}

	/**
	 * Returns validations messages from last save try
	 *
	 * @return array
	 */
	public function getMessages(){
	}

	/**
     * Checks whether internal connection is under an active transaction
     *
     * @return boolean
     */
	public function isValid(){
	}

	/**
	 * Sets object which generates rollback action
	 *
	 * @param Phalcon_Model_Base $record
	 */
	public function setRollbackedRecord($record){
	}

}

/**
 * Phalcon_Translate
 *
 * Translate component allows the creation of multi-language applications using
 * different adapters for translation lists.
 */
class Phalcon_Translate implements ArrayAccess
{
	/**
	 * Phalcon_Translate constructor
	 *
	 * @param	string $adapter
	 * @param	array $options
	 */
	public function __construct($adapter, $options){
	}

	/**
	 * Returns the translation string of the given key
	 *
	 * @param	string $translateKey
	 * @return	string
	 */
	public function _($translateKey){
	}

	/**
	 * Sets a translation value
	 *
	 * @param 	string $offset
	 * @param 	string $value
	 */
	public function offsetSet($offset, $value){
	}

	/**
     * Check whether a translation key exists
     *
     * @param	string $translateKey
     * @return	boolean
     */
	public function offsetExists($translateKey){
	}

	/**
     * Elimina un indice del diccionario
     *
     * @param	string $offset
     */
	public function offsetUnset($offset){
	}

	/**
	 * Returns the translation related to the given key
	 *
	 * @param	string $traslateKey
	 * @return	string
	 */
	public function offsetGet($traslateKey){
	}

}

/**
 * Phalcon_Utils
 *
 * Implements functionality used widely by the framework
 */
class Phalcon_Utils
{
	/**
	 * This function is now deprecated, use Phalcon_Text::camelize instead
	 *
	 * @param string $str
	 * @return string
	 */
	public static function camelize($str){
	}

	/**
	 * This function is now deprecated, use Phalcon_Text::uncamelize instead
	 *
	 * @param string $str
	 * @return string
	 */
	public static function uncamelize($str){
	}

	/**
	 * This function is now deprecated, use Phalcon_Text::lcfirst instead
	 *
	 * @param string $str
	 * @return string
	 */
	public static function lcfirst($str){
	}

	/**
	 * Gets public URL to phalcon instance
	 *
	 * @param string $uri
	 * @return string
	 */
	public static function getUrl($uri=''){
	}

	/**
	 * Gets path to local file
	 *
	 * @param string $extraPath
	 * @return string
	 */
	public static function getLocalPath($extraPath=''){
	}

}

/**
 * Phalcon_View
 *
 * Phalcon_View is a class for working with the "view" portion of the model-view-controller pattern.
 * That is, it exists to help keep the view script separate from the model and controller scripts.
 * It provides a system of helpers, output filters, and variable escaping.
 *
 * <code>
 * //Setting views directory
 * $view = new Phalcon_View();
 * $view->setViewsDir('app/views/');
 *
 * $view->start();
 * //Shows recent posts view (app/views/posts/recent.phtml)
 * $view->render('posts', 'recent');
 * $view->finish();
 *
 * //Printing views output
 * echo $view->getContent();
 * </code>
 */
class Phalcon_View
{
	const LEVEL_MAIN_LAYOUT = 5;
	const LEVEL_AFTER_TEMPLATE = 4;
	const LEVEL_LAYOUT = 3;
	const LEVEL_BEFORE_TEMPLATE = 2;
	const LEVEL_ACTION_VIEW = 1;
	const LEVEL_NO_RENDER = 0;
	/**
	 * Sets views directory. Depending of your platform, always add a trailing slash or backslash
	 *
	 * @param string $viewsDir
	 */
	public function setViewsDir($viewsDir){
	}

	/**
	 * Gets views directory
	 *
	 * @return string
	 */
	public function getViewsDir(){
	}

	/**
	 * Sets base path. Depending of your platform, always add a trailing slash or backslash
	 */
	public function setBasePath($basePath){
	}

	/**
	 * Sets the render level for the view
	 *
	 * @param string $level
	 */
	public function setRenderLevel($level){
	}

	/**
	 * Sets default view name. Must be a file without extension in the views directory
	 *
	 * @param string $name
	 */
	public function setMainView($viewPath){
	}

	/**
	 * Appends template before controller layout
	 *
	 * @param string|array $templateBefore
	 */
	public function setTemplateBefore($templateBefore){
	}

	/**
	 * Resets any template before layouts
	 *
	 */
	public function cleanTemplateBefore(){
	}

	/**
	 * Appends template after controller layout
	 *
	 * @param string|array $templateAfter
	 */
	public function setTemplateAfter($templateAfter){
	}

	/**
	 * Resets any template before layouts
	 *
	 */
	public function cleanTemplateAfter(){
	}

	/**
	 * Adds parameters to views (alias of setVar)
	 *
	 * @param string $key
	 * @param mixed $value
	 */
	public function setParamToView($key, $value){
	}

	/**
	 * Adds parameters to views
	 *
	 * @param string $key
	 * @param mixed $value
	 */
	public function setVar($key, $value){
	}

	/**
	 * Returns parameters to views
	 *
	 * @return array
	 */
	public function getParamsToView(){
	}

	/**
	 * Gets the name of the controller rendered
	 *
	 * @return string
	 */
	public function getControllerName(){
	}

	/**
	 * Gets the name of the action rendered
	 *
	 * @return string
	 */
	public function getActionName(){
	}

	/**
	 * Gets extra parameters of the action rendered
	 */
	public function getParams(){
	}

	/**
	 * Starts rendering process
	 */
	public function start(){
	}

	/**
	 * Loads registered template engines, if none is registered use Phalcon_View_Engine_Php
	 *
	 * @return array
	 */
	protected function _loadTemplateEngines(){
	}

	/**
	 * Checks whether view exists on registered extensions and render it
	 */
	protected function _engineRender($engines, $viewPath, $silence){
	}

	/**
	 * Register templating engines
	 *
	 * @param array $engines
	 */
	public function registerEngines($engines){
	}

	/**
	 * Executes render process from request data
	 *
	 * @param string $controllerName
	 * @param string $actionName
	 * @param array $params
	 */
	public function render($controllerName, $actionName, $params=array ()){
	}

	/**
	 * Renders a partial view
	 *
	 * @param string $partialPath
	 */
	public function partial($partialPath){
	}

	/**
	 * Finishes the render process
	 */
	public function finish(){
	}

	/**
	 * Set externally the view content
	 *
	 * @param string $content
	 */
	public function setContent($content){
	}

	/**
	 * Returns cached ouput on another view stage
	 *
	 * @return string
	 */
	public function getContent(){
	}

}

/**
 * Phalcon_Acl_Exception
 *
 * Class for exceptions thrown by Phalcon_Acl
 */
class Phalcon_Acl_Exception extends Php_Exception
{
	
	final private function __clone(){
	}

	
	public function __construct($message, $code, $previous){
	}

	
	final public function getMessage(){
	}

	
	final public function getCode(){
	}

	
	final public function getFile(){
	}

	
	final public function getLine(){
	}

	
	final public function getTrace(){
	}

	
	final public function getPrevious(){
	}

	
	final public function getTraceAsString(){
	}

	
	public function __toString(){
	}

}

/**
 *
 * Phalcon_Acl_Resource
 *
 * This class defines resource entity and its description
 *
 */
class Phalcon_Acl_Resource
{
	/**
	 * Phalcon_Acl_Resource description
	 *
	 * @param string $name
	 * @param string $description
	 */
	public function __construct($name, $description=NULL){
	}

	/**
	 * Returns the resource name
	 *
	 * @return string
	 */
	public function getName(){
	}

	/**
	 * Returns resource description
	 *
	 * @return string
	 */
	public function getDescription(){
	}

}

/**
 *
 * Phalcon_Acl_Role
 *
 * This class defines role entity and its description
 *
 */
class Phalcon_Acl_Role
{
	/**
	 * Phalcon_Acl_Role description
	 *
	 * @param string $name
	 * @param string $description
	 */
	public function __construct($name, $description=''){
	}

	/**
	 * Returns the role name
	 *
	 * @return string
	 */
	public function getName(){
	}

	/**
	 * Returns role description
	 *
	 * @return string
	 */
	public function getDescription(){
	}

}

/**
 * Phalcon_Acl_Adapter_Memory
 *
 * Manages ACL lists in memory
 */
class Phalcon_Acl_Adapter_Memory
{
	/**
	 * Permisos de la Lista de Acceso
	 *
	 * @var array
	 */
	public $_access;

	/**
	 * Sets the default access level (Phalcon_Acl::ALLOW or Phalcon_Acl::DENY)
	 */
	public function setDefaultAction($defaultAccess){
	}

	/**
	 * Returns the default ACL access level
	 */
	public function getDefaultAction(){
	}

	/**
	 * Adds a role to the ACL list. Second parameter lets to inherit access data from other existing role
	 *
	 * Example:
	 * <code>$acl->addRole(new Phalcon_Acl_Role('administrator'), 'consultor');</code>
	 * <code>$acl->addRole('administrator', 'consultor');</code>
	 *
	 * @param  string $roleObject
	 * @param  array $accessInherits
	 * @return boolean
	 */
	public function addRole($roleObject, $accessInherits=NULL){
	}

	/**
	 * Do a role inherit from another existing role
	 *
	 * @param string $roleName
	 * @param string $roleToInherit
	 */
	public function addInherit($roleName, $roleToInherit){
	}

	/**
	 * Check whether role exist in the roles list
	 *
	 * @param  string $roleName
	 * @return boolean
	 */
	public function isRole($roleName){
	}

	/**
	 * Check whether resource exist in the resources list
	 *
	 * @param  string $resourceName
	 * @return boolean
	 */
	public function isResource($resourceName){
	}

	/**
	 * Adds a resource to the ACL list
	 *
	 * Access names can be a particular action, by example
	 * search, update, delete, etc or a list of them
	 *
	 * Example:
	 * <code>
	 * //Add a resource to the the list allowing access to an action
	 * $acl->addResource(new Phalcon_Acl_Resource('customers'), 'search');
	 * $acl->addResource('customers', 'search');
	 *
	 * //Add a resource  with an access list
	 * $acl->addResource(new Phalcon_Acl_Resource('customers'), array('create', 'search'));
	 * $acl->addResource('customers', array('create', 'search'));
	 * </code>
	 *
	 * @param   Phalcon_Acl_Resource $resource
	 * @return  boolean
	 */
	public function addResource($resource, $accessList=array ()){
	}

	/**
	 * Adds access to resources
	 *
	 * @param string $resourceName
	 * @param mixed $accessList
	 */
	public function addResourceAccess($resourceName, $accessList){
	}

	/**
	 * Removes an access from a resource
	 *
	 * @param string $resourceName
	 * @param mixed $accessList
	 */
	public function dropResourceAccess($resourceName, $accessList){
	}

	
	protected function _allowOrDeny($roleName, $resourceName, $access, $action){
	}

	/**
	 * Allow access to a role on a resource
	 *
	 * You can use '*' as wildcard
	 *
	 * Ej:
	 * <code>
	 * //Allow access to guests to search on customers
	 * $acl->allow('guests', 'customers', 'search');
	 *
	 * //Allow access to guests to search or create on customers
	 * $acl->allow('guests', 'customers', array('search', 'create'));
	 *
	 * //Allow access to any role to browse on products
	 * $acl->allow('*', 'products', 'browse');
	 *
	 * //Allow access to any role to browse on any resource
	 * $acl->allow('*', '*', 'browse');
	 * </code>
	 *
	 * @param string $roleName
	 * @param string $resourceName
	 * @param mixed $access
	 */
	public function allow($roleName, $resourceName, $access){
	}

	/**
	 * Deny access to a role on a resource
	 *
	 * You can use '*' as wildcard
	 *
	 * Ej:
	 * <code>
	 * //Deny access to guests to search on customers
	 * $acl->deny('guests', 'customers', 'search');
	 *
	 * //Deny access to guests to search or create on customers
	 * $acl->deny('guests', 'customers', array('search', 'create'));
	 *
	 * //Deny access to any role to browse on products
	 * $acl->deny('*', 'products', 'browse');
	 *
	 * //Deny access to any role to browse on any resource
	 * $acl->deny('*', '*', 'browse');
	 * </code>
	 *
	 * @param string $roleName
	 * @param string $resourceName
	 * @param mixed $access
	 * @return boolean
	 */
	public function deny($roleName, $resourceName, $access){
	}

	/**
	 * Check whether a role is allowed to access an action from a resource
	 *
	 * <code>
	 * //Does andres have access to the customers resource to create?
	 * $acl->isAllowed('andres', 'Products', 'create');
	 *
	 * //Do guests have access to any resource to edit?
	 * $acl->isAllowed('guests', '*', 'edit');
	 * </code>
	 *
	 * @param  string $role
	 * @param  string $resource
	 * @param  mixed $accessList
	 * @return boolean
	 */
	public function isAllowed($role, $resource, $access){
	}

	/**
	 * Rebuild the list of access from the inherit lists
	 *
	 */
	protected function _rebuildAccessList(){
	}

}

/**
 * Phalcon_Cache_Exception
 *
 * Exceptions thrown in Phalcon_Cache will use this class
 *
 */
class Phalcon_Cache_Exception extends Php_Exception
{
	
	final private function __clone(){
	}

	
	public function __construct($message, $code, $previous){
	}

	
	final public function getMessage(){
	}

	
	final public function getCode(){
	}

	
	final public function getFile(){
	}

	
	final public function getLine(){
	}

	
	final public function getTrace(){
	}

	
	final public function getPrevious(){
	}

	
	final public function getTraceAsString(){
	}

	
	public function __toString(){
	}

}

/**
 * Phalcon_Cache_Backend_Apc
 *
 * Allows to cache output fragments using a memcache backend
 *
 *<code>
 *
 * //Cache data for 2 days
 *$frontendOptions = array(
 *	'lifetime' => 172800
 *);
 *
 *$cache = Phalcon_Cache::factory('Data', 'Apc', $frontendOptions, array());
 *
 * //Cache arbitrary data
 *$cache->store('my-data', array(1, 2, 3, 4, 5));
 *
 * //Get data
 *$data = $cache->get('my-data');
 *
 *</code>
 */
class Phalcon_Cache_Backend_Apc
{
	/**
	 * Phalcon_Backend_Adapter_Apc constructor
	 *
	 * @param	mixed $frontendObject
	 * @param	array $backendOptions
	 */
	public function __construct($frontendObject, $backendOptions){
	}

	/**
	 * Starts a cache. The $keyname allow to identify the created fragment
	 *
	 * @param 	string $keyName
	 * @return  mixed
	 */
	public function start($keyName){
	}

	/**
	 * Returns a cached content
	 *
	 * @param 	string $keyName
	 * @return  mixed
	 */
	public function get($keyName){
	}

	/**
	 * Stores cached content into the file backend
	 *
	 * @param string $keyName
	 * @param string $content
	 * @param boolean $stopBuffer
	 */
	public function save($keyName=NULL, $content=NULL, $stopBuffer=true){
	}

	/**
	 * Deletes a value from the cache by its key
	 *
	 * @return boolean
	 */
	public function delete($keyName){
	}

	/**
	 * Returns front-end instance adapter related to the back-end
	 *
	 * @return mixed
	 */
	public function getFrontend(){
	}

}

/**
 * Phalcon_Cache_Backend_File
 *
 * Allows to cache output fragments using a file backend
 *
 *<code>
 * //Cache the file for 2 days
 *$frontendOptions = array(
 *	'lifetime' => 172800
 *);
 *
 * //Set the cache directory
 *$backendOptions = array(
 *	'cacheDir' => '../app/cache/'
 *);
 *
 *$cache = Phalcon_Cache::factory('Output', 'File', $frontendOptions, $backendOptions);
 *
 *$content = $cache->start('my-cache');
 *if($content===null){
 *  echo '<h1>', time(), '</h1>';
 *  $cache->save();
 *} else {
 *	echo $content;
 *}
 *</code>
 */
class Phalcon_Cache_Backend_File
{
	/**
	 * Phalcon_Backend_Adapter_File constructor
	 *
	 * @param	mixed $frontendObject
	 * @param	array $backendOptions
	 */
	public function __construct($frontendObject, $backendOptions){
	}

	/**
	 * Starts a cache. The $keyname allow to identify the created fragment
	 *
	 * @param 	string $keyName
	 * @return  mixed
	 */
	public function start($keyName){
	}

	/**
	 * Returns a cached content
	 *
	 * @param 	string $keyName
	 * @return  mixed
	 */
	public function get($keyName){
	}

	/**
	 * Stores cached content into the file backend
	 *
	 * @param string $keyName
	 * @param string $content
	 * @param boolean $stopBuffer
	 */
	public function save($keyName=NULL, $content=NULL, $stopBuffer=true){
	}

	/**
	 * Deletes a value from the cache by its key
	 *
	 * @return boolean
	 */
	public function delete($keyName){
	}

	/**
	 * Returns front-end instance adapter related to the back-end
	 *
	 * @return mixed
	 */
	public function getFrontend(){
	}

}

/**
 * Phalcon_Cache_Backend_Memcache
 *
 * Allows to cache output fragments using a memcache backend
 *
 *<code>
 *
 * //Cache data for 2 days
 *$frontendOptions = array(
 *	'lifetime' => 172800
 *);
 *
 * //Set memcached server connection settings
 *$backendOptions = array(
 *	'host' => 'localhost',
 *  'port' => 11211
 *);
 *
 *$cache = Phalcon_Cache::factory('Data', 'Memcache', $frontendOptions, $backendOptions);
 *
 * //Cache arbitrary data
 *$cache->store('my-data', array(1, 2, 3, 4, 5));
 *
 * //Get data
 *$data = $cache->get('my-data');
 *
 *</code>
 */
class Phalcon_Cache_Backend_Memcache
{
	/**
	 * Phalcon_Backend_Adapter_Memcache constructor
	 *
	 * @param	mixed $frontendObject
	 * @param	array $backendOptions
	 */
	public function __construct($frontendObject, $backendOptions){
	}

	/**
	 * Create internal connection to memcached
	 */
	protected function _connect(){
	}

	/**
	 * Starts a cache. The $keyname allow to identify the created fragment
	 *
	 * @param 	string $keyName
	 * @return  mixed
	 */
	public function start($keyName){
	}

	/**
	 * Returns a cached content
	 *
	 * @param 	string $keyName
	 * @return  mixed
	 */
	public function get($keyName){
	}

	/**
	 * Stores cached content into the file backend
	 *
	 * @param string $keyName
	 * @param string $content
	 * @param boolean $stopBuffer
	 */
	public function save($keyName=NULL, $content=NULL, $stopBuffer=true){
	}

	/**
	 * Deletes a value from the cache by its key
	 *
	 * @return boolean
	 */
	public function delete($keyName){
	}

	/**
	 * Returns front-end instance adapter related to the back-end
	 *
	 * @return mixed
	 */
	public function getFrontend(){
	}

	
	public function __destruct(){
	}

}

/**
 * Phalcon_Cache_Frontend_Data
 *
 * Allows to cache native PHP data in a serialized form
 *
 */
class Phalcon_Cache_Frontend_Data
{
	/**
	 * Phalcon_Cache_Frontend_Data constructor
	 *
	 * @param array $frontendOptions
	 */
	public function __construct($frontendOptions){
	}

	/**
	 * Returns cache lifetime
	 *
	 * @return integer
	 */
	public function getLifetime(){
	}

	/**
	 * Check whether if frontend is buffering output
	 */
	public function isBuffering(){
	}

	/**
	 * Starts output frontend. Actually, does nothing
	 */
	public function start(){
	}

	/**
	 * Returns output cached content
	 *
	 * @return string
	 */
	public function getContent(){
	}

	/**
	 * Stops output frontend
	 */
	public function stop(){
	}

	/**
	 * Serializes data before storing it
	 */
	public function beforeStore($data){
	}

	/**
	 * Unserializes data after retrieving it
	 */
	public function afterRetrieve($data){
	}

}

/**
 * Phalcon_Cache_Frontend_None
 *
 * Discards any kind of frontend data input. This frontend does not have expiration time or any other options
 *
 */
class Phalcon_Cache_Frontend_None
{
	/**
	 * Phalcon_Cache_Frontend_None constructor
	 */
	public function __construct($frontendOptions){
	}

	/**
	 * Returns cache lifetime, always one second expiring content
	 */
	public function getLifetime(){
	}

	/**
	 * Check whether if frontend is buffering output, always false
	 */
	public function isBuffering(){
	}

	/**
	 * Starts output frontend
	 */
	public function start(){
	}

	/**
	 * Returns output cached content
	 *
	 * @return string
	 */
	public function getContent(){
	}

	/**
	 * Stops output frontend
	 */
	public function stop(){
	}

	
	public function beforeStore($data){
	}

	/**
	 * Prepares data to be retrieved to user
	 */
	public function afterRetrieve($data){
	}

}

/**
 * Phalcon_Cache_Frontend_Output
 *
 * Allows to cache output fragments captured with ob_* functions
 *
 */
class Phalcon_Cache_Frontend_Output
{
	/**
	 * Phalcon_Cache_Frontend_Output constructor
	 *
	 * @param array $frontendOptions
	 */
	public function __construct($frontendOptions){
	}

	/**
	 * Returns cache lifetime
	 *
	 * @return integer
	 */
	public function getLifetime(){
	}

	/**
	 * Check whether if frontend is buffering output
	 */
	public function isBuffering(){
	}

	/**
	 * Starts output frontend
	 */
	public function start(){
	}

	/**
	 * Returns output cached content
	 *
	 * @return string
	 */
	public function getContent(){
	}

	/**
	 * Stops output frontend
	 */
	public function stop(){
	}

	
	public function beforeStore($data){
	}

	/**
	 * Prepares data to be retrieved to user
	 */
	public function afterRetrieve($data){
	}

}

/**
 * Phalcon_Config_Exception
 *
 * Exceptions thrown in Phalcon_Config will use this class
 *
 */
class Phalcon_Config_Exception extends Php_Exception
{
	
	final private function __clone(){
	}

	
	public function __construct($message, $code, $previous){
	}

	
	final public function getMessage(){
	}

	
	final public function getCode(){
	}

	
	final public function getFile(){
	}

	
	final public function getLine(){
	}

	
	final public function getTrace(){
	}

	
	final public function getPrevious(){
	}

	
	final public function getTraceAsString(){
	}

	
	public function __toString(){
	}

}

/**
 * Phalcon_Config_Adapter_Ini
 *
 * Reads ini files and convert it to Phalcon_Config objects.
 *
 * Given the next configuration file:
 *
 * <code> [database]
 *adapter = Mysql
 *host = localhost
 *username = scott
 *password = cheetah
 *name = test_db
 *
 *[phalcon]
 *controllersDir = "../app/controllers/"
 *modelsDir = "../app/models/"
 *viewsDir = "../app/views/"
 *</code>
 *
 * You can read it as follows:
 *
 * <code>
 * $config = new Phalcon_Config_Adapter_Ini("path/config.ini")
 *
 * echo $config->phalcon->controllersDir;
 * echo $config->database->username;
 * </code>
 *
 */
class Phalcon_Config_Adapter_Ini extends Php_Config
{
	/**
	 * Phalcon_Config_Adapter_Ini constructor
	 *
	 * @param string $filePath
	 * @return Phalcon_Config_Adapter_Ini
	 *
	 */
	public function __construct($filePath){
	}

}

/**
 * Phalcon_Controller_Front
 *
 * Phalcon_Controller_Front implements a "Front Controller" pattern used in "Model-View-Controller" (MVC) applications.
 * Its purpose is to initialize the request environment, route the incoming request, and then dispatch
 * any discovered actions; it aggregates any responses and returns them when the process is complete
 *
 *<code>try {
 *
 *  $front = Phalcon_Controller_Front::getInstance();
 *
 *  //Setting directories
 *  $front->setControllersDir("../app/controllers/");
 *  $front->setModelsDir("../app/models/");
 *  $front->setViewsDir("../app/views/");
 *
 *  //Get response
 *  $response = $front->dispatchLoop();
 *
 *  echo $response->send();
 *
 * }
 * catch(Phalcon_Exception $e){
 *  echo "PhalconException: ", $e->getMessage();
 * }
 *</code>
 */
class Phalcon_Controller_Front
{
	/**
	 * Private Phalcon_Controller_Front constructor for singleton
	 */
	private function __construct(){
	}

	/**
	 * Gets Phalcon_Controller_Front singleton instance
	 *
	 * @return Phalcon_Controller_Front
	 */
	public static function getInstance(){
	}

	/**
	 * Modifies multipe general settings using a Phalcon_Config object or a stdClass filled with parameters
	 *
	 * <code>$config = new Phalcon_Config(array(
	 *  "database" => array(
	 *    "adapter" => "Mysql",
	 *    "host" => "localhost",
	 *    "username" => "scott",
	 *    "password" => "cheetah",
	 *    "name" => "test_db"
	 *  ),
	 *  "phalcon" => array(
	 *    "controllersDir" => "../app/controllers/",
	 *    "modelsDir" => "../app/models/",
	 *    "viewsDir" => "../app/views/"
	 *  )
	 * ));
	 * $front->setConfig($config);</code>
	 *
	 * @param stdClass $config
	 */
	public function setConfig($config){
	}

	/**
	 * Sets the database default settings
	 *
	 * @param stdClass $database
	 */
	public function setDatabaseConfig($database){
	}

	/**
	 * Sets controllers directory. Depending of your platform, always add a trailing slash or backslash
	 *
	 * <code> $front->setControllersDir("../app/controllers/"); </code>
	 *
	 * @param string $controllersDir
	 */
	public function setControllersDir($controllersDir){
	}

	/**
	 * Sets models directory. Depending of your platform, always add a trailing slash or backslash
     *
	 * <code> $front->setModelsDir("../app/models/"); </code>
	 *
	 * @param string $modelsDir
	 */
	public function setModelsDir($modelsDir){
	}

	/**
	 * Sets views directory. Depending of your platform, always add a trailing slash or backslash
	 *
	 * <code> $front->setViewsDir("../app/views/"); </code>
	 *
	 * @param string $viewsDir
	 */
	public function setViewsDir($viewsDir){
	}

	/**
	 * Replaces the default router with a predefined object
	 *
	 * <code> $router = new Phalcon_Router_Rewrite();
	 * $router->handle();
	 * $front->setRouter($router);</code>
	 *
	 * @param Phalcon_Router $router
	 */
	public function setRouter($router){
	}

	/**
	 * Return active router
	 *
	 * @return Phalcon_Router
	 */
	public function getRouter(){
	}

	/**
	 * Replaces the default dispatcher with a predefined object
	 *
	 * @param Phalcon_Dispatcher $dispatcher
	 */
	public function setDispatcher($dispatcher){
	}

	/**
	 * Return active Dispatcher
	 *
	 * @return Phalcon_Dispatcher
	 */
	public function getDispatcher(){
	}

	/**
	 * Sets external uri which app is executed
	 *
	 * @param string $baseUri
	 */
	public function setBaseUri($baseUri){
	}

	/**
	 * Gets external uri where app is executed
	 *
	 * @return string
	 */
	public function getBaseUri(){
	}

	/**
	 * Sets local path where app/ directory is located. Depending of your platform, always add a trailing slash or backslash
	 *
	  * @param string $basePath
	 */
	public function setBasePath($basePath){
	}

	/**
	 * Gets local path where app/ directory is located
	 *
	 * @return string
	 */
	public function getBasePath(){
	}

	/**
	 * Overwrites request object default object
	 *
	 * @param Phalcon_Request $response
	 */
	public function setRequest($request){
	}

	/**
	 * Overwrites response object default object
 	 *
	 * @param Phalcon_Response $response
	 */
	public function setResponse($response){
	}

	/**
	 * Overwrites models manager default object
	 *
	 * @param Phalcon_Model_Manager $model
	 */
	public function setModelComponent($model){
	}

	/**
	 * Gets the models manager
	 *
	 * @return Phalcon_Model_Manager
	 */
	public function getModelComponent(){
	}

	/**
	 * Sets view component
	 *
	 * @param Phalcon_View $view
	 */
	public function setViewComponent($view){
	}

	/**
	 * Gets the views part manager
	 *
	 * @return Phalcon_View
	 */
	public function getViewComponent(){
	}

	/**
	 * Executes the dispatch loop
	 *
	 * @return Phalcon_View
	 */
	public function dispatchLoop(){
	}

}

/**
 * Phalcon_Db_Column
 *
 * Allows to define columns to be used on create or alter table operations
 *
 *<code>
 *new Phalcon_Db_Column("id", array(
 * "type" =>  Phalcon_Db_Column::TYPE_INTEGER,
 * "size" => 10,
 * "unsigned" => true,
 * "notNull" => true,
 * "autoIncrement" => true,
 * "first" => true
 *)),
 *</code>
 *
 */
class Phalcon_Db_Column
{
	const TYPE_INTEGER = 0;
	const TYPE_DATE = 1;
	const TYPE_VARCHAR = 2;
	const TYPE_DECIMAL = 3;
	const TYPE_DATETIME = 4;
	const TYPE_CHAR = 5;
	const TYPE_TEXT = 6;
	/**
	 * Phalcon_Db_Column constructor
	 *
	 * @param string $columnName
	 * @param array $definition
	 */
	public function __construct($columnName, $definition){
	}

	/**
	 * Returns schema's table related to column
	 *
	 * @return string
	 */
	public function getSchemaName(){
	}

	/**
	 * Returns column name
	 *
	 * @return string
	 */
	public function getName(){
	}

	/**
	 * Returns column type
	 *
	 * @return int
	 */
	public function getType(){
	}

	/**
	 * Returns column size
	 *
	 * @return int
	 */
	public function getSize(){
	}

	/**
	 * Returns column scale
	 *
	 * @return int
	 */
	public function getScale(){
	}

	/**
	 * Returns true if number column is unsigned
	 *
	 * @return boolean
	 */
	public function isUnsigned(){
	}

	/**
	 * Not null
	 *
	 * @return boolean
	 */
	public function isNotNull(){
	}

	/**
	 * Auto-Increment
	 *
	 * @return boolean
	 */
	public function isAutoIncrement(){
	}

	/**
	 * Check whether column have first position in table
	 *
	 * @return boolean
	 */
	public function isFirst(){
	}

	/**
	 * Check whether field absolute to position in table
	 *
	 * @return string
	 */
	public function getAfterPosition(){
	}

}

/**
 * Phalcon_Db_Exception
 *
 * Exceptions thrown in Phalcon_Db will use this class
 *
 */
class Phalcon_Db_Exception extends Php_Exception
{
	
	final private function __clone(){
	}

	
	public function __construct($message, $code, $previous){
	}

	
	final public function getMessage(){
	}

	
	final public function getCode(){
	}

	
	final public function getFile(){
	}

	
	final public function getLine(){
	}

	
	final public function getTrace(){
	}

	
	final public function getPrevious(){
	}

	
	final public function getTraceAsString(){
	}

	
	public function __toString(){
	}

}

/**
 * Phalcon_Db_Index
 *
 * Allows to define indexes to be used on tables
 *
 */
class Phalcon_Db_Index
{
	/**
	 * Phalcon_Db_Index constructor
	 *
	 * @param string $indexName
	 * @param array $columns
	 */
	public function __construct($indexName, $columns){
	}

	/**
	 * Gets the index name
	 *
	 * @return string
	 */
	public function getName(){
	}

	/**
	 * Gets the columns that comprends the index
	 *
	 * @return array
	 */
	public function getColumns(){
	}

	/**
	 * Restore a Phalcon_Db_Index object from export
	 *
	 * @param array $data
	 * @return Phalcon_Db_Index
	 */
	public static function __set_state($data){
	}

}

/**
 * Phalcon_Db_Pool
 *
 * Manages caching of database connections. With the help of Phalcon_Db_Pool, developers can be sure that no new database
 * connections will made when calling multiple of times Phalcon_Db_Pool::getConnection.
 */
class Phalcon_Db_Pool
{
	/**
	 * Check if a default descriptor has already defined
	 *
	 * @return boolean
	 */
	public static function hasDefaultDescriptor(){
	}

	/**
	 * Sets the default descriptor for database connections.
	 *
	 *<code>$config = array(
	 *  "adapter" => "Mysql",
	 *  "host" => "localhost",
	 *  "username" => "scott",
	 *  "password" => "cheetah",
	 *  "name" => "test_db"
	 *);
     *
	 *Phalcon_Db_Pool::setDefaultDescriptor($config);</code>
	 *
	 * @param array $options
	 * @return boolean
	 */
	public static function setDefaultDescriptor($options){
	}

	/**
	 * Returns a connection builded with the default descriptor parameters
	 *
	 * <code>$connection = Phalcon_Db_Pool::getConnection();</code>
	 *
	 * @param boolean $newConnection
     * @param boolean $renovate
	 * @return Phalcon_Db
	 */
	public static function getConnection($newConnection=false, $renovate=false){
	}

}

/**
 * Phalcon_Db_Profiler
 *
 * Instances of Phalcon_Db can generate execution profiles
 * on SQL statements sent to the relational database. Profiled
 * information includes execution time in miliseconds.
 * This helps you to identify bottlenecks in your applications.
 *
 */
class Phalcon_Db_Profiler
{
	/**
	 * Starts the profile of a SQL sentence
	 *
	 * @param string $sqlStatement
	 */
	public function startProfile($sqlStatement){
	}

	/**
	 * Stops the active profile
	 *
	 * @access public
	 */
	public function stopProfile(){
	}

	/**
     * Returns the total number of SQL statements processed
	 *
	 * @return integer
	 */
	public function getNumberTotalStatements(){
	}

	/**
	 * Returns the total time in seconds spent by the profiles
	 *
	 * @return double
	 */
	public function getTotalElapsedSeconds(){
	}

	/**
	 * Returns all the processed profiles
	 *
	 * @return array
	 */
	public function getProfiles(){
	}

	/**
	 * Resets the profiler, cleaning up all the profiles
	 *
	 */
	public function reset(){
	}

	/**
	 * Returns the last profile executed in the profiler
	 *
	 * @return	Phalcon_Db_Profiler_Item
	 */
	public function getLastProfile(){
	}

}

/**
 * Phalcon_Db_RawValue
 *
 * This class lets to insert/update raw data without quoting or formating.
 *
 *<example>
 * The next example shows how to use the MySQL now() function as a field value.
 * <code>
 *$subscriber = new Subscribers();
 *$subscriber->email = 'andres@phalconphp.com';
 *$subscriber->created_at = new Phalcon_Db_RawValue('now()');
 *$subscriber->save();
 * </code>
 * </example>
 */
class Phalcon_Db_RawValue
{
	/**
	 * Phalcon_Db_RawValue constructor
	 *
	 * @param string $value
	 */
	public function __construct($value){
	}

	/**
	 * Returns internal raw value without quoting or formating
	 *
	 * @return string
	 */
	public function getValue(){
	}

	/**
	 * Magic method __toString returns raw value without quoting or formating
	 */
	public function __toString(){
	}

}

/**
 * Phalcon_Db_Reference
 *
 * Allows to define reference constraints on tables
 *
 *<code>
 *$reference = new Phalcon_Db_Reference("field_fk", array(
 *  'referencedSchema' => "invoicing",
 *  'referencedTable' => "products",
 *  'columns' => array("product_type", "product_code"),
 *  'referencedColumns' => array("type", "code")
 *));
 *</code>
 */
class Phalcon_Db_Reference
{
	/**
	 * Phalcon_Db_Reference constructor
	 *
	 * @param string $indexName
	 * @param array $columns
	 */
	public function __construct($referenceName, $definition){
	}

	/**
	 * Gets the index name
	 *
	 * @return string
	 */
	public function getName(){
	}

	/**
	 * Gets the schema where referenced table is
	 *
	 * @return string
	 */
	public function getSchemaName(){
	}

	/**
	 * Gets the schema where referenced table is
	 *
	 * @return string
	 */
	public function getReferencedSchema(){
	}

	/**
	 * Gets local columns which reference is based
	 *
	 * @return array
	 */
	public function getColumns(){
	}

	/**
	 * Gets the referenced table
	 *
	 * @return string
	 */
	public function getReferencedTable(){
	}

	/**
	 * Gets referenced columns
	 *
	 * @return array
	 */
	public function getReferencedColumns(){
	}

	/**
	 * Restore a Phalcon_Db_Reference object from export
	 *
	 * @param array $data
	 * @return Phalcon_Db_Reference
	 */
	public static function __set_state($data){
	}

}

/**
 * Phalcon_Db_Mysql
 *
 * Phalcon_Db_Mysql is the Phalcon_Db adapter for MySQL database.
 * <code>
 *
 * //Setting all posible parameters
 *$config = new stdClass();
 *$config->host = 'localhost';
 *$config->username = 'machine';
 *$config->password = 'sigma';
 *$config->name = 'swarm';
 *$config->charset = 'utf8';
 *$config->collatio = 'utf8_unicode_ci';
 *$config->compression = true;
 *
 * $connection = Phalcon_Db::factory('Mysql', $config);
 *
 * </code>
 */
class Phalcon_Db_Adapter_Mysql extends Php_Db
{
	const DB_ASSOC = 1;
	const DB_BOTH = 2;
	const DB_NUM = 3;
	/**
	 * Constructor for Phalcon_Db_Adapter_Mysql. This method does not should to be called directly. Use Phalcon_Db::factory instead
	 *
	 * @param stdClass $descriptor
	 * @param boolean $persistent
	 */
	public function __construct($descriptor=NULL){
	}

	/**
	 * This method is automatically called in Phalcon_Db_Mysql constructor.
	 * Call it when you need to restore a database connection
	 *
	 * @param stdClass $descriptor
	 * @param boolean $persistent
	 * @return boolean
	 */
	public function connect($descriptor=NULL){
	}

	/**
	 * Sends SQL statements to the MySQL database server returning success state.
	 * When the SQL sent have returned any row, the result is a PHP resource.
	 *
	 * <code>
	 * //Inserting data
	 * $success = $connection->query("INSERT INTO robots VALUES (1, 'Astro Boy')");
	 *
	 * //Querying data
	 * $resultset = $connection->query("SELECT * FROM robots");</code>
	 *
	 * @param  string $sqlStatement
	 * @return boolean
	 */
	public function query($sqlStatement){
	}

	/**
	 * Closes active connection returning success. Phalcon automatically closes and destroys active connections within Phalcon_Db_Pool
	 *
	 * @return boolean
	 */
	public function close(){
	}

	/**
	 * Returns an array of strings that corresponds to the fetched row, or FALSE if there are no more rows.
	 * This method is affected by the active fetch flag set using Phalcon_Db_Mysql::setFetchMode
	 *
	 * <code>
	 *$connection->setFetchMode(Phalcon_Db::DB_NUM);
	 *$result = $connection->query("SELECT * FROM robots ORDER BY name");
	 *while($robot = $connection->fetchArray($result)){
	 *  print_r($robot);
	 *}
	 * </code>
	 *
	 * @param resource $resultQuery
	 * @return boolean
	 */
	public function fetchArray($resultQuery=NULL){
	}

	/**
	 * Gets number of rows returned by a resulset
	 *
	 * <code>
	 *$result = $connection->query("SELECT * FROM robots ORDER BY name");
	 *echo 'There are ', $connection->numRows($result), ' in resulset';
	 * </code>
	 *
	 * @param resource $resultQuery
	 * @return int
	 */
	public function numRows($resultQuery=NULL){
	}

	/**
	 * Moves internal resulset cursor to another position letting us to fetch a certain row
	 *
	 * <code>
	 *$result = $connection->query("SELECT * FROM robots ORDER BY name");
	 *$connection->dataSeek(2, $result); // Move to third row on result
	 * $row = $connection->fetchArray($result); // Fetch third row
	 * </code>
	 *
	 * @param resource $resultQuery
	 * @return int
	 */
	public function dataSeek($number, $resultQuery=NULL){
	}

	/**
	 * Returns number of affected rows by the last INSERT/UPDATE/DELETE repoted by MySQL
	 *
	 * <code>
	 *$connection->query("DELETE FROM robots");
	 *echo $connection->affectedRows(), ' affected rows';
	 * </code>
	 *
	 * @param resource $resultQuery
	 * @return int
	 */
	public function affectedRows($resultQuery=NULL){
	}

	/**
	 * Changes the fetching mode affecting Phalcon_Db_Mysql::fetchArray
	 *
	 * <code>
	 * //Return array with integer indexes
	 * $connection->setFetchMode(Phalcon_Db::DB_NUM);
	 *
	 * //Return associative array without integer indexes
	 * $connection->setFetchMode(Phalcon_Db::DB_ASSOC);
	 *
	 * //Return associative array together with integer indexes
     * $connection->setFetchMode(Phalcon_Db::DB_BOTH);
	 * </code>
	 *
	 * @param int $fetchMode
	 */
	public function setFetchMode($fetchMode){
	}

	/**
	 * Returns last error message from MySQL
	 *
	 * @param string $errorString
	 * @param resurce $resultQuery
	 * @return string
	 */
	public function error($errorString=NULL, $resultQuery=NULL){
	}

	/**
	 * Returns last error code from MySQL
	 *
	 * @param string $errorString
	 * @param resurce $resultQuery
	 * @return string
	 */
	public function noError($resultQuery=NULL){
	}

	/**
	 * Returns insert id for the auto_increment column inserted in the last SQL statement
	 *
	 * @param string $table
	 * @param string $primaryKey
	 * @param string $sequenceName
	 * @return int
	 */
	public function lastInsertId($table=NULL, $primaryKey=NULL, $sequenceName=NULL){
	}

	/**
	 * Gets a list of columns
	 *
	 * @param	array $columnList
	 * @return	string
	 */
	public function getColumnList($columnList){
	}

	/**
	 * Appends a LIMIT clause to $sqlQuery argument
	 *
	 * <code>$connection->limit("SELECT * FROM robots", 5);</code>
	 *
	 * @param string $errorString
	 * @param int $number
	 * @return string
	 */
	public function limit($sqlQuery, $number){
	}

	/**
	 * Generates SQL checking for the existence of a schema.table
	 *
	 * <code>$connection->tableExists("blog", "posts")</code>
	 *
	 * @param string $tableName
	 * @param string $schemaName
	 * @return string
	 */
	public function tableExists($tableName, $schemaName=NULL){
	}

	/**
	 * Generates SQL checking for the existence of a schema.view
	 *
	 * <code>$connection->viewExists("active_users", "posts")</code>
	 *
	 * @param string $tableName
	 * @param string $schemaName
	 * @return string
	 */
	public function viewExists($viewName, $schemaName=NULL){
	}

	/**
	 * Devuelve un FOR UPDATE valido para un SELECT del RBDM
	 *
	 * @param	string $sqlQuery
	 * @return	string
	 */
	public function forUpdate($sqlQuery){
	}

	/**
	 * Devuelve un SHARED LOCK valido para un SELECT del RBDM
	 *
	 * @param	string $sqlQuery
	 * @return	string
	 */
	public function sharedLock($sqlQuery){
	}

	/**
	 * Creates a table using MySQL SQL
	 *
	 * @param	string $tableName
	 * @param	string $schemaName
	 * @param	array $definition
	 * @return	boolean
	 */
	public function createTable($tableName, $schemaName, $definition){
	}

	/**
	 * Drops a table from a schema/database
	 *
	 * @param	string $tableName
	 * @param   string $schemaName
	 * @param	boolean $ifExists
	 * @return	boolean
	 */
	public function dropTable($tableName, $schemaName, $ifExists=true){
	}

	/**
	 * Adds a column to a table
	 *
	 * @param	string $tableName
	 * @param 	string $schemaName
	 * @param	Phalcon_Db_Column $column
	 * @return	boolean
	 */
	public function addColumn($tableName, $schemaName, $column){
	}

	/**
	 * Modifies a table column based on a definition
	 *
	 * @param	string $tableName
	 * @param	string $schemaName
	 * @param	Phalcon_Db_Column $column
	 * @return 	boolean
	 */
	public function modifyColumn($tableName, $schemaName, $column){
	}

	/**
	 * Drops a column from a table
	 *
	 * @param	string $tableName
	 * @param	string $schemaName
	 * @param	string $columnName
	 * @return 	boolean
	 */
	public function dropColumn($tableName, $schemaName, $columnName){
	}

	/**
	 * Adds an index to a table
	 *
	 * @param	string $tableName
	 * @param	string $schemaName
	 * @param	DbIndex $index
	 * @return 	boolean
	 */
	public function addIndex($tableName, $schemaName, $index){
	}

	/**
	 * Drop an index from a table
	 *
	 * @param	string $tableName
	 * @param	string $schemaName
	 * @param	string $indexName
	 * @return 	boolean
	 */
	public function dropIndex($tableName, $schemaName, $indexName){
	}

	/**
	 * Adds a primary key to a table
	 *
	 * @param	string $tableName
	 * @param	string $schemaName
	 * @param	Phalcon_Db_Index $index
	 * @return 	boolean
	 */
	public function addPrimaryKey($tableName, $schemaName, $index){
	}

	/**
	 * Drops primary key from a table
	 *
	 * @param	string $tableName
	 * @param	string $schemaName
	 * @return 	boolean
	 */
	public function dropPrimaryKey($tableName, $schemaName){
	}

	/**
	 * Adds a foreign key to a table
	 *
	 * @param	string $tableName
	 * @param	string $schemaName
	 * @param	Phalcon_Db_Reference $reference
	 * @return	boolean true
	 */
	public function addForeignKey($tableName, $schemaName, $reference){
	}

	/**
	 * Drops a foreign key from a table
	 *
	 * @param	string $tableName
	 * @param	string $schemaName
	 * @param	string $referenceName
	 * @return	boolean true
	 */
	public function dropForeignKey($tableName, $schemaName, $referenceName){
	}

	/**
	 * Returns the SQL column definition from a column
	 *
	 * @param	Phalcon_Db_Column $column
	 * @return	string
	 */
	public function getColumnDefinition($column){
	}

	/**
	 * Generates SQL describing a table
	 *
	 * <code>print_r($connection->describeTable("posts") ?></code>
	 *
	 * @param string $tableName
	 * @param string $schemaName
	 * @return string
	 */
	public function describeTable($table, $schema=NULL){
	}

	/**
	 * List all tables on a database
	 *
	 * <code> print_r($connection->listTables("blog") ?></code>
	 *
	 * @param string $schemaName
	 * @return array
	 */
	public function listTables($schemaName=NULL){
	}

	/**
	 * Returns a database date formatted
	 *
	 * <code>$format = $connection->getDateUsingFormat("2011-02-01", "YYYY-MM-DD");</code>
	 *
	 * @param string $date
	 * @param string $format
	 * @return string
	 */
	public function getDateUsingFormat($date, $format='YYYY-MM-DD'){
	}

	/**
	 * Lists table indexes
	 *
	 * @param	string $table
	 * @param	string $schema
	 * @return	array
	 */
	public function describeIndexes($table, $schema=NULL){
	}

	/**
	 * Lists table references
	 *
	 * @param	string $table
	 * @param	string $schema
	 * @return	array
	 */
	public function describeReferences($table, $schema=NULL){
	}

	/**
	 * Gets creation options from a table
	 *
	 * @param	string $tableName
	 * @param	string $schemaName
	 * @return	array
	 */
	public function tableOptions($tableName, $schemaName=NULL){
	}

	/**
	 * Sets a logger class to log all SQL operations sent to database server
	 *
	 * @param Phalcon_Logger $logger
	 */
	public function setLogger($logger){
	}

	/**
	 * Returns the active logger
	 *
	 * @return Phalcon_Logger
	 */
	public function getLogger(){
	}

	/**
	 * Sends arbitrary text to a related logger in the instance
	 *
	 * @param string $sqlStatement
	 * @param int $type
	 */
	protected function log($sqlStatement, $type){
	}

	/**
	 * Sets a database profiler to the connection
	 *
	 * @param Phalcon_Db_Profiler $profiler
	 */
	public function setProfiler($profiler){
	}

	/**
	 * Returns the first row in a SQL query result
	 *
	 * <code>
	 * //Getting first robot
	 * $robot = $connection->fecthOne("SELECT * FROM robots");
	 * print_r($robot);
	 * </code>
	 *
	 * @param string $sqlQuery
	 * @return array
	 */
	public function fetchOne($sqlQuery){
	}

	/**
	 * Dumps the complete result of a query into an array
	 *
	 * <code>
	 * //Getting all robots
	 * $robots = $connection->fetchAll("SELECT * FROM robots");
	 * foreach($robots as $robot){
	 *    print_r($robot);
	 * }
	 * </code>
	 *
	 * @param string $sqlQuery
	 * @return array
	 */
	public function fetchAll($sqlQuery){
	}

	/**
	 * Inserts data into a table using custom RBDM SQL syntax
	 *
	 * <code>
	 * //Inserting a new robot
	 * $success = $connection->insert(
	 *     "robots",
	 *     array("Astro Boy", 1952),
	 *     array("name", "year")
	 * );
	 *
	 * //Next SQL sentence is sent to the database system
	 * INSERT INTO `robots` (`name`, `year`) VALUES ("Astro boy", 1952);
	 * </code>
	 *
	 * @param string $tables
	 * @param array $values
	 * @param array $fields
	 * @param boolean $automaticQuotes
	 * @return boolean
	 */
	public function insert($table, $values, $fields=NULL, $automaticQuotes=false){
	}

	/**
	 * Updates data on a table using custom RBDM SQL syntax
	 *
	 * <code>
	 * //Updating existing robot
	 * $success = $connection->update(
	 *     "robots",
	 *     array("name")
	 *     array("New Astro Boy"),
	 *     "id = 101"
	 * );
	 *
	 * //Next SQL sentence is sent to the database system
	 * UPDATE `robots` SET `name` = "Astro boy" WHERE id = 101
	 * </code>
	 *
	 * @param string $tables
	 * @param array $fields
	 * @param array $values
	 * @param string $whereCondition
	 * @param boolean $automaticQuotes
	 * @return boolean
	 */
	public function update($table, $fields, $values, $whereCondition=NULL, $automaticQuotes=false){
	}

	/**
	 * Deletes data from a table using custom RBDM SQL syntax
	 *
	 * <code>
	 * //Deleting existing robot
	 * $success = $connection->delete(
	 *     "robots",
	 *     "id = 101"
	 * );
	 *
	 * //Next SQL sentence is generated
	 * DELETE FROM `robots` WHERE id = 101
	 * </code>
	 *
	 * @param string $tables
	 * @param string $whereCondition
	 * @return boolean
	 */
	public function delete($table, $whereCondition=''){
	}

	/**
     * Starts a transaction in the connection
     *
     * @return boolean
     */
	public function begin(){
	}

	/**
     * Rollbacks the active transaction in the connection
     *
     * @return boolean
     */
	public function rollback(){
	}

	/**
     * Commits the active transaction in the connection
     *
     * @return boolean
     */
	public function commit(){
	}

	/**
	 * Manually sets a "under transaction" state for the connection
	 *
	 * @param boolean $underTransaction
	 */
	protected function setUnderTransaction($underTransaction){
	}

	/**
	 * Checks whether connection is under database transaction
	 *
	 * @return boolean
	 */
	public function isUnderTransaction(){
	}

	/**
	 * Checks whether connection have auto commit
	 *
	 * @return boolean
	 */
	public function getHaveAutoCommit(){
	}

	/**
	 * Returns database name in the internal connection
	 *
	 * @return string
	 */
	public function getDatabaseName(){
	}

	/**
	 * Returns active schema name in the internal connection
	 *
	 * @return string
	 */
	public function getDefaultSchema(){
	}

	/**
	 * Returns the username which has connected to the database
	 *
	 * @return string
	 */
	public function getUsername(){
	}

	/**
	 * Returns the username which has connected to the database
     *
	 * @return string
	 */
	public function getHostName(){
	}

	/**
	 * Gets an active connection unique identifier
	 *
	 * @return string
	 */
	public function getConnectionId($asString=false){
	}

	/**
	 * This method is executed before every SQL statement sent to the database system
	 *
	 * @param string $sqlStatement
	 */
	protected function _beforeQuery($sqlStatement){
	}

	/**
	 * This method is executed after every SQL statement sent to the database system
	 *
	 * @param string $sqlStatement
	 */
	protected function _afterQuery($sqlStatement){
	}

	/**
	 * Instantiates Phalcon_Db adapter using given parameters
	 *
	 * @param string $adapterName
	 * @param stdClass $options
	 * @return Phalcon_Db
	 */
	public static function factory($adapterName, $options){
	}

}

/**
 * Phalcon_Db_Dialect_Mysql
 *
 * Generates database specific SQL for the MySQL RBDM
 */
class Phalcon_Db_Dialect_Mysql
{
	/**
	 * Generates the SQL for a MySQL LIMIT clause
	 *
	 * @param string $errorString
	 * @param int $number
	 * @return string
	 */
	public static function limit($sqlQuery, $number){
	}

	/**
	 * Gets a list of columns
	 *
	 * @param	array $columnList
	 * @return	string
	 */
	public static function getColumnList($columnList){
	}

	/**
	 * Gets the column name in MySQL
	 *
	 * @param Phalcon_Db_Column $column
	 */
	public static function getColumnDefinition($column){
	}

	/**
	 * Generates SQL to add a column to a table
	 *
	 * @param	string $tableName
	 * @param	string $schemaName
	 * @param	Phalcon_Db_Column $column
	 * @return	string
	 */
	public static function addColumn($tableName, $schemaName, $column){
	}

	/**
	 * Generates SQL to modify a column in a table
	 *
	 * @param	string $tableName
	 * @param	string $schemaName
	 * @param	Phalcon_Db_Column $column
	 * @return	string
	 */
	public static function modifyColumn($tableName, $schemaName, $column){
	}

	/**
	 * Generates SQL to delete a column from a table
	 *
	 * @param	string $tableName
	 * @param	string $schemaName
	 * @param	string $column
	 * @return 	string
	 */
	public static function dropColumn($tableName, $schemaName, $columnName){
	}

	/**
	 * Generates SQL to add an index to a table
	 *
	 * @param	string $tableName
	 * @param	string $schemaName
	 * @param	Phalcon_Db_Index $index
	 * @return	string
	 */
	public static function addIndex($tableName, $schemaName, $index){
	}

	/**
 	 * Generates SQL to delete an index from a table
	 *
	 * @param	string $tableName
	 * @param	string $schemaName
	 * @param	string $indexName
	 * @return	string
	 */
	public static function dropIndex($tableName, $schemaName, $indexName){
	}

	/**
	 * Generates SQL to add the primary key to a table
	 *
	 * @param	string $tableName
	 * @param	string $schemaName
	 * @param	Phalcon_Db_Index $index
	 * @return	string
	 */
	public static function addPrimaryKey($tableName, $schemaName, $index){
	}

	/**
	 * Generates SQL to delete primary key from a table
	 *
	 * @param	string $tableName
	 * @param	string $schemaName
	 * @return	string
	 */
	public static function dropPrimaryKey($tableName, $schemaName){
	}

	/**
	 * Generates SQL to add an index to a table
	 *
	 * @param	string $tableName
	 * @param	string $schemaName
	 * @param	Phalcon_Db_Reference $reference
	 * @return	string
	 */
	public static function addForeignKey($tableName, $schemaName, $reference){
	}

	/**
	 * Generates SQL to delete a foreign key from a table
	 *
	 * @param	string $tableName
	 * @param	string $schemaName
	 * @param	string $referenceName
	 * @return	string
	 */
	public static function dropForeignKey($tableName, $schemaName, $referenceName){
	}

	
	protected static function _getTableOptions($definition){
	}

	/**
	 * Generates SQL to create a table in MySQL
	 *
	 * @param 	string $tableName
	 * @param	string $schemaName
	 * @param	array $definition
	 * @return 	string
	 */
	public static function createTable($tableName, $schemaName, $definition){
	}

	/**
	 * Generates SQL to drop a table
	 *
	 * @param  string $tableName
	 * @param  string $schemaName
	 * @param  boolean $ifExists
	 * @return boolean
	 */
	public function dropTable($tableName, $schemaName, $ifExists=true){
	}

	/**
	 * Generates SQL checking for the existence of a schema.table
	 *
	 * <code>echo Phalcon_Db_Dialect_Mysql::tableExists("posts", "blog")</code>
	 * <code>echo Phalcon_Db_Dialect_Mysql::tableExists("posts")</code>
	 *
	 * @param string $tableName
	 * @param string $schemaName
	 * @return string
	 */
	public static function tableExists($tableName, $schemaName=NULL){
	}

	/**
	 * Generates SQL describing a table
	 *
	 * <code>print_r(Phalcon_Db_Dialect_Mysql::describeTable("posts") ?></code>
	 *
	 * @param string $tableName
	 * @param string $schemaName
	 * @return string
	 */
	public static function describeTable($table, $schema=NULL){
	}

	/**
	 * List all tables on database
	 *
	 * <code>print_r(Phalcon_Db_Dialect_Mysql::listTables("blog") ?></code>
	 *
	 * @param       string $schemaName
	 * @return      array
	 */
	public static function listTables($schemaName=NULL){
	}

	/**
	 * Generates SQL to query indexes on a table
	 *
	 * @param	string $table
	 * @param	string $schema
	 * @return	string
	 */
	public static function describeIndexes($table, $schema=NULL){
	}

	/**
	 * Generates SQL to query foreign keys on a table
	 *
	 * @param	string $table
	 * @param	string $schema
	 * @return	string
	 */
	public static function describeReferences($table, $schema=NULL){
	}

	/**
	 * Generates the SQL to describe the table creation options
	 *
	 * @param	string $table
	 * @param	string $schema
	 * @return	string
	 */
	public static function tableOptions($table, $schema=NULL){
	}

}

/**
 * Phalcon_Db_Profiler_Item
 *
 * This class identifies each profile in a Phalcon_Db_Profiler
 *
 */
class Phalcon_Db_Profiler_Item
{
	/**
	 * Sets the SQL statement related to the profile
	 *
	 * @param string $sqlStatement
	 */
	public function setSQLStatement($sqlStatement){
	}

	/**
	 * Returns the SQL statement related to the profile
	 *
	 * @return string
	 */
	public function getSQLStatement(){
	}

	/**
	 * Sets the timestamp on when the profile started
	 *
	 * @param int $initialTime
	 */
	public function setInitialTime($initialTime){
	}

	/**
	 * Sets the timestamp on when the profile ended
	 *
	 * @param int $finalTime
	 */
	public function setFinalTime($finalTime){
	}

	/**
	 * Returns the initial time in milseconds on when the profile started
	 *
	 * @return double
	 */
	public function getInitialTime(){
	}

	/**
	 * Returns the initial time in milseconds on when the profile ended
	 *
	 * @return double
	 */
	public function getFinalTime(){
	}

	/**
	 * Returns the total time in seconds spent by the profile
	 *
	 * @return double
	 */
	public function getTotalElapsedSeconds(){
	}

}

/**
 * Phalcon_Dispatcher_Exception
 *
 * Exceptions thrown in Phalcon_Dispatcher will use this class
 *
 */
class Phalcon_Dispatcher_Exception extends Php_Exception
{
	
	final private function __clone(){
	}

	
	public function __construct($message, $code, $previous){
	}

	
	final public function getMessage(){
	}

	
	final public function getCode(){
	}

	
	final public function getFile(){
	}

	
	final public function getLine(){
	}

	
	final public function getTrace(){
	}

	
	final public function getPrevious(){
	}

	
	final public function getTraceAsString(){
	}

	
	public function __toString(){
	}

}

/**
 * Phalcon_Logger_Exception
 *
 * Exceptions thrown in Phalcon_Logger will use this class
 *
 */
class Phalcon_Logger_Exception extends Php_Exception
{
	/**
	 * Phalcon_Logger_Exception constructor
	 *
	 * @param string $message
	 */
	public function __construct($message){
	}

	
	final private function __clone(){
	}

	
	final public function getMessage(){
	}

	
	final public function getCode(){
	}

	
	final public function getFile(){
	}

	
	final public function getLine(){
	}

	
	final public function getTrace(){
	}

	
	final public function getPrevious(){
	}

	
	final public function getTraceAsString(){
	}

	
	public function __toString(){
	}

}

/**
 * Phalcon_Logger_Item
 *
 * Represents each item in a logger transaction
 *
 */
class Phalcon_Logger_Item
{
	/**
	 * Phalcon_Logger_Item contructor
	 *
	 * @param string $message
	 * @param integer $type
	 * @param integer $time
	 */
	public function __construct($message, $type, $time=0){
	}

	/**
	 * Returns the message
	 *
	 * @return string
	 */
	public function getMessage(){
	}

	/**
	 * Returns the log type
	 *
	 * @return integer
	 */
	public function getType(){
	}

	/**
	 * Returns log timestamp
	 *
	 * @return integer
	 */
	public function getTime(){
	}

}

/**
 * Phalcon_Logger_Adapter_File
 *
 * Adapter to store logs in plain text files
 *
 */
class Phalcon_Logger_Adapter_File
{
	/**
	 * Phalcon_Logger_Adapter_File constructor
	 *
	 * @param string $name
	 * @param array $options
	 */
	public function __construct($name, $options=array ()){
	}

	/**
	 * Set the log format
	 *
	 * @param string $format
	 */
	public function setFormat($format){
	}

	/**
	 * Returns the log format
	 *
	 * @param string $format
	 */
	public function getFormat($format){
	}

	/**
	 * Returns the string meaning of a logger constant
	 *
	 * @param  integer $type
	 * @return string
	 */
	public function getTypeString($type){
	}

	/**
	 * Applies the internal format to the message
	 *
	 * @param  string $message
	 * @return string
	 */
	protected function _applyFormat($message, $type, $time=0){
	}

	/**
	 * Sets the internal date format
	 *
	 * @param string $date
	 */
	public function setDateFormat($date){
	}

	/**
	 * Returns the internal date format
	 *
	 * @return string
	 */
	public function getDateFormat(){
	}

	/**
	 * Sends/Writes messages to the file log
	 *
	 * @param string $message
	 * @param int $type
	 */
	public function log($message, $type){
	}

	/**
 	 * Starts a transaccion
 	 *
 	 */
	public function begin(){
	}

	/**
 	 * Commits the internal transaction
 	 *
 	 */
	public function commit(){
	}

	/**
 	 * Rollbacks the internal transaction
 	 *
 	 */
	public function rollback(){
	}

	/**
 	 * Closes the logger
 	 *
 	 * @return boolean
 	 */
	public function close(){
	}

	/**
	 * Opens the internal file handler on unserialization
	 *
	 */
	public function __wakeup(){
	}

}

/**
 * Phalcon_Model_Base
 *
 * <p>Phalcon_Model connects business objects and database tables to create
 * a persistable domain model where logic and data are presented in one wrapping.
 * It‘s an implementation of the object- relational mapping (ORM).</p>
 *
 * <p>A model represents the information (data) of the application and the rules to manipulate that data.
 * Models are primarily used for managing the rules of interaction with a corresponding database table.
 * In most cases, each table in your database will correspond to one model in your application.
 * The bulk of your application’s business logic will be concentrated in the models.</p>
 *
 * <p>Phalcon_Model is the first ORM written in C-language for PHP, giving to developers high performance
 * when interact with databases while is also easy to use.</p>
 *
 * <code>
 * $manager = new Phalcon_Model_Manager();
 *$manager->setModelsDir('app/models/');
 *
 *$robot = new Robots();
 *$robot->type = 'mechanical'
 *$robot->name = 'Astro Boy';
 *$robot->year = 1952;
 *if ($robot->save() == false) {
 *  echo "Umh, We can store robots: ";
 *  foreach ($robot->getMessages() as $message) {
 *    echo $message;
 *  }
 *} else {
 *  echo "Great, a new robot was saved successfully!";
 *}
 * </code>
 *
 */
abstract class Phalcon_Model_Base
{
	const OP_CREATE = 1;
	const OP_UPDATE = 2;
	const OP_DELETE = 3;
	/**
	 * Phalcon_Model_Base constructor
	 *
	 * @param Phalcon_Model_Manager $manager
	 */
	final public function __construct($manager=NULL){
	}

	/**
	 * Overwrites default model manager
	 *
	 * @param Phalcon_Model_Manager $manager
	 */
	public static function setManager($manager){
	}

	/**
	 * Returns internal models manager
	 *
	 * @return Phalcon_Model_Manager
	 */
	public static function getManager(){
	}

	/**
	 * Internal method to create a connection. Automatically dumps mapped table meta-data
	 *
	 */
	protected function _connect(){
	}

	/**
	 * Return an array with the attributes names
	 *
	 * @return array
	 */
	public function getAttributes(){
	}

	/**
	 * Returns an array of attributes that are part of the related table primary key
	 *
	 * @return array
	 */
	public function getPrimaryKeyAttributes(){
	}

	/**
	 * Returns an array of attributes that aren't part of the primary key
	 *
	 * @return array
	 */
	public function getNonPrimaryKeyAttributes(){
	}

	/**
	 * Returns an array of not-nullable attributes
	 *
	 * @return array
	 */
	public function getNotNullAttributes(){
	}

	/**
	 * Returns an array of numeric attributes
	 *
	 * @return array
	 */
	public function getDataTypesNumeric(){
	}

	/**
	 * Returns an array of data-types attributes
	 *
	 * @return array
	 */
	public function getDataTypes(){
	}

	/**
	 * Returns the name of the identity field
	 *
	 * @return string
	 */
	public function getIdentityField(){
	}

	/**
	 * Dumps mapped table meta-data
	 *
	 * @return Phalcon_Model_Base
	 */
	protected function dump(){
	}

	/**
	 * Creates SQL statement which returns many rows
	 *
	 * @param Phalcon_Manager $manager
	 * @param Phalcon_Model_Base $model
	 * @param Phalcon_Db $connection
	 * @param array $params
	 * @return array
	 */
	protected static function _createSQLSelectMulti($manager, $model, $connection, $params){
	}

	/**
	 * Creates SQL statement which returns many rows
	 *
	 * @param Phalcon_Manager $manager
	 * @param Phalcon_Model_Base $model
	 * @param Phalcon_Db $connection
	 * @param array $params
	 * @return array
	 */
	protected static function _createSQLSelectOne($manager, $model, $connection, $select, $params=''){
	}

	/**
	 * Creates a resultset from a SQL statement
	 *
	 * @param Phalcon_Model_Base $model
	 * @param Phalcon_Db $connection
	 * @param array $select
	 * @param resource $resultResource
	 * @return Phalcon_Model_Resultset
	 */
	protected static function _createResultset($model, $connection, $select, $resultResource){
	}

	/**
	 * Sets a transaction related to the Model instance
	 *
	 *<code>
	 *try {
     *
	 *  $transaction = Phalcon_Transaction_Manager::get();
	 *
	 *  $robot = new Robots();
	 *  $robot->setTransaction($transaction);
	 *  $robot->name = 'WALL·E';
	 *  $robot->created_at = date('Y-m-d');
	 *  if($robot->save()==false){
	 *    $transaction->rollback("Can't save robot");
	 *  }
	 *
	 *  $robotPart = new RobotParts();
	 *  $robotPart->setTransaction($transaction);
	 *  $robotPart->type = 'head';
	 *  if($robotPart->save()==false){
	 *    $transaction->rollback("Can't save robot part");
	 *  }
	 *
	 *  $transaction->commit();
	 *
	 *}
	 *catch(Phalcon_Transaction_Failed $e){
	 *  echo 'Failed, reason: ', $e->getMessage();
	 *}
	 *
	 *</code>
	 *
	 * @param Phalcon_Transaction $transaction
	 */
	public function setTransaction($transaction){
	}

	/**
	 * Checks wheter model is mapped to a database view
	 *
	 * @return boolean
	 */
	public function isView(){
	}

	/**
	 * Sets table name which model should be mapped
	 *
	 * @param string $source
	 */
	protected function setSource($source){
	}

	/**
	 * Returns table name mapped in the model
	 *
	 * @return string
	 */
	public function getSource(){
	}

	/**
	 * Sets schema name where table mapped is located
	 *
	 * @param string $schema
	 */
	protected function setSchema($schema){
	}

	/**
	 * Returns schema name where table mapped is located
	 *
	 * @return string
	 */
	public function getSchema(){
	}

	/**
	 * Overwrites internal Phalcon_Db connection
	 *
	 * @param Phalcon_Db $connection
	 */
	public function setConnection($connection){
	}

	/**
	 * Gets internal Phalcon_Db connection
	 *
	 * @return Phalcon_Db
	 */
	public function getConnection(){
	}

	/**
	 * Assigns values to a model from an array returning a new model
	 *
	 *<code>
	 *$robot = Phalcon_Model_Base::dumpResult(new Robots(), array(
	 *  'type' => 'mechanical',
	 *  'name' => 'Astro Boy',
	 *  'year' => 1952
	 *));
	 *</code>
	 *
	 * @param array $result
	 * @param Phalcon_Model_Base $base
	 * @return Phalcon_Model_Base $result
	 */
	public static function dumpResult($base, $result){
	}

	/**
	 * Allows to query a set of records that match the specified conditions
	 *
	 * <code>
	 *
	 * //How many robots are there?
	 * $robots = Robots::find();
	 * echo "There are ", count($robots);
	 *
     * //How many mechanical robots are there?
	 * $robots = Robots::find("type='mechanical'");
	 * echo "There are ", count($robots);
     *
     * //Get and print virtual robots ordered by name
 	 * $robots = Robots::find(array("type='virtual'", "order" => "name"));
	 * foreach($robots as $robot){
	 *	   echo $robot->name, "\n";
	 * }
	 *
 	 * //Get first 100 virtual robots ordered by name
 	 * $robots = Robots::find(array("type='virtual'", "order" => "name", "limit" => 100));
	 * foreach($robots as $robot){
	 *	   echo $robot->name, "\n";
	 * }
	 * </code>
	 *
	 * @param 	array $parameters
	 * @return  Phalcon_Model_Resultset
	 */
	public static function find($parameters=NULL){
	}

	/**
	 * Allows to query the first record that match the specified conditions
	 *
	 * <code>
	 *
	 * //What's the first robot in robots table?
	 * $robot = Robots::findFirst();
	 * echo "The robot name is ", $robot->name;
	 *
     * //What's the first mechanical robot in robots table?
	 * $robot = Robots::findFirst("type='mechanical'");
	 * echo "The first mechanical robot name is ", $robot->name;
     *
     * //Get first virtual robot ordered by name
 	 * $robot = Robots::findFirst(array("type='virtual'", "order" => "name"));
	 * echo "The first virtual robot name is ", $robot->name;
	 *
	 * </code>
	 *
	 * @param array $parameters
	 * @return Phalcon_Model_Base
	 */
	public static function findFirst($parameters=NULL){
	}

	
	protected function _exists(){
	}

	
	protected static function _prepareGroupResult($function, $alias, $parameters){
	}

	
	protected static function _getGroupResult($connection, $params, $selectStatement, $alias){
	}

	/**
	 * Allows to count how many records match the specified conditions
	 *
	 * <code>
	 *
	 * //How many robots are there?
	 * $number = Robots::count();
	 * echo "There are ", $number;
	 *
     * //How many mechanical robots are there?
	 * $number = Robots::count("type='mechanical'");
	 * echo "There are ", $number, " mechanical robots";
     *
	 * </code>
	 *
	 * @param array $params
	 * @return int
	 */
	public static function count($parameters=NULL){
	}

	/**
	 * Allows to a calculate a summatory on a column that match the specified conditions
	 *
	 * <code>
	 *
	 * //How much are all robots?
	 * $sum = Robots::sum(array('column' => 'price'));
	 * echo "The total price of robots is ", $sum;
	 *
     * //How much are mechanical robots?
	 * $sum = Robots::sum(array("type='mechanical'", 'column' => 'price'));
	 * echo "The total price of mechanical robots is  ", $sum;
     *
	 * </code>
	 *
	 * @param array $params
	 * @return double
	 */
	public static function sum($parameters=NULL){
	}

	/**
	 * Allows to get the maximum value of a column that match the specified conditions
	 *
	 * <code>
	 *
	 * //What is the maximum robot id?
	 * $id = Robots::maximum(array('column' => 'id'));
	 * echo "The maximum robot id is: ", $id;
	 *
     * //What is the maximum id of mechanical robots?
	 * $sum = Robots::maximum(array("type='mechanical'", 'column' => 'id'));
	 * echo "The maximum robot id of mechanical robots is ", $id;
     *
	 * </code>
	 *
	 * @param array $params
	 * @return mixed
	 */
	public static function maximum($parameters=NULL){
	}

	/**
	 * Allows to get the minimum value of a column that match the specified conditions
	 *
	 * <code>
	 *
	 * //What is the minimum robot id?
	 * $id = Robots::minimum(array('column' => 'id'));
	 * echo "The minimum robot id is: ", $id;
	 *
     * //What is the minimum id of mechanical robots?
	 * $sum = Robots::minimum(array("type='mechanical'", 'column' => 'id'));
	 * echo "The minimum robot id of mechanical robots is ", $id;
     *
	 * </code>
	 *
	 * @param array $params
	 * @return mixed
	 */
	public static function minimum($parameters=NULL){
	}

	/**
	 * Allows to calculate the average value on a column matching the specified conditions
	 *
	 * <code>
	 *
	 * //What's the average price of robots?
	 * $average = Robots::average(array('column' => 'price'));
	 * echo "The average price is ", $average;
	 *
     * //What's the average price of mechanical robots?
	 * $average = Robots::average(array("type='mechanical'", 'column' => 'price'));
	 * echo "The average price of mechanical robots is ", $average;
     *
	 * </code>
	 *
	 * @param array $params
	 * @return double
	 */
	public static function average($parameters=NULL){
	}

	
	protected function _callEvent($eventName){
	}

	
	protected function _cancelOperation(){
	}

	/**
	 * Appends a customized message on the validation process
	 *
	 * <code>
	 * class Robots extens Phalcon_Model_Base {
	 *
	 *   function beforeSave(){
	 *     if(this->name=='Peter'){
	 *        $message = new Phalcon_Model_Message("Sorry, but a robot cannot be named Peter");
	 *        $this->appendMessage($message);
	 *     }
	 *   }
	 * }
	 * </code>
	 *
	 * @param Phalcon_Model_Message $message
	 */
	public function appendMessage($message){
	}

	/**
	 * Executes validators on every validation call
	 *
	 *<code>
     *class Subscriptors extends Phalcon_Model_Base {
     *
     *	function validation(){
     * 		$this->validate('ExclusionIn', array(
     *			'field' => 'status',
     *			'domain' => array('A', 'I')
     *		));
     *		if($this->validationHasFailed()==true){
     *			return false;
     *		}
     *	}
     *
     *}
     *</code>
	 *
	 * @param string $validatorClass
	 * @param array $options
	 */
	protected function validate($validatorClass, $options){
	}

	/**
	 * Check whether validation process has generated any messages
	 *
	 *<code>
     *class Subscriptors extends Phalcon_Model_Base {
     *
     *	function validation(){
     * 		$this->validate('ExclusionIn', array(
     *			'field' => 'status',
     *			'domain' => array('A', 'I')
     *		));
     *		if($this->validationHasFailed()==true){
     *			return false;
     *		}
     *	}
     *
     *}
     *</code>
	 *
	 * @return boolean
	 */
	public function validationHasFailed(){
	}

	/**
	 * Returns all the validation messages
	 *
	 * <code>
	 *$robot = new Robots();
	 *$robot->type = 'mechanical';
	 *$robot->name = 'Astro Boy';
	 *$robot->year = 1952;
	 *if ($robot->save() == false) {
	 *  echo "Umh, We can't store robots right now ";
	 *  foreach ($robot->getMessages() as $message) {
	 *    echo $message;
	 *  }
	 *} else {
	 *  echo "Great, a new robot was saved successfully!";
	 *}
	 * </code>
	 *
	 * @return array
	 */
	public function getMessages(){
	}

	
	protected function _checkForeignKeys(){
	}

	
	protected function _checkForeignKeysReverse(){
	}

	
	protected function _preSave($disableEvents, $exists, $identityField){
	}

	
	protected function _postSave($disableEvents, $success, $exists){
	}

	
	protected function _doLowInsert($connection, $table, $dataType, $dataTypeNumeric, $identityField){
	}

	
	protected function _doLowUpdate($connection, $table, $dataType, $dataTypeNumeric){
	}

	/**
	 * Inserts or updates a model instance. Returns true on success or else false .
	 *
	 * <code>
	 * //Creating a new robot
	 *$robot = new Robots();
	 *$robot->type = 'mechanical'
	 *$robot->name = 'Astro Boy';
	 *$robot->year = 1952;
	 *$robot->save();
	 *
	 * //Updating a robot name
	 *$robot = Robots::findFirst("id=100");
	 *$robot->name = "Biomass";
	 *$robot->save();
	 * </code>
	 *
	 * @return boolean
	 */
	public function save(){
	}

	/**
	 * Deletes a model instance. Returns true on success or else false .
	 *
	 * <code>
	 *$robot = Robots::findFirst("id=100");
	 *$robot->delete();
	 *
	 *foreach(Robots::find("type = 'mechanical'") as $robot){
     *   $robot->delete();
	 *}
	 * </code>
	 *
	 * @return boolean
	 */
	public function delete(){
	}

	/**
	 * Reads an attribute value by its name
	 *
	 * <code> echo $robot->readAttribute('name'); ?></code>
	 *
	 * @param string $attribute
	 * @return mixed
	 */
	public function readAttribute($attribute){
	}

	/**
	 * Writes an attribute value by its name
	 *
	 * <code>$robot->writeAttribute('name', 'Rosey'); ?></code>
	 *
	 * @param string $attribute
	 * @param mixed $value
	 */
	public function writeAttribute($attribute, $value){
	}

	/**
	 * Setup a 1-1 relation between two models
	 *
	 *<code>
	 *
	 *
     *class Robots extends Phalcon_Model_Base {
     *
	 *   function initialize(){
     *       $this->hasOne('id', 'RobotsDescription', 'robots_id');
	 *   }
	 *
     *}
     *</code>
	 *
	 * @param	mixed $fields
	 * @param	string $referenceModel
	 * @param	mixed $referencedFields
	 * @param   array $options
	 */
	protected function hasOne($fields, $referenceModel, $referencedFields, $options){
	}

	/**
	 * Setup a relation reverse 1-1  between two models
	 *
	 *<code>
	 *
	 *
     *class RobotsParts extends Phalcon_Model_Base {
     *
	 *   function initialize(){
     *       $this->belongsTo('robots_id', 'Robots', 'id');
	 *   }
	 *
     *}
     *</code>
	 *
	 * @param	mixed $fields
	 * @param	string $referenceModel
	 * @param	mixed $referencedFields
	 * @param   array $options
	 */
	protected function belongsTo($fields, $referenceModel, $referencedFields, $options=array ()){
	}

	/**
	 * Setup a relation 1-n between two models
     *
	 *<code>
	 *
	 *
     *class Robots extends Phalcon_Model_Base {
     *
	 *   function initialize(){
     *       $this->hasMany('id', 'RobotsParts', 'robots_id');
	 *   }
	 *
     *}
     *</code>
	 *
	 * @param	mixed $fields
	 * @param	string $referenceModel
	 * @param	mixed $referencedFields
	 * @param   array $options
	 */
	protected function hasMany($fields, $referenceModel, $referencedFields, $options=array ()){
	}

	/**
	 * Handles methods when a method does not exist
	 *
	 * @param	string $method
	 * @param	array $arguments
	 * @return	mixed
	 * @throws	Phalcon_Model_Exception
	 */
	public function __call($method, $arguments=array ()){
	}

}


class Phalcon_Model_Exception extends Php_Exception
{
	
	final private function __clone(){
	}

	
	public function __construct($message, $code, $previous){
	}

	
	final public function getMessage(){
	}

	
	final public function getCode(){
	}

	
	final public function getFile(){
	}

	
	final public function getLine(){
	}

	
	final public function getTrace(){
	}

	
	final public function getPrevious(){
	}

	
	final public function getTraceAsString(){
	}

	
	public function __toString(){
	}

}

/**
 * Phalcon_Model_Manager
 *
 * Manages the creation of models into applications and their relationships.
 * Phacon_Model_Manager helps to control the creation of models across a request execution.
 *
 * <code>
 * $manager = new Phalcon_Model_Manager();
 *$manager->setModelsDir('../apps/models/');
 *$Robots = new Robots($manager);
 * </code>
 */
class Phalcon_Model_Manager
{
	/**
	 * Constructor for Phalcon_Model_Manager
     *
     * @param array $metaDataOptions
	 */
	public function __construct($metaDataOptions=array ()){
	}

	/**
	 * Sets base path. Depending of your platform, always add a trailing slash or backslash
	 */
	public function setBasePath($basePath){
	}

	/**
	 * Overwrites default meta-data manager
	 *
	 * @param Phalcon_Model_Metadata $metadata
	 */
	public function setMetaData($metadata){
	}

	/**
	 * Returns active meta-data manager. If not exist then one will be created
	 *
	 * @return Phalcon_Model_Metadata
	 */
	public function getMetaData(){
	}

	/**
	 * Sets the models directory. Depending of your platform, always add a trailing slash or backslash
	 *
	 * @param string $modelsDir
	 */
	public function setModelsDir($modelsDir){
	}

	/**
	 * Gets active models directory
	 *
	 * @return string
	 */
	public function getModelsDir(){
	}

	/**
	 * Checks whether the given name is an existing model
	 *
	 * <code>
	 * //Is there a "Robots" model?
	 * $isModel = $manager->isModel('Robots');
	 * </code>
	 *
	 * @param string $modelName
	 * @return boolean
	 */
	public function isModel($modelName){
	}

	/**
	 * Loads a model looking for its file and initializing them
	 *
	 * @param string $modelName
	 * @return boolean
	 */
	public function load($modelName){
	}

	/**
	 * Gets/Instantiates model from directory
	 *
	 * <code>
	 * //Get the "Robots" model
	 * $Robots = $manager->getModel('Robots');
	 * </code>
	 *
	 * @param string $modelName
	 * @return boolean
	 */
	public function getModel($modelName){
	}

	/**
	 * Gets the possible source model name from its class name
	 *
	 * @param string $modelName
	 * @return boolean
	 */
	public function getSource($modelName){
	}

	/**
	 * Gets default connection to the database. All models by default will use connection returned by this method
	 *
	 * @return Phalcon_Db
	 */
	public function getConnection(){
	}

	/**
	 * Setup a 1-1 relation between two models
	 *
	 * @param 	Phalcon_Model_Base $model
	 * @param	mixed $fields
	 * @param	string $referenceModel
	 * @param	mixed $referencedFields
	 * @param	array $options
	 */
	public function addHasOne($model, $fields, $referenceModel, $referencedFields, $options=array ()){
	}

	/**
	 * Setup a relation reverse 1-1  between two models
	 *
	 * @param 	Phalcon_Model_Base $model
	 * @param	mixed $fields
	 * @param	string $referenceModel
	 * @param	mixed $referencedFields
	 * @param	array $options
	 */
	public function addBelongsTo($model, $fields, $referenceModel, $referencedFields, $options=array ()){
	}

	/**
	 * Setup a relation 1-n between two models
	 *
	 * @param 	Phalcon_Model_Base $model
	 * @param	mixed $fields
	 * @param	string $referenceModel
	 * @param	mixed $referencedFields
	 * @param	array $options
	 */
	public function addHasMany($model, $fields, $referenceModel, $referencedFields, $options=array ()){
	}

	/**
	 * Checks whether a model has a belongsTo relation with another model
	 *
	 * @access 	public
	 * @param 	string $modelName
	 * @param 	string $modelRelation
	 * @return 	boolean
	 */
	public function existsBelongsTo($modelName, $modelRelation){
	}

	/**
	 * Checks whether a model has a hasMany relation with another model
	 *
	 * @param 	string $modelName
	 * @param 	string $modelRelation
	 * @return 	boolean
	 */
	public function existsHasMany($modelName, $modelRelation){
	}

	/**
	 * Checks whether a model has a hasOne relation with another model
	 *
	 * @param 	string $modelName
	 * @param 	string $modelRelation
	 * @return 	boolean
	 */
	public function existsHasOne($modelName, $modelRelation){
	}

	/**
	 * Helper method to query records based on a relation definition
	 *
	 * @param array $relation
	 * @param string $method
	 * @param Phalcon_Model_Base $record
	 */
	protected function _getRelationRecords($relation, $method, $record){
	}

	/**
	 * Gets belongsTo related records from a model
	 *
	 * @param string $method
	 * @param string $modelName
	 * @param string $modelRelation
	 * @param Phalcon_Model_Base $record
	 * @return Phalcon_Model_Resultset
	 */
	public function getBelongsToRecords($method, $modelName, $modelRelation, $record){
	}

	/**
	 * Gets hasMany related records from a model
	 *
	 * @param string $method
	 * @param string $modelName
	 * @param string $modelRelation
	 * @param Phalcon_Model_Base $record
	 * @return Phalcon_Model_Resultset
	 */
	public function getHasManyRecords($method, $modelName, $modelRelation, $record){
	}

	/**
	 * Gets belongsTo related records from a model
	 *
	 * @param string $method
	 * @param string $modelName
	 * @param string $modelRelation
	 * @param Phalcon_Model_Base $record
	 * @return Phalcon_Model_Resultset
	 */
	public function getHasOneRecords($method, $modelName, $modelRelation, $record){
	}

	/**
	 * Gets belongsTo relations defined on a model
	 *
	 * @param  Phalcon_Model_Base $model
	 * @return array
	 */
	public function getBelongsTo($model){
	}

	/**
	 * Gets hasMany relations defined on a model
	 *
	 * @param  Phalcon_Model_Base $model
	 * @return array
	 */
	public function getHasMany($model){
	}

	/**
	 * Gets hasOne relations defined on a model
	 *
	 * @param  Phalcon_Model_Base $model
	 * @return array
	 */
	public function getHasOne($model){
	}

	/**
	 * Gets hasOne relations defined on a model
	 *
	 * @param  Phalcon_Model_Base $model
	 * @return array
	 */
	public function getHasOneAndHasMany($model){
	}

	/**
	 * Autoload function for model lazy loading
	 *
	 * @param string $className
	 */
	public function autoload($className){
	}

}

/**
 * Phalcon_Model_Message
 *
 * Encapsulates validation info generated before save/delete records fails
 *
 * <code>
 * class Robots extens Phalcon_Model_Base {
 *
 *   function beforeSave(){
 *     if(this->name=='Peter'){
 *        $text = "A robot cannot be named Peter";
 *        $field = "name";
 *        $type = "InvalidValue";
 *        $message = new Phalcon_Model_Message($text, $field, $type);
 *        $this->appendMessage($message);
 *     }
 *   }
 * }
 * </code>
 *
 */
class Phalcon_Model_Message
{
	/**
     * Phalcon_Model_Message message
     *
     * @param string $message
     * @param string $field
     * @param string $type
     */
	public function __construct($message, $field=NULL, $type=NULL){
	}

	/**
     * Sets message type
     *
     * @param string $type
     */
	public function setType($type){
	}

	/**
     * Returns message type
     *
     * @return string
     */
	public function getType(){
	}

	/**
     * Sets verbose message
     *
     * @param string $message
     */
	public function setMessage($message){
	}

	/**
     * Returns verbose message
     *
     * @return string
     */
	public function getMessage(){
	}

	/**
     * Sets field name related to message
     *
     * @param string $field
     */
	public function setField($field){
	}

	/**
     * Returns field name related to message
     *
     * @return string
     */
	public function getField(){
	}

	/**
     * Magic __toString method returns verbose message
     *
     * @return string
     */
	public function __toString(){
	}

	/**
     * Magic __set_state helps to recover messsages from serialization
     *
     * @param array $message
     * @return Phalcon_Model_Message
     */
	public static function __set_state($message){
	}

}

/**
 * Phalcon_Model_MetaData
 *
 * <p>Because Phalcon_Model requires meta-data like field names, data types, primary keys, etc.
 * this component collect them and store for further querying by Phalcon_Model_Base.
 * Phalcon_Model_MetaData can also use adapters to store temporarily or permanently the meta-data.</p>
 *
 * <p>A standard Phalcon_Model_MetaData can be used to query model attributes:</p>
 *
 * <code>
 *$metaData = new Phalcon_Model_MetaData('Memory');
 *$attributes = $metaData->getAttributes(new Robots());
 *print_r($attributes);
 * </code>
 *
 */
class Phalcon_Model_MetaData
{
	const MODELS_ATTRIBUTES = 0;
	const MODELS_PRIMARY_KEY = 1;
	const MODELS_NON_PRIMARY_KEY = 2;
	const MODELS_NOT_NULL = 3;
	const MODELS_DATA_TYPE = 4;
	const MODELS_DATA_TYPE_NUMERIC = 5;
	const MODELS_DATE_AT = 6;
	const MODELS_DATE_IN = 7;
	const MODELS_IDENTITY_FIELD = 8;
	/**
	 * Phalcon_Model_MetaData constructor
	 *
	 * @param string $adapter
	 * @param array $options
	 */
	public function __construct($adapter, $options=array ()){
	}

	
	private function _initializeMetaData($model, $table, $schema){
	}

	/**
	 * Returns table attributes names (fields)
	 *
     * @param	Phalcon_Model_Base $model
	 * @return array
	 */
	public function getAttributes($model){
	}

	/**
	 * Returns an array of fields which are part of the primary key
	 *
	 * @param	Phalcon_Model_Base $model
	 * @return	array
	 */
	public function getPrimaryKeyAttributes($model){
	}

	/**
	 * Returns an arrau of fields which are not part of the primary key
	 *
     * @param	Phalcon_Model_Base $model
	 * @return array
	 */
	public function getNonPrimaryKeyAttributes($model){
	}

	/**
	 * Returns an array of not null attributes
	 *
     * @param	Phalcon_Model_Base $model
	 * @return array
	 */
	public function getNotNullAttributes($model){
	}

	/**
	 * Returns attributes and their data types
	 *
     * @param	Phalcon_Model_Base $model
	 * @return array
	 */
	public function getDataTypes($model){
	}

	/**
	 * Returns attributes which types are numerical
	 *
     * @param  Phalcon_Model_Base $model
	 * @return array
	 */
	public function getDataTypesNumeric($model){
	}

	/**
	 * Returns the name of identity field (if one is present)
	 *
	 * @param  Phalcon_Model_Base $model
	 * @return array
	 */
	public function getIdentityField($model){
	}

	/**
	 * Stores meta-data using an adapter
	 */
	public function storeMetaData(){
	}

}

/**
 * Phalcon_Model_Query
 *
 * Phalcon_Model_Query is designed to simplify building of search on models.
 * It provides a set of helpers to generate searchs in a dynamic way to support differents databases.
 *
 * <code>
 *
 * $query = new Phalcon_Model_Query();
 * $query->setManager($manager);
 * $query->from('Robots');
 * $query->where('id = ?0');
 * $query->where('name LIKE ?1');
 * $query->setParameter(array(0 => '10', 1 => '%Astro%'));
 * foreach($query->getResultset() as $robot){
 *  echo $robot->name, "\n";
 * }
 * </code>
 *
 */
class Phalcon_Model_Query
{
	/**
	 * Set the Phalcon_Model_Manager instance to use in a query
	 *
	 * <code>
	 * $controllerFront = Phalcon_Controller_Front::getInstance();
	 * $modelManager = $controllerFront->getModelComponent();
	 * $query = new Phalcon_Model_Query();
	 * $query->setManager($manager);
	 * </code>
	 *
	 * @param Phalcon_Model_Manager $manager
	 */
	public function setManager($manager){
	}

	/**
	 * Add models to use in query
	 *
	 * @param string $model
	 */
	public function from($model){
	}

	/**
	 * Add conditions to use in query
	 *
	 * @param string $condition
	 */
	public function where($condition){
	}

	/**
	 * Set parameter in query to different database adapters.
	 *
	 * @param string $parameter
	 */
	public function setParameters($parameter){
	}

	/**
	 * Set the data to use to make the conditions in query
	 *
	 * @param array $data
	 */
	public function setInputData($data){
	}

	/**
	 * Set the limit of rows to show
	 *
	 * @param int $limit
	 */
	public function setLimit($limit){
	}

	
	public function getResultset(){
	}

	/**
	 * Get the conditions of query
	 *
	 * @return string $query
	 */
	public function getConditions(){
	}

	/**
	 * Get instance of model query
	 *
	 * @param string $modelName
	 * @param array $data
	 * @return Phalcon_Model_Query $query
	 */
	public static function fromInput($modelName, $data){
	}

}

/**
 * Phalcon_Model_Resultset
 *
 * This component allows to Phalcon_Model_Base returns large resulsets with the minimum memory consumption
 * Resulsets can be traversed using a standard foreach or a while statement. If a resultset is serialized
 * it will dump all the rows into a big array. Then unserialize will retrieve the rows as they were before
 * serializing.
 *
 * <code>
 * //Using a standard foreach
 *$robots = $Robots->find(array("type='virtual'", "order" => "name"));
 *foreach($robots as $robot){
 *  echo $robot->name, "\n";
 *}
 *
 * //Using a while
 *$robots = $Robots->find(array("type='virtual'", "order" => "name"));
 *$robots->rewind();
 *while($robots->valid()){
 *  $robot = $robots->current();
 *  echo $robot->name, "\n";
 *  $robots->next();
 *}
 * </code>
 *
 */
class Phalcon_Model_Resultset implements Iterator, Traversable, SeekableIterator, Countable, ArrayAccess, Serializable
{
	/**
	 * Phalcon_Model_Resultset constructor
	 *
	 * @param Phalcon_Model_Base $model
	 * @param resource $resultResource
	 */
	public function __construct($model, $resultResource){
	}

	/**
	 * Check whether internal resource has rows to fetch
	 *
	 * @return boolean
	 */
	public function valid(){
	}

	/**
	 * Returns current row in the resultset
	 *
	 * @return Phalcon_Model_Base
	 */
	public function current(){
	}

	/**
	 * Moves cursor to next row in the resultset
	 *
	 */
	public function next(){
	}

	/**
	 * Gets pointer number of active row in the resultset
	 *
	 */
	public function key(){
	}

	/**
	 * Rewinds resultset to its beginning
	 *
	 */
	public function rewind(){
	}

	/**
	 * Changes internal pointer to a specific position in the resultset
	 */
	public function seek($position){
	}

	/**
	 * Counts how many rows are in the resultset
	 *
	 * @return int
	 */
	public function count(){
	}

	/**
	 * Checks whether offset exists in the resultset
	 *
	 * @param int $index
	 * @return boolean
	 */
	public function offsetExists($index){
	}

	/**
	 * Gets row in a specific position of the resultset
	 *
	 * @param int $index
	 * @return Phalcon_Model_Base
	 */
	public function offsetGet($index){
	}

	/**
	 * Resulsets cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
	 *
	 * @param int $index
	 * @param Phalcon_Model_Base $value
	 */
	public function offsetSet($index, $value){
	}

	/**
	 * Resulsets cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
	 *
	 * @param int $index
	 */
	public function offsetUnset($offset){
	}

	/**
	 * Get first row in the resultset
	 *
	 * @return Phalcon_Model_Base
	 */
	public function getFirst(){
	}

	/**
	 * Get last row in the resultset
	 *
	 * @return Phalcon_Model_Base
	 */
	public function getLast(){
	}

	/**
	 * Serializing a resultset will dump all related rows into a big array
	 *
	 * @param int $index
	 */
	public function serialize(){
	}

	/**
	 * Unserializing a resultset will allow to only works on the rows present in the saved state
	 *
	 * @param int $index
	 */
	public function unserialize($data){
	}

}

/**
 * Phalcon_Model_Row
 *
 * This component allows to Phalcon_Model_Base returns grouped resultsets.
 */
class Phalcon_Model_Row
{
	/**
	 * Overwrites default connection
	 *
	 * @param Phalcon_Db $connection
	 */
	public function setConnection($connection){
	}

	/**
	 * Returns default connection
	 *
	 * @return Phalcon_Db
	 */
	public function getConnection(){
	}

	/**
	 * Assigns values to a row from an array returning a new row
	 *
	 *<code>
	 *$row = new Phalcon_Model_Row();
	 *$newRow = $row->dumpResult(array(
	 *  'type' => 'mechanical',
	 *  'name' => 'Astro Boy',
	 *  'year' => 1952
	 *));
	 *</code>
	 *
	 * @param array $result
	 * @return Phalcon_Model $result
	 */
	public function dumpResult($result){
	}

	/**
	 * Reads an attribute value by its name
	 *
	 * <code> echo $robot->readAttribute('name'); ?></code>
	 *
	 * @param string $attribute
	 * @return mixed
	 */
	public function readAttribute($property){
	}

	/**
	 * Magic method sleep
	 *
	 * @return array
	 */
	public function sleep(){
	}

}


class Phalcon_Model_Sanitize
{
}


abstract class Phalcon_Model_Validator
{
	/**
	 * Phalcon_Model_Validator constructor
	 *
	 * @param Phalcon_Model_Base $record
	 * @param string $field
	 * @param string $value
	 * @param array $options
	 */
	public function __construct($record, $fieldName, $value, $options=array ()){
	}

	/**
	 * Appends a message to the validator
	 *
	 * @param string $message
	 * @param string $field
	 * @param string $type
	 */
	protected function appendMessage($message, $field=NULL, $type=NULL){
	}

	/**
	 * Returns messages generated by the validator
	 *
	 * @return array
	 */
	public function getMessages(){
	}

	/**
	 * Check whether option "required" has been passed as option
	 *
	 * @return boolean
	 */
	protected function isRequired(){
	}

	/**
	 * Returns all the options from the validator
	 *
	 * @return array
	 */
	protected function getOptions(){
	}

	/**
	 * Returns an option
	 *
	 * @param	string $option
	 * @return	mixed
	 */
	protected function getOption($option){
	}

	/**
	 * Check whether a option has been defined in the validator options
	 *
	 * @param	string $option
	 * @return	boolean
	 */
	protected function isSetOption($option){
	}

	/**
	 * Returns the value of the validated field
	 *
	 * @return	mixed
	 */
	protected function getValue(){
	}

	/**
	 * Devuelve el nombre del campo validado
	 *
	 * @access protected
	 * @return string
	 */
	protected function getFieldName(){
	}

	/**
	 * Returns Phalcon_Model_Base related record
	 *
	 * @return ActiveRecord
	 */
	protected function getRecord(){
	}

	/**
	 * This method can be overridden to implement specific option validations for the validator
	 *
	 */
	public function checkOptions(){
	}

}

/**
 * Phalcon_Model_MetaData_Memory
 *
 * Stores model meta-data in memory. Data will be erased when the request finishes
 */
class Phalcon_Model_MetaData_Memory
{
	
	public function read(){
	}

	
	public function write($data){
	}

}

/**
 * Phalcon_Model_MetaData_Session
 *
 * Stores model meta-data in session. Data will erase when the session finishes.
 * Meta-data are permanent while the session is active
 */
class Phalcon_Model_MetaData_Session
{
	
	public function __construct($options){
	}

	
	public function read(){
	}

	
	public function write($data){
	}

}

/**
 * Phalcon_Model_Validator_Email
 *
 * Let to validate that email fields has correct values
 *
 */
class Phalcon_Model_Validator_Email extends Php_Model_Validator
{
	/**
	 * Executes the validator
	 *
	 * @return boolean
	 */
	public function validate(){
	}

	/**
	 * Phalcon_Model_Validator constructor
	 *
	 * @param Phalcon_Model_Base $record
	 * @param string $field
	 * @param string $value
	 * @param array $options
	 */
	public function __construct($record, $fieldName, $value, $options=array ()){
	}

	/**
	 * Appends a message to the validator
	 *
	 * @param string $message
	 * @param string $field
	 * @param string $type
	 */
	protected function appendMessage($message, $field=NULL, $type=NULL){
	}

	/**
	 * Returns messages generated by the validator
	 *
	 * @return array
	 */
	public function getMessages(){
	}

	/**
	 * Check whether option "required" has been passed as option
	 *
	 * @return boolean
	 */
	protected function isRequired(){
	}

	/**
	 * Returns all the options from the validator
	 *
	 * @return array
	 */
	protected function getOptions(){
	}

	/**
	 * Returns an option
	 *
	 * @param	string $option
	 * @return	mixed
	 */
	protected function getOption($option){
	}

	/**
	 * Check whether a option has been defined in the validator options
	 *
	 * @param	string $option
	 * @return	boolean
	 */
	protected function isSetOption($option){
	}

	/**
	 * Returns the value of the validated field
	 *
	 * @return	mixed
	 */
	protected function getValue(){
	}

	/**
	 * Devuelve el nombre del campo validado
	 *
	 * @access protected
	 * @return string
	 */
	protected function getFieldName(){
	}

	/**
	 * Returns Phalcon_Model_Base related record
	 *
	 * @return ActiveRecord
	 */
	protected function getRecord(){
	}

	/**
	 * This method can be overridden to implement specific option validations for the validator
	 *
	 */
	public function checkOptions(){
	}

}

/**
 * ExclusionInValidator
 *
 * Check if a value is not included into a list of values
 *
 *<code>
 *class Subscriptors extends Phalcon_Model_Base {
 *
 *	function validation(){
 * 		$this->validate('ExclusionIn', array(
 *			'field' => 'status',
 *			'domain' => array('A', 'I')
 *		));
 *		if($this->validationHasFailed()==true){
 *			return false;
 *		}
 *	}
 *
 *}
 *</code>
 */
class Phalcon_Model_Validator_Exclusionin extends Php_Model_Validator
{
	/**
     * Check that the options are valid
	 *
	 */
	public function checkOptions(){
	}

	/**
	 * Executes validator
	 *
	 * @return boolean
	 */
	public function validate(){
	}

	/**
	 * Phalcon_Model_Validator constructor
	 *
	 * @param Phalcon_Model_Base $record
	 * @param string $field
	 * @param string $value
	 * @param array $options
	 */
	public function __construct($record, $fieldName, $value, $options=array ()){
	}

	/**
	 * Appends a message to the validator
	 *
	 * @param string $message
	 * @param string $field
	 * @param string $type
	 */
	protected function appendMessage($message, $field=NULL, $type=NULL){
	}

	/**
	 * Returns messages generated by the validator
	 *
	 * @return array
	 */
	public function getMessages(){
	}

	/**
	 * Check whether option "required" has been passed as option
	 *
	 * @return boolean
	 */
	protected function isRequired(){
	}

	/**
	 * Returns all the options from the validator
	 *
	 * @return array
	 */
	protected function getOptions(){
	}

	/**
	 * Returns an option
	 *
	 * @param	string $option
	 * @return	mixed
	 */
	protected function getOption($option){
	}

	/**
	 * Check whether a option has been defined in the validator options
	 *
	 * @param	string $option
	 * @return	boolean
	 */
	protected function isSetOption($option){
	}

	/**
	 * Returns the value of the validated field
	 *
	 * @return	mixed
	 */
	protected function getValue(){
	}

	/**
	 * Devuelve el nombre del campo validado
	 *
	 * @access protected
	 * @return string
	 */
	protected function getFieldName(){
	}

	/**
	 * Returns Phalcon_Model_Base related record
	 *
	 * @return ActiveRecord
	 */
	protected function getRecord(){
	}

}

/**
 * Phalcon_Model_Validator_Inclusionin
 *
 * Check if a value is included into a list of values
 *
 *<code>
 *class Subscriptors extends Phalcon_Model_Base {
 *
 *	function validation(){
 * 		$this->validate('InclusionIn', array(
 *			'field' => 'status',
 *			'domain' => array('P', 'I')
 *		));
 *		if($this->validationHasFailed()==true){
 *			return false;
 *		}
 *	}
 *
 *}
 *</code>
 *
 */
class Phalcon_Model_Validator_Inclusionin extends Php_Model_Validator
{
	/**
     * Check that the options are valid
	 *
	 */
	public function checkOptions(){
	}

	/**
	 * Executes validator
	 *
	 * @return boolean
	 */
	public function validate(){
	}

	/**
	 * Phalcon_Model_Validator constructor
	 *
	 * @param Phalcon_Model_Base $record
	 * @param string $field
	 * @param string $value
	 * @param array $options
	 */
	public function __construct($record, $fieldName, $value, $options=array ()){
	}

	/**
	 * Appends a message to the validator
	 *
	 * @param string $message
	 * @param string $field
	 * @param string $type
	 */
	protected function appendMessage($message, $field=NULL, $type=NULL){
	}

	/**
	 * Returns messages generated by the validator
	 *
	 * @return array
	 */
	public function getMessages(){
	}

	/**
	 * Check whether option "required" has been passed as option
	 *
	 * @return boolean
	 */
	protected function isRequired(){
	}

	/**
	 * Returns all the options from the validator
	 *
	 * @return array
	 */
	protected function getOptions(){
	}

	/**
	 * Returns an option
	 *
	 * @param	string $option
	 * @return	mixed
	 */
	protected function getOption($option){
	}

	/**
	 * Check whether a option has been defined in the validator options
	 *
	 * @param	string $option
	 * @return	boolean
	 */
	protected function isSetOption($option){
	}

	/**
	 * Returns the value of the validated field
	 *
	 * @return	mixed
	 */
	protected function getValue(){
	}

	/**
	 * Devuelve el nombre del campo validado
	 *
	 * @access protected
	 * @return string
	 */
	protected function getFieldName(){
	}

	/**
	 * Returns Phalcon_Model_Base related record
	 *
	 * @return ActiveRecord
	 */
	protected function getRecord(){
	}

}

/**
 * Phalcon_Model_Validator_Numericality
 *
 *
 */
class Phalcon_Model_Validator_Numericality extends Php_Model_Validator
{
	/**
	 * Executes the validator
	 *
	 * @return boolean
	 */
	public function validate(){
	}

	/**
	 * Phalcon_Model_Validator constructor
	 *
	 * @param Phalcon_Model_Base $record
	 * @param string $field
	 * @param string $value
	 * @param array $options
	 */
	public function __construct($record, $fieldName, $value, $options=array ()){
	}

	/**
	 * Appends a message to the validator
	 *
	 * @param string $message
	 * @param string $field
	 * @param string $type
	 */
	protected function appendMessage($message, $field=NULL, $type=NULL){
	}

	/**
	 * Returns messages generated by the validator
	 *
	 * @return array
	 */
	public function getMessages(){
	}

	/**
	 * Check whether option "required" has been passed as option
	 *
	 * @return boolean
	 */
	protected function isRequired(){
	}

	/**
	 * Returns all the options from the validator
	 *
	 * @return array
	 */
	protected function getOptions(){
	}

	/**
	 * Returns an option
	 *
	 * @param	string $option
	 * @return	mixed
	 */
	protected function getOption($option){
	}

	/**
	 * Check whether a option has been defined in the validator options
	 *
	 * @param	string $option
	 * @return	boolean
	 */
	protected function isSetOption($option){
	}

	/**
	 * Returns the value of the validated field
	 *
	 * @return	mixed
	 */
	protected function getValue(){
	}

	/**
	 * Devuelve el nombre del campo validado
	 *
	 * @access protected
	 * @return string
	 */
	protected function getFieldName(){
	}

	/**
	 * Returns Phalcon_Model_Base related record
	 *
	 * @return ActiveRecord
	 */
	protected function getRecord(){
	}

	/**
	 * This method can be overridden to implement specific option validations for the validator
	 *
	 */
	public function checkOptions(){
	}

}

/**
 * Phalcon_Model_Validator_Regex
 *
 * Validate that the value of a field matches a regular expression
 *
 *<code>
 *class Subscriptors extends Phalcon_Model_Base {
 *
 *	function validation(){
 *		$this->validate('Regex', array(
 *			'field' => 'created_at',
 *          'pattern' => '/^[0-9]{4}[-\/](0[1-9]|1[12])[-\/](0[1-9]|[12][0-9]|3[01])$/'
 *		));
 *		if($this->validationHasFailed()==true){
 *			return false;
 *		}
 *	}
 *
 *}
 *</code>
 *
 */
class Phalcon_Model_Validator_Regex extends Php_Model_Validator
{
	/**
	 * Check that the options are correct
	 *
	 */
	public function checkOptions(){
	}

	/**
	 * Executes the validator
	 *
	 * @return 	boolean
	 */
	public function validate(){
	}

	/**
	 * Phalcon_Model_Validator constructor
	 *
	 * @param Phalcon_Model_Base $record
	 * @param string $field
	 * @param string $value
	 * @param array $options
	 */
	public function __construct($record, $fieldName, $value, $options=array ()){
	}

	/**
	 * Appends a message to the validator
	 *
	 * @param string $message
	 * @param string $field
	 * @param string $type
	 */
	protected function appendMessage($message, $field=NULL, $type=NULL){
	}

	/**
	 * Returns messages generated by the validator
	 *
	 * @return array
	 */
	public function getMessages(){
	}

	/**
	 * Check whether option "required" has been passed as option
	 *
	 * @return boolean
	 */
	protected function isRequired(){
	}

	/**
	 * Returns all the options from the validator
	 *
	 * @return array
	 */
	protected function getOptions(){
	}

	/**
	 * Returns an option
	 *
	 * @param	string $option
	 * @return	mixed
	 */
	protected function getOption($option){
	}

	/**
	 * Check whether a option has been defined in the validator options
	 *
	 * @param	string $option
	 * @return	boolean
	 */
	protected function isSetOption($option){
	}

	/**
	 * Returns the value of the validated field
	 *
	 * @return	mixed
	 */
	protected function getValue(){
	}

	/**
	 * Devuelve el nombre del campo validado
	 *
	 * @access protected
	 * @return string
	 */
	protected function getFieldName(){
	}

	/**
	 * Returns Phalcon_Model_Base related record
	 *
	 * @return ActiveRecord
	 */
	protected function getRecord(){
	}

}

/**
 * Phalcon_Model_Validator_Uniqueness
 *
 * Validates that a field or a combination of a set of fields are not
 * present more than once in the existing records of the related table
 *
 *<code>
 *class Subscriptors extends Phalcon_Model_Base {
 *
 *	function validation(){
 *		$this->validate('Uniqueness', array(
 *			'field' => 'email'
 *		));
 *		if($this->validationHasFailed()==true){
 *			return false;
 *		}
 *	}
 *
 *}
 *</code>
 *
 */
class Phalcon_Model_Validator_Uniqueness extends Php_Model_Validator
{
	/**
	 * Executes the validator
	 *
	 * @return boolean
	 */
	public function validate(){
	}

	/**
	 * Phalcon_Model_Validator constructor
	 *
	 * @param Phalcon_Model_Base $record
	 * @param string $field
	 * @param string $value
	 * @param array $options
	 */
	public function __construct($record, $fieldName, $value, $options=array ()){
	}

	/**
	 * Appends a message to the validator
	 *
	 * @param string $message
	 * @param string $field
	 * @param string $type
	 */
	protected function appendMessage($message, $field=NULL, $type=NULL){
	}

	/**
	 * Returns messages generated by the validator
	 *
	 * @return array
	 */
	public function getMessages(){
	}

	/**
	 * Check whether option "required" has been passed as option
	 *
	 * @return boolean
	 */
	protected function isRequired(){
	}

	/**
	 * Returns all the options from the validator
	 *
	 * @return array
	 */
	protected function getOptions(){
	}

	/**
	 * Returns an option
	 *
	 * @param	string $option
	 * @return	mixed
	 */
	protected function getOption($option){
	}

	/**
	 * Check whether a option has been defined in the validator options
	 *
	 * @param	string $option
	 * @return	boolean
	 */
	protected function isSetOption($option){
	}

	/**
	 * Returns the value of the validated field
	 *
	 * @return	mixed
	 */
	protected function getValue(){
	}

	/**
	 * Devuelve el nombre del campo validado
	 *
	 * @access protected
	 * @return string
	 */
	protected function getFieldName(){
	}

	/**
	 * Returns Phalcon_Model_Base related record
	 *
	 * @return ActiveRecord
	 */
	protected function getRecord(){
	}

	/**
	 * This method can be overridden to implement specific option validations for the validator
	 *
	 */
	public function checkOptions(){
	}

}


class Phalcon_Paginator_Exception extends Php_Exception
{
	/**
	* Paginator Exception
	*
	* @param string $message
	*/
	public function __construct($message){
	}

	
	final private function __clone(){
	}

	
	final public function getMessage(){
	}

	
	final public function getCode(){
	}

	
	final public function getFile(){
	}

	
	final public function getLine(){
	}

	
	final public function getTrace(){
	}

	
	final public function getPrevious(){
	}

	
	final public function getTraceAsString(){
	}

	
	public function __toString(){
	}

}

/**
 * Array_Paginator
 *
 * Component of pagination by array data
 *
 */
class Phalcon_Paginator_Adapter_Array
{
	/**
     * Phalcon_Paginator_Adapter_Array constructor
 	 *
	 * @param array $config
     */
	public function __construct($config){
	}

	/**
	 * Set the current page number
	 *
	 * @param int $page
	 */
	public function setCurrentPage($page){
	}

	/**
	 * Returns a slice of the resultset to show in the pagination
	 *
	 * @return stdClass
	 */
	public function getPaginate(){
	}

}

/**
 * Phalcon_Paginator_Adapter_Model
 *
 * This adapter allows to paginate data using Phalcon_Model resultsets.
 *
 */
class Phalcon_Paginator_Adapter_Model
{
	/**
	 * Phalcon_Paginator_Adapter_Model constructor
	 *
	 * @param array $config
	 */
	public function __construct($config){
	}

	/**
	 * Set the current page number
	 *
	 * @param int $page
	 */
	public function setCurrentPage($page){
	}

	/**
	 * Returns a slice of the resultset to show in the pagination
	 *
	 * @return stdClass
	 */
	public function getPaginate(){
	}

}

/**
 * Phalcon_Request_File
 *
 * Provides OO wrappers to the $_FILES superglobal
 */
class Phalcon_Request_File
{
	
	public function __construct($file){
	}

	
	public function getSize(){
	}

	
	public function getName(){
	}

	
	public function getTempName(){
	}

}

/**
 * Phalcon_Router_Regex
 *
 * <p>Phalcon_Router_Regex is the standard framework router. Routing is the
 * process of taking a URI endpoint (that part of the URI which comes after the base URL) and
 * decomposing it into parameters to determine which module, controller, and
 * action of that controller should receive the request</p>
 *
 *<code>
 *$router = new Phalcon_Router_Rewrite();
 *$router->handle();
 *echo $router->getControllerName();
 *</code>
 *
 * Settings baseUri first:
 *
 *<code>
 *$router = new Phalcon_Router_Regex(); 
 *$router->handle();
 *echo $router->getControllerName();
 *</code>
 *</example>
 */
class Phalcon_Router_Regex
{
	
	public function __construct(){
	}

	/**
	 * Get rewrite info
	 */
	protected function _getRewriteUri(){
	}

	/**
	 * Set the base of application
	 *
	 * @param string $baseUri
	 */
	public function setBaseUri($baseUri){
	}

	
	public function compilePattern($pattern){
	}

	
	public function add($pattern, $parts){
	}

	/**
	 * Handles routing information received from the rewrite engine
	 *
	 * @param string $uri
	 */
	public function handle($uri=NULL){
	}

	/**
	 * Returns proccesed controller name
	 *
	 * @return string
	 */
	public function getControllerName(){
	}

	/**
	 * Returns proccesed action name
	 *
	 * @return string
	 */
	public function getActionName(){
	}

	/**
	 * Returns proccesed extra params
	 *
	 * @return array
	 */
	public function getParams(){
	}

}

/**
 * Phalcon_Router_Rewrite
 *
 * <p>Phalcon_Router_Rewrite is the standard framework router. Routing is the
 * process of taking a URI endpoint (that part of the URI which comes after the base URL) and
 * decomposing it into parameters to determine which module, controller, and
 * action of that controller should receive the request</p>
 *
 *<example>
 *Rewrite rules using a single document root:
 *<code>
 *RewriteEngine On
 *RewriteCond %{REQUEST_FILENAME} -s [OR]
 *RewriteCond %{REQUEST_FILENAME} -l [OR]
 *RewriteCond %{REQUEST_FILENAME} -d
 *RewriteRule ^.*$ - [NC,L]
 *RewriteRule ^.*$ index.php [NC,L]
 *</code>
 *
 *Rewrite rules using a hidden directory and a public/ document root:
 *<code>
 *RewriteEngine on
 *RewriteRule  ^$ public/    [L]
 *RewriteRule  (.*) public/$1 [L]
 *</code>
 *
 * On public/.htaccess:
 *
 *<code>
 *RewriteEngine On
 *RewriteCond %{REQUEST_FILENAME} !-d
 *RewriteCond %{REQUEST_FILENAME} !-f
 *RewriteRule ^(.*)$ index.php?_url=$1 [QSA,L]
 *</code>
 *
 * The component can be used as follows:
 *
 *<code>
 *$router = new Phalcon_Router_Rewrite(); 
 *$router->handle();
 *echo $router->getControllerName();
 *</code>
 *</example>
 */
class Phalcon_Router_Rewrite
{
	/**
	 * Get rewrite info
	 */
	protected function _getRewriteUri(){
	}

	/**
	 * Set a uri prefix. This will be replaced from the beginning of the uri
	 */
	public function setPrefix($prefix){
	}

	/**
	 * Handles routing information received from the rewrite engine
	 *
	 * @param string $uri
	 */
	public function handle($uri=NULL){
	}

	/**
	 * Returns proccesed controller name
	 *
	 * @return string
	 */
	public function getControllerName(){
	}

	/**
	 * Returns proccesed action name
	 *
	 * @return string
	 */
	public function getActionName(){
	}

	/**
	 * Returns proccesed extra params
	 *
	 * @return array
	 */
	public function getParams(){
	}

}

/**
 * Phalcon_Session_Namespace
 *
 * This component helps to separate session data into namespaces. Working by this way
 * you can easily create groups of session variables into the application
 */
class Phalcon_Session_Namespace
{
	/**
	* Constructo of class
	*
	* @param string $name
	*/
	public function __construct($name){
	}

	/**
	* Setter of values
	*
	* @param string $property
	* @param string $value
	*/
	public function __set($property, $value){
	}

	/**
	* Getter of values
	*
	* @param string $property
	* @return string
	*/
	public function __get($property){
	}

}


class Phalcon_Tag_Exception extends Php_Exception
{
	/**
	* Paginator Exception
	*
	* @param string $message
	*/
	public function __construct($message){
	}

	
	final private function __clone(){
	}

	
	final public function getMessage(){
	}

	
	final public function getCode(){
	}

	
	final public function getFile(){
	}

	
	final public function getLine(){
	}

	
	final public function getTrace(){
	}

	
	final public function getPrevious(){
	}

	
	final public function getTraceAsString(){
	}

	
	public function __toString(){
	}

}


abstract class Phalcon_Tag_Select
{
	
	public static function select($parameters, $data=NULL){
	}

	
	protected static function _optionsFromResultset($resultset, $using, $value, $closeOption){
	}

	
	protected static function _optionsFromArray($data, $value, $closeOption){
	}

}

/**
 * Phalcon_Transaction_Failed
 *
 * Phalcon_Transaction_Failed will thrown to exit a try/catch block for transactions
 *
 */
class Phalcon_Transaction_Failed extends Exception
{
	/**
	 * Phalcon_Transaction_Failed constructor
	 *
	 * @param string $message
	 * @param Phalcon_Model_Base $record
	 */
	public function __construct($message, $record){
	}

	/**
	 * Returns validation record messages which stop the transaction
	 *
	 * @return string
	 */
	public function getRecordMessages(){
	}

	/**
	 * Returns validation record messages which stop the transaction
	 *
	 * @return Phalcon_Model_Base
	 */
	public function getRecord(){
	}

	
	final private function __clone(){
	}

	
	final public function getMessage(){
	}

	
	final public function getCode(){
	}

	
	final public function getFile(){
	}

	
	final public function getLine(){
	}

	
	final public function getTrace(){
	}

	
	final public function getPrevious(){
	}

	
	final public function getTraceAsString(){
	}

	
	public function __toString(){
	}

}

/**
 * Phalcon_Transaction_Manager
 *
 * A transaction acts on a single database connection. If you have multiple class-specific
 * databases, the transaction will not protect interaction among them
 *
  *<code>
 *try {
 *
 *  $transaction = Phalcon_Transaction_Manager::get();
 *
 *  $robot = new Robots();
 *  $robot->setTransaction($transaction);
 *  $robot->name = 'WALL·E';
 *  $robot->created_at = date('Y-m-d');
 *  if($robot->save()==false){
 *    $transaction->rollback("Can't save robot");
 *  }
 *
 *  $robotPart = new RobotParts();
 *  $robotPart->setTransaction($transaction);
 *  $robotPart->type = 'head';
 *  if($robotPart->save()==false){
 *    $transaction->rollback("Can't save robot part");
 *  }
 *
 *  $transaction->commit();
 *
 *}
 *catch(Phalcon_Transaction_Failed $e){
 *  echo 'Failed, reason: ', $e->getMessage();
 *}
 *
 *</code>
 *
 */
class Phalcon_Transaction_Manager
{
	/**
	 * Checks whether manager has an active transaction
	 *
	 * @return boolean
	 */
	public static function has(){
	}

	/**
	 * Returns a new Phalcon_Transaction or an already created once
	 *
	 * @param boolean $autoBegin
	 * @return Phalcon_Transaction
	 */
	public static function get($autoBegin=true){
	}

	/**
	 * Rollbacks active transactions whithin the manager
	 *
	 */
	public static function rollbackPendent(){
	}

	/**
	 * Commmits active transactions whithin the manager
	 *
	 */
	public static function commit(){
	}

	/**
	 * Rollbacks active transactions whithin the manager
	 * Collect will remove transaction from the manager
	 *
	 * @param boolean $collect
	 */
	public static function rollback($collect=false){
	}

	/**
	 * Notifies the manager about a rollbacked transaction
	 *
	 * @param Phalcon_Transaction $transaction
	 */
	public static function notifyRollback($transaction){
	}

	/**
	 * Notifies the manager about a commited transaction
	 *
	 * @param Phalcon_Transaction $transaction
	 */
	public static function notifyCommit($transaction){
	}

	
	private static function _collectTransaction($transaction){
	}

	/**
	 * Remove all the transactions from the manager
	 *
	 */
	public static function collectTransactions(){
	}

	/**
	 * Checks whether manager will inject an automatic transaction to all newly
	 * created instances of Phalcon_Model_base
	 *
	 * @return boolean
	 */
	public static function isAutomatic(){
	}

	/**
	 * Returns automatic transaction for instances of Phalcon_Model_base
	 *
	 * @return Phalcon_Transaction
	 */
	public static function getAutomatic(){
	}

}

/**
 * Phalcon_Translate_Exception
 *
 * Class for exceptions thrown by Phalcon_Translate
 */
class Phalcon_Translate_Exception extends Php_Exception
{
	
	final private function __clone(){
	}

	
	public function __construct($message, $code, $previous){
	}

	
	final public function getMessage(){
	}

	
	final public function getCode(){
	}

	
	final public function getFile(){
	}

	
	final public function getLine(){
	}

	
	final public function getTrace(){
	}

	
	final public function getPrevious(){
	}

	
	final public function getTraceAsString(){
	}

	
	public function __toString(){
	}

}

/**
 * Phalcon_Translate_Adapter_Array
 *
 * Allows to define translation lists using PHP arrays
 *
 */
class Phalcon_Translate_Adapter_Array
{
	/**
	 * Phalcon_Translate_Adapter_Array constructor
	 *
	 * @param array $data
	 */
	public function __construct($options){
	}

	/**
	 * Returns the translation related to the given key
	 *
	 * @param	string $index
	 * @return	string
	 */
	public function query($index){
	}

	/**
	 * Check whether is defined a translation key in the internal array
	 *
	 * @param 	string $index
	 * @return	string
	 */
	public function exists($index){
	}

}

/**
 * Phalcon_View_Engine
 *
 * All the template engine adapters must inherit this class. This provides
 * basic interfacing between the engine and the Phalcon_View component.
 */
class Phalcon_View_Engine
{
	/**
	 * Phalcon_View_Engine constructor
	 *
	 * @param Phalcon_View $view
	 * @param array $options
	 * @param array $params
	 */
	public function __construct($view, $options){
	}

	/**
	 * Initializes the engine adapter
	 *
	 * @param Phalcon_View $view
	 * @param array $options
	 */
	public function initialize($view, $options){
	}

	/**
	 * Gets the name of the controller rendered
	 *
	 * @return string
	 */
	public function getControllerName(){
	}

	/**
	 * Gets the name of the action rendered
	 *
	 * @return string
	 */
	public function getActionName(){
	}

	/**
	 * Returns cached ouput on another view stage
	 *
	 * @return array
	 */
	public function getContent(){
	}

	/**
	 * Generates a external absolute path to an application uri
	 *
	 * @param array|string $params
	 * @return string
	 */
	public function url($params=NULL){
	}

	/**
	 * Returns a local path
	 *
	 * @param array|string $params
	 * @return string
	 */
	public function path($params=''){
	}

	/**
	 * Renders a partial inside another view
	 *
	 * @param string $partialPath
	 */
	public function partial($partialPath){
	}

}

/**
 * Phalcon_View_Exception
 *
 * Class for exceptions thrown by Phalcon_View
 */
class Phalcon_View_Exception extends Php_Exception
{
	
	final private function __clone(){
	}

	
	public function __construct($message, $code, $previous){
	}

	
	final public function getMessage(){
	}

	
	final public function getCode(){
	}

	
	final public function getFile(){
	}

	
	final public function getLine(){
	}

	
	final public function getTrace(){
	}

	
	final public function getPrevious(){
	}

	
	final public function getTraceAsString(){
	}

	
	public function __toString(){
	}

}

/**
 * Phalcon_View_Engine_Mustache
 *
 * Adapter to use Mustache library as templating engine
 */
class Phalcon_View_Engine_Mustache extends Php_View_Engine
{
	/**
	 * Phalcon_View_Engine_Mustache constructor
	 *
	 * @param Phalcon_View $view
	 * @param array $options
	 */
	public function __construct($view, $options){
	}

	/**
	 * Renders a view using the template engine
	 *
	 * @param string $path
	 * @param array $params
	 */
	public function render($path, $params){
	}

	
	public function __isset($property){
	}

	
	public function __get($property){
	}

	
	public function __call($method, $arguments){
	}

	/**
	 * Initializes the engine adapter
	 *
	 * @param Phalcon_View $view
	 * @param array $options
	 */
	public function initialize($view, $options){
	}

	/**
	 * Gets the name of the controller rendered
	 *
	 * @return string
	 */
	public function getControllerName(){
	}

	/**
	 * Gets the name of the action rendered
	 *
	 * @return string
	 */
	public function getActionName(){
	}

	/**
	 * Returns cached ouput on another view stage
	 *
	 * @return array
	 */
	public function getContent(){
	}

	/**
	 * Generates a external absolute path to an application uri
	 *
	 * @param array|string $params
	 * @return string
	 */
	public function url($params=NULL){
	}

	/**
	 * Returns a local path
	 *
	 * @param array|string $params
	 * @return string
	 */
	public function path($params=''){
	}

	/**
	 * Renders a partial inside another view
	 *
	 * @param string $partialPath
	 */
	public function partial($partialPath){
	}

}

/**
 *
 * Phalcon_View_Engine_Php
 *
 * Adapter to use PHP itself as templating engine
 */
class Phalcon_View_Engine_Php extends Php_View_Engine
{
	/**
	 * Phalcon_View_Engine_Php constructor
	 *
	 * @param Phalcon_View $view
	 * @param array $options
	 */
	public function __construct($view, $options){
	}

	/**
	 * Renders a view using the template engine
	 *
	 * @param string $path
	 * @param array $params
	 */
	public function render($path, $params){
	}

	/**
	 * Initializes the engine adapter
	 *
	 * @param Phalcon_View $view
	 * @param array $options
	 */
	public function initialize($view, $options){
	}

	/**
	 * Gets the name of the controller rendered
	 *
	 * @return string
	 */
	public function getControllerName(){
	}

	/**
	 * Gets the name of the action rendered
	 *
	 * @return string
	 */
	public function getActionName(){
	}

	/**
	 * Returns cached ouput on another view stage
	 *
	 * @return array
	 */
	public function getContent(){
	}

	/**
	 * Generates a external absolute path to an application uri
	 *
	 * @param array|string $params
	 * @return string
	 */
	public function url($params=NULL){
	}

	/**
	 * Returns a local path
	 *
	 * @param array|string $params
	 * @return string
	 */
	public function path($params=''){
	}

	/**
	 * Renders a partial inside another view
	 *
	 * @param string $partialPath
	 */
	public function partial($partialPath){
	}

}

/**
 * Phalcon_View_Engine_Twig
 *
 * Adapter to use Twig library as templating engine
 */
class Phalcon_View_Engine_Twig extends Php_View_Engine
{
	/**
	 * Phalcon_View_Engine_Twig constructor
	 *
	 * @param Phalcon_View $view
	 * @param array $options
	 * @param array $params
	 */
	public function __construct($view, $options){
	}

	/**
	 * Renders a view using the template engine
	 *
	 * @param string $path
	 * @param array $params
	 */
	public function render($path, $params){
	}

	/**
	 * Initializes the engine adapter
	 *
	 * @param Phalcon_View $view
	 * @param array $options
	 */
	public function initialize($view, $options){
	}

	/**
	 * Gets the name of the controller rendered
	 *
	 * @return string
	 */
	public function getControllerName(){
	}

	/**
	 * Gets the name of the action rendered
	 *
	 * @return string
	 */
	public function getActionName(){
	}

	/**
	 * Returns cached ouput on another view stage
	 *
	 * @return array
	 */
	public function getContent(){
	}

	/**
	 * Generates a external absolute path to an application uri
	 *
	 * @param array|string $params
	 * @return string
	 */
	public function url($params=NULL){
	}

	/**
	 * Returns a local path
	 *
	 * @param array|string $params
	 * @return string
	 */
	public function path($params=''){
	}

	/**
	 * Renders a partial inside another view
	 *
	 * @param string $partialPath
	 */
	public function partial($partialPath){
	}

}

}