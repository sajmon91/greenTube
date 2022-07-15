<?php 

session_start();

// load config
require_once 'config/config.php';

// load helpers
require_once 'helpers/helpers.php';

// autoload core libraries
spl_autoload_register(function($className){
	require_once 'core/' . $className . '.php';
});














 ?>