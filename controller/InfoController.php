<?php 
include_once "autoloader.php";

class InfoController{
    public function info(){
        $view = new ViewController;
		$view->view_tpl("info","Info");
    }
}