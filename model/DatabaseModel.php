<?php 
include_once "autoloader.php";

class DatabaseModel{
    private $host = "localhost";
    private $user = "root";
    private $password = "root";
    private $db = "nominas";
    /**
     * Objeto de conexión mysqli
     */
    public $con;

    public function __construct($conexion = []){
        if(!empty($conexion)){
            $this->host = $conexion['host'];
            $this->user = $conexion['user'];
            $this->password = $conexion['password'];
            $this->db = $conexion['db'];
        }
    }

    /**
     * Método para realizar la conexión por mysqli
     * @param mixed $conexion
     * @throws \Exception
     * @return void
     */
    public function conectar($conexion = []){
        if(isset($conexion['host'])){
            $this->host = $conexion['host'];
        }
        if(isset($conexion['user'])){
            $this->user = $conexion['user'];
        }
        if(isset($conexion['password'])){
            $this->password = $conexion['password'];
        }
        if(isset($conexion['db'])){
            $this->db = $conexion['db'];
        }
        try{
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $this->con = new mysqli($this->host, $this->user, $this->password, $this->db);
            if( mysqli_connect_errno() ){
                throw new Exception("No se puede conectar.");   
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }	
    }

    public function cerrar(){
        $this->con->close();
    }

    public function get_statement($qry, $types, $params = []){
        try{
            $log = new LogController;
            $st = $this->con->prepare($qry);
            $st->bind_param($types, ...$params);
            if($st === false) {
                throw New Exception("No se puede preparar: " . $qry);
            }
            $st->execute();
            return $st;
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }
        
    }

    /**
     * Seguridad básica para los querys
     */
    public function insert_statement($qry, $types, $params = []){
        try{
            $log = new LogController;
            $st = $this->con->prepare($qry);
            $st->bind_param($types, ...$params);
            if($st === false) {
                throw New Exception("No se puede preparar: " . $qry);
            }
            $st->execute();
            $st2 = $this->con->prepare("SELECT @LID as id");
            return $st2->insert_id;
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }
        
    }

    public function update_statement($qry, $types, $params = []){
        try{
            $log = new LogController;
            $st = $this->con->prepare($qry);
            $st->bind_param($types, ...$params);
            if($st === false) {
                throw New Exception("No se puede preparar: " . $qry);
            }
            $st->execute();
            return $st;
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }
        
    }

    public function delete_statement($qry, $types, $params = []){
        try{
            $log = new LogController;
            $st = $this->con->prepare($qry);
            $st->bind_param($types, ...$params);
            if($st === false) {
                throw New Exception("No se puede preparar: " . $qry);
            }
            $st->execute();
            return $st;
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }   
    }

}