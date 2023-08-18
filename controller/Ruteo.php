<?php 
include_once "autoloader.php";
// var_dump($_SERVER);

class Ruteo{

	/*
	Esta función llama a una de las funciones en la misma clase según la ruta de la aplicación.
	Para que funcione como links amigables hay que usar el htaccess, en un servidor que lo permita, actualmente en la máquina donde trabajé el proyecto no me acepta el htaccess
	*/
	public function ruta(){
		
		if(isset($_GET['var'])){
			$ruta = $_GET['var'];
		}

		if(!empty($ruta) && strpos($ruta, "/") != false){
			$expruta = explode("/", $ruta);
			switch (count($expruta)) {
				case 1:
					if(function_exists($expruta[0])){
						call_user_func($expruta[0]);
					}else{
						$this->index();
					}
				break;
				case 2:
					if(function_exists($expruta[0])){
						call_user_func($expruta[0],$expruta[1]);
					}else{
						$this->index();
					}
				break;
				case 3:
					if(function_exists($expruta[0])){
						call_user_func($expruta[0],$expruta[1],$expruta[2]);
					}else{
						$this->index();
					}
				break;
				default:
					$this->index();
				break;
			}
		}else{
			$this->index();
		}
	}

	public function index(){
		$view = new View;
		$view->view_tpl("index","Home");
	}


}