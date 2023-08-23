<?php
require_once "autoloader.php";


class ViewController{
	private $btsrp_css = '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">';
	private $btsrp_js = '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>';
	private $lan = '<meta http-equiv=”Content-Language” content=”es”/>';

	private $vue = '<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>';

	public function view_tpl($tpl,$titulo){
		$base = file_get_contents("view/base.html");
		$contenido = "view/".$tpl.".html";
		if(!file_exists($contenido)){
			$contenido = "";
		}else{
			$contenido = file_get_contents($contenido);
		}
		$search = array("[[lang]]","[[head]]","[[title]]","[[contenido]]","[[footer_scripts]]");
		$replace = array($this->lan,$this->btsrp_js.$this->btsrp_css.$this->vue,$titulo,$contenido);
		$html = str_replace($search, $replace, $base);
		echo $html;
	}
}