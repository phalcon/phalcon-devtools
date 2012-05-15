<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Framework                                                      |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2012 Phalcon Team (http://www.phalconphp.com)       |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file docs/LICENSE.txt.                        |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  +------------------------------------------------------------------------+
*/

if(PHP_OS=="WINNT"){
	$path = str_replace("\\", "/", getcwd());
} else {
	$path = getcwd();
}

if(isset($_SERVER['PHP_SELF'])){
	$uri = '/'.join(array_slice(explode('/' , dirname($_SERVER['PHP_SELF'])), 1, -1), '/');
} else {
	$uri = '/';
}

require 'webtools.config.php';

chdir(PTOOLSPATH);

require 'scripts/Builder/Builder.php';
require 'scripts/WebTools/WebTools.php';

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Phalcon PHP Framework - Web DevTools.</title>
		<link rel="stylesheet" type="text/css" href="<?php echo $uri ?>/css/bootstrap/bootstrap.min.css">
	</head>
	<body>
		<div class="container-fluid">
		    <div class="row-fluid">
			    <div class="span2">
			    	<!--Sidebar content-->
			    	<div style="padding: 8px 0;" class="well">
					    <ul class="nav nav-list">
					      <?php echo Phalcon_WebTools::getMenu($uri) ?>
					    </ul>
					</div>
			    </div>
			    <div class="span9 well">
			    	<!--Body content-->
			    	<?php
						if(isset($_GET['action']) && $_GET['action']){
			    			try {
								Phalcon_WebTools::dispatch($uri, $path);
							}
							catch(Phalcon_Exception $e){
								echo '<div class="alert alert-error">', $e->getMessage(), '</div>';
							}
						} else {
							echo '<h1>Welcome to Web Developer Tools</h1>';
			    			echo '<p>Application to use Phalcon Developer Tools by web server.</p>';
						}
			    	?>
			    </div>
		    </div>
	    </div>
	    <script type="text/javascript" href="<?php echo $uri ?>/javascript/bootstrap/bootstrap.min.js"></script>
	</body>
</html>