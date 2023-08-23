<?php 
include_once "autoloader.php";

class RuteoController{

	/*
	* Esta función llama a una de las funciones en la misma clase según la ruta de la aplicación.
	* Para que funcione como links amigables hay que usar el htaccess, en un servidor que lo permita, actualmente en la máquina donde trabajé el proyecto no me acepta el htaccess
	*/
	public function ruta(){

		$log = new LogController;
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
					$log->writelog("Existe: ".method_exists('RuteoController', $expruta[0]));
					if(method_exists('RuteoController', $expruta[0])){
						$ruta = $expruta[0];
						$this->{$ruta}();
					}else{
						$this->index();
					}
				break;
				case 2:
					if(method_exists('RuteoController', $expruta[0])){
						$ruta = $expruta[0];
						$this->{$ruta}($expruta[1]);
					}else{
						$this->index();
					}
				break;
				case 3:
					if(method_exists('RuteoController', $expruta[0])){
						$ruta = $expruta[0];
						$this->{$ruta}($expruta[1],$expruta[2]);
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
	 * La función index funciona como el home y en caso de que no se encuentre 
	 * la función específica.
	 * **/
	public function index($param1=null,$param2=null){
		$index = new IndexController;
		$index->index();
	}

	/**
	 * Empleados es el CRUD de empleados
	 */
	public function empleados($param1=null,$param2=null){
		$empleados = new EmpleadosController;
		if($param1 == "nuevo"){
			$empleados->nuevo();
		}elseif($param1 == null && $param2 == null){
			$empleados->empleados();
		}
	}

	/**
	 * Informe es la pantalla donde aparece la información mensual de horas
	 */
	public function informe($param1=null,$param2=null){
		$informe = new InformeController;
		$informe->informe();
	}

	/**
	 * Para mostrar la página de nformación general
	 */
	public function info(){
		$info = new InfoController;
		$info->info();
	}

}