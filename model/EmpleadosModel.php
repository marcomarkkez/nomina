<?php
require_once "DatabaseModel.php";
class EmpleadosModel{

    public function obtener($args = []){
        $empleados = new DatabaseModel();
        $empleados->conectar();
        if(empty($args)){
            $query = "CALL get_empleados(?)";
            $stmt = $empleados->get_statement($query,"i",[0]);
            $res = $stmt->get_result();
            $resultados_arr = [];
            while($empleado = $res->fetch_assoc()){
                $resultados_arr[] = [
                    'numero' => $empleado['numero'],
                    'nombre' => $empleado['nombre'],
                    'rol' => $empleado['rol']
                ];
            }
            $log = new LogController;

            $log->writelog(__CLASS__." ".__FUNCTION__);
            $log->writelog("resultados_arr:");
            $log->writelog($resultados_arr);
            return $resultados_arr;
        }else{
            $query = "CALL get_empleados(?)";
            $stmt = $empleados->get_statement($query,["i",$args['numero']]);
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
        $log = new LogController;
        $log->writelog(__FUNCTION__);
        $log->writelog("Args nuevo empleado: ".implode(",",$args));
        if(empty($args)){
            $log->writelog("Return False");
            return false;
        }else{
            $log->writelog("Not Empty");
            $query = "CALL set_empleados(?,?,?,?)";
            $empleados = new DatabaseModel;
            $empleados->conectar();
            $stmt = $empleados->insert_statement(
                $query,
                "issi",
                [
                    $args['numero'],
                    $args['nombre'],
                    $args['rol'],
                    "@LID"
                ]
            );
            $empleados->cerrar();
            $log->writelog("$stmt: ".$stmt);
            return $stmt;
        }
    }

    public function actualizar($args){
        $empleados = new DatabaseModel();
        $empleados->conectar();
        if(empty($args)){
            return false;
        }else{
            $query = "CALL update_empleados(?,?,?)";
            $stmt = $empleados->update_statement($query,["iss",$args['numero'],$args['nombre'],$args['rol']]);
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
            $stmt = $empleados->delete_statement($query,["i",$args['numero']]);
            $empleados->cerrar();
            return true;
        }
    }

}