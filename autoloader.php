<?php 
require_once 'controller/Log.php';

if(function_exists('spl_autoload_register')){
  spl_autoload_register(function ($nombre_clase) {
    include "controller/".$nombre_clase.".php";
  });
}else{
  $log = new Log();
  $log->fileName(__FILE__);
  $log->functionName(__FUNCTION__);
  $log->log("No existe la función spl_autoload_register");
}