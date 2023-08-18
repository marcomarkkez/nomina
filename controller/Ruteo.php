<?php 
include_once "autoloader.php";

class Ruteo{

	/*
	* Esta función llama a una de las funciones en la misma clase según la ruta de la aplicación.
	* Para que funcione como links amigables hay que usar el htaccess, en un servidor que lo permita, actualmente en la máquina donde trabajé el proyecto no me acepta el htaccess
	*/
	public function ruta(){

		$log = new Log();
		$log->fileName(__FILE__);
		$log->functionName(__FUNCTION__);
		
		
		if(isset($_GET['var'])){
			$ruta = $_GET['var'];
			$log->writelog("URL variable: ".$ruta);
		}else{
			$ruta = "";
		}

		if($ruta != ""){
			$expruta = explode("/", $ruta);

			switch (count($expruta)) {
				case 1:
					$log->writelog("Switch case 1");
					$log->writelog("expruta: ".$expruta[0]);
					$log->writelog("Existe: ".method_exists('Ruteo', $expruta[0]));
					if(method_exists('Ruteo', $expruta[0])){
						$ruta = $expruta[0];
						$this->{$ruta}();
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

	/**
	 * La función index funciona como el home y en caso de que no se encuentre la función
	 * específica
	 * **/
	public function index(){
		$index = new IndexController;
		$index->index();
	}

	public function empleados(){
		$horas = new EmpleadosController;
		$horas->empleados();
	}

	public function movimientos(){
		$horas = new MovimientosController;
		$horas->movimientos();
	}

}