<?php
 
     
include_once dirname( __FILE__ )  . "/core/Loader/autoload.php";  
require_once dirname( __FILE__ )  . "/config/config.php"; 

  
//var_dump($autoloader);
// if(preg_match($_SERVER['REQUEST_URI']))
$frontController = new FrontController();
$frontController->run();
 