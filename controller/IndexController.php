<?php 
include_once "autoloader.php";

class IndexController{
	public function index(){
		$view = new View;
		$view->view_tpl("index","Home");
	}
}