<?php 
include_once "autoloader.php";

/**
 * CRUD de empleados
 */
class EmpleadosController{
  /**
   * Página principal, solo muestra el formulario
   * @return void
   */
  public function empleados(){
    $view = new ViewController;
    $view->view_tpl("empleados","Empleados");
  }

  /**
   * Para agregar empleados
   * @return void
   */
  public function nuevo(){
    $log = new LogController;
    if(isset($_POST['numero_empleado']) && isset($_POST['nombre_empleado']) && isset($_POST['rol_empleado'])){
      
      $log->writelog(
        "Nuevo Empleado: ".
        $_POST['numero_empleado']." ".
        $_POST['nombre_empleado']." ".
        $_POST['rol_empleado']
      );
      $log->writelog("Antes de Sanitize");
      $sanitize = new SanitizeController;
      $emp_numero = $sanitize->sanitize($_POST['numero_empleado']);
      $emp_nombre = $sanitize->sanitize($_POST['nombre_empleado']);
      $emp_rol = $sanitize->sanitize($_POST['rol_empleado']);
      $log->writelog("Después de Sanitize: ".$emp_numero." ".$emp_nombre." ".$emp_rol);
      $empleado = new EmpleadosModel;
      $args = [
        "numero" => $emp_numero,
        "nombre" => $emp_nombre,
        "rol" => $emp_rol
      ];
      $respuesta = $empleado->agregar($args);
      $log->writelog("Respuesta NE: ".$respuesta);
    }

    $view = new ViewController;
    $view->view_tpl("empleadosform","Emplead@ Nuev@");
  }

  /**
   * Borrar empleados
   * Solo es accesado con Ajax (VueJS)
   * @return void
   */
  public function eliminar($id){
    $db = new EmpleadosModel;
    $db->eliminar($id);
  }
}