<?php 
require_once 'autoloader.php';

class App{
	public function iniciar(){
		$ruteo = new Ruteo();
		$ruteo->ruta();
	}
}