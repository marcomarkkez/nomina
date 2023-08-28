<?php
require_once "autoloader.php";


class ViewController{
	private $btsrp_css = '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">';
	private $btsrp_js = '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>';
	private $lan = '<meta http-equiv=”Content-Language” content=”es”/>';
	private $vue = '<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>';
	public $edit_svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path d="M11.013 1.427a1.75 1.75 0 0 1 2.474 0l1.086 1.086a1.75 1.75 0 0 1 0 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 0 1-.927-.928l.929-3.25c.081-.286.235-.547.445-.758l8.61-8.61Zm.176 4.823L9.75 4.81l-6.286 6.287a.253.253 0 0 0-.064.108l-.558 1.953 1.953-.558a.253.253 0 0 0 .108-.064Zm1.238-3.763a.25.25 0 0 0-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 0 0 0-.354Z"></path></svg>';
	public $delete_svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path d="M3.72 3.72a.75.75 0 0 1 1.06 0L8 6.94l3.22-3.22a.749.749 0 0 1 1.275.326.749.749 0 0 1-.215.734L9.06 8l3.22 3.22a.749.749 0 0 1-.326 1.275.749.749 0 0 1-.734-.215L8 9.06l-3.22 3.22a.751.751 0 0 1-1.042-.018.751.751 0 0 1-.018-1.042L6.94 8 3.72 4.78a.75.75 0 0 1 0-1.06Z"></path></svg>';

	public function view_tpl($tpl,$titulo,$arrays = ["default"=>0]){
		$log = new LogController;
		$log->writelog(__FUNCTION__);
		$base = file_get_contents("view/base.html");
		if(strpos($tpl,"php") != false){
			$log->writelog("tpl: ".$tpl);
			$log->writelog($arrays);
			unset($arrays[0]);
			ob_start();
			$delete_svg = $this->delete_svg;
			$edit_svg = $this->edit_svg;
			extract($arrays);
			$log->writelog("empleados:");
			$log->writelog($empleados);
			include("view/".$tpl);
			$contenido = ob_get_contents();
			ob_get_clean();
			$log->writelog($contenido);
		}else{
			$contenido = "view/".$tpl.".html";
			if(!file_exists($contenido)){
				$contenido = "";
			}else{
				$contenido = file_get_contents($contenido);
			}
		}
		$search = array("[[lang]]","[[head]]","[[title]]","[[contenido]]","[[footer_scripts]]");
		$replace = array($this->lan,$this->btsrp_js.$this->btsrp_css.$this->vue,$titulo,$contenido);
		$html = str_replace($search, $replace, $base);
		echo $html;
	}
}