<?php
require_once "database.php";

class MovimientosModel{

    public function obtener($args = []){
        $empleados = new DatabaseModel();
        $empleados->conectar();
        if(empty($args)){
            $query = "CALL get_movimientos()";
            $stmt = $empleados->statement($query,[]);
            $res = $stmt->get_result();
            $resultados_arr = [];
            while($empleado = $res->fetch_assoc()){
                $resultados_arr[]['numero'] = $empleado['numero'];
                $resultados_arr[]['nombre'] = $empleado['nombre'];
                $resultados_arr[]['rol'] = $empleado['rol']; 
            }
            return $resultados_arr;
        }else{
            $query = "CALL get_empleados(?)";
            $stmt = $empleados->statement($query,["i",$args['numero']]);
            $res = $stmt->get_result();
            $resultados_arr = [];
            while($empleado = $res->fetch_assoc()){
                $resultados_arr[]['numero'] = $empleado['numero'];
                $resultados_arr[]['nombre'] = $empleado['nombre'];
                $resultados_arr[]['rol'] = $empleado['rol']; 
            }
            return $resultados_arr;
        }
    }
    
    public function agregar($args){
        $empleados = new DatabaseModel();
        $empleados->conectar();
        if(empty($args)){
            return false;
        }else{
            $query = "CALL set_empleados(?,?,?)";
            $stmt = $empleados->statement($query,["iss",$args['numero'],$args['nombre'],$args['rol']]);
            $empleados->cerrar();
            return $empleados->con->insert_id;
        }
    }

    public function actualizar($args){
        $empleados = new DatabaseModel();
        $empleados->conectar();
        if(empty($args)){
            return false;
        }else{
            $query = "CALL update_empleados(?,?,?)";
            $stmt = $empleados->statement($query,["iss",$args['numero'],$args['nombre'],$args['rol']]);
            $empleados->cerrar();
            return true;
        }
    }

    public function eliminar($id){
        $empleados = new DatabaseModel();
        $empleados->conectar();
        if(empty($args)){
            return false;
        }else{
            $query = "CALL delete_empleados(?)";
            $stmt = $empleados->statement($query,["i",$args['numero']]);
            $empleados->cerrar();
            return true;
        }
    }

}