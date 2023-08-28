<?php
require_once "database.php";

class MovimientosModel{

    public function obtener($args = []){
        $movimientos = new DatabaseModel();
        $movimientos->conectar();
        if(empty($args)){
            $query = "CALL get_movimientos(?)";
            $stmt = $movimientos->get_statement($query,"i",[0]);
            $res = $stmt->get_result();
            $resultados_arr = [];
            while($movimiento = $res->fetch_assoc()){
                $resultados_arr[] = [
                    'numero' => $movimiento['numero'],
                    'nombre' => $movimiento['nombre'],
                    'rol' => $movimiento['rol'],
                    'entregas' => $movimiento['entregas'],
                    'mes' => $movimiento['mes']
                ];
            }
            return $resultados_arr;
        }else{
            $query = "CALL get_movimientos(?)";
            $stmt = $movimientos->get_statement($query,["i",$args['numero']]);
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
        $movimientos = new DatabaseModel();
        $movimientos->conectar();
        if(empty($args)){
            return false;
        }else{
            $query = "CALL set_movimientos(?,?,?)";
            $stmt = $movimientos->insert_statement($query,["iss",$args['numero'],$args['nombre'],$args['rol']]);
            $movimientos->cerrar();
            return $movimientos->con->insert_id;
        }
    }

    public function actualizar($args){
        $movimientos = new DatabaseModel();
        $movimientos->conectar();
        if(empty($args)){
            return false;
        }else{
            $query = "CALL update_movimientos(?,?,?)";
            $stmt = $movimientos->update_statement($query,["iss",$args['numero'],$args['nombre'],$args['rol']]);
            $movimientos->cerrar();
            return true;
        }
    }

    public function eliminar($id){
        $movimientos = new DatabaseModel();
        $movimientos->conectar();
        if(empty($args)){
            return false;
        }else{
            $query = "CALL delete_movimientos(?)";
            $stmt = $movimientos->delete_statement($query,["i",$args['numero']]);
            $movimientos->cerrar();
            return true;
        }
    }

}