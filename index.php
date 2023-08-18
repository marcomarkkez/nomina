<?php 

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// ini_set('error_reporting', E_ALL);

// echo "<h1>Hola</h1>";
require_once "autoloader.php";

// if(function_exists("spl_autoload_register")){
// 	echo "<h1>Autoloader existe</h1>";
// }

$app = new App();
$app->iniciar();
