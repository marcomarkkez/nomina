<?php 
require_once 'controller/LogController.php';

if(function_exists('spl_autoload_register')){
  spl_autoload_register(function ($nombre_clase) {
    if(strpos($nombre_clase,"Controller") != false){
      include "controller/".$nombre_clase.".php";
    }elseif(strpos($nombre_clase,"Model") != false){
      include "model/".$nombre_clase.".php";
    }else{
      echo "No se pudo cargar la clase: ".$nombre_clase;
    }
  });
}else{
  $log = new LogController();
  $log->fileName(__FILE__);
  $log->functionName(__FUNCTION__);
  $log->writelog("No existe la función spl_autoload_register");
}