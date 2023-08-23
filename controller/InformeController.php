<?php 
include_once "autoloader.php";

class InformeController{
	public function informe(){
		$view = new ViewController;
		$view->view_tpl("informe","Informe");
	}
}