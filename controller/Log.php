<?php

class Log{
	private $logfile = "../log.html";
	private $corte = 3000;
	private $prepend = '<p style="margin:10px;">';
	private $append = '</p>';
	private $prefecha = '<span><b>';
	private $suffecha = '</b></span>';
	private $functionname = null;
	private $filename = null;


	public function setLogFile($file){
		$logfile = $file;
	}

	public function fecha(){
		$fecha = "[".date("l j F Y H:i:s")."] - ";
		return $this->prefecha.$fecha.$this->suffecha;
	}

	public function setCorte($cor){
		$this->corte = $cor;
	}

	public function fileName($f){
		$this->filename = $f;
	}
	
	public function functionName($f){
		$this->functionname = $f;
	}

	public function log($log){
		if (is_array($log) || is_object($log)) {
			$stringlog = $this->prepend.$this->fecha.print_r($log, true).$this->append;
			error_log($stringlog, 3, $this->$logfile);
		} else {
			$stringlog = $this->fecha.$log;
			error_log($stringlog, 3, $this->$logfile);
		}

		$content = file($this->$logfile);
		$tam_arr = count($content);
		$corte = $this->corte;
		if($tam_arr > $corte){
			$array_corte = $tam_arr - $corte;
			array_splice($content, 0, $array_corte);
			file_put_contents($this->logfile, $content);
		}
	}
}