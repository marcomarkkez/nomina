<?php 
include_once "autoloader.php";

/**
 * CRUD de empleados
 */
class MovimientosController{
  /**
   * Página principal, solo muestra el formulario
   * @return void
   */
  public function movimientos(){
    $movimientos = new MovimientosModel;
    $movimientos->obtener();
    $arrays = [
      "movimientos" => $movimientos->obtener()
    ];
    $log = new LogController;
    $log->writelog(__FUNCTION__." Arrays: ");
    $log->writelog($arrays); 
    $view = new ViewController;
    $view->view_tpl("movimientos.php","Movimientos",$arrays);
  }

  /**
   * Para agregar empleados
   * @return void
   */
  public function nuevo(){
    $log = new LogController;
    if(isset($_POST['numero_empleado'], $_POST['entregas_empleado'])){
      
      $log->writelog(
        "Movimiento: ".
        $_POST['numero_empleado']." ".
        $_POST['entregas_empleado']
      );

      $log->writelog("Antes de Sanitize");
      $sanitize = new SanitizeController;
      $emp_numero = $sanitize->sanitize($_POST['numero_empleado']);
      $emp_entregas = $sanitize->sanitize($_POST['entregas_empleado']);
      $log->writelog("Después de Sanitize: ".$emp_numero." ".$emp_entregas);
      $movimientos = new MovimientosModel;
      $args = [
        "numero" => $emp_numero,
        "nombre" => $emp_entregas
      ];
      $respuesta = $movimientos->agregar($args);
      $log->writelog("Respuesta NE: ".$respuesta);
    }

    $view = new ViewController;
    $view->view_tpl("movimientosform","Agregar Movimiento");
  }

  /**
   * Borrar empleados
   * Solo es accesado con Ajax (VueJS)
   * @return void
   */
  public function eliminar($id){
    $movimientos = new MovimientosModel;
    $movimientos->eliminar($id);
  }
}