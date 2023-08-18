<?php 
include_once "autoloader.php";

class EmpleadosController{
  public function empleados(){
    $view = new View;
    $view->view_tpl("empleados","Empleados");
  }
}