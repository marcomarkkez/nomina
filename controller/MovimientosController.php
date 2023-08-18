<?php 
include_once "autoloader.php";

class MovimientosController{
  public function movimientos(){
    $view = new View;
    $view->view_tpl("movimientos","Movimientos");
  }
}