<?php 
require_once 'autoloader.php';

class AppController{
	public function iniciar(){
		error_reporting(E_ALL);
		ini_set('display_errors', '1');
		$ruteo = new RuteoController();
		$ruteo->ruta();
	}
}