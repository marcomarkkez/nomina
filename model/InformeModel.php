<?php
class InformeModel{

    public function obtener($args = []){
        $empleados = new DatabaseModel();
        $empleados->conectar();
        if(empty($args)){
            $query = "CALL get_informes()";
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
            $query = "CALL get_informes(?)";
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

}