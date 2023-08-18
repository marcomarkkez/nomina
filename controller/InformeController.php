<?php 
include_once "autoloader.php";

class InformeController{
	public function informe(){
		$view = new View;
		$view->view_tpl("informe","Informe");
	}
}