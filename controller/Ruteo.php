<?php 

// var_dump($_SERVER);

class Ruteo{
	public function ruta(){
		$ruta = $_GET['var'];
		if(!empty($ruta) && strpos($ruta, "/") != false){
			$expruta = explode("/", $ruta);
			switch (count($expruta)) {
				case 1:
					if(function_exists(call_user_func($expruta[0]))){
						call_user_func($expruta[0]);
					}
				break;
				case 2:
					if(function_exists(call_user_func($expruta[0],))){
						call_user_func($expruta[0]);
					}
				break;
				
				default:
					// code...
					break;
			}
			switch($expruta{

			}
		}

	}
}