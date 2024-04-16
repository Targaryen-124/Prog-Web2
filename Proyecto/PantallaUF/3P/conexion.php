<?php

class conexion{
    private $servidor = "localhost";
    private $usuario = "root";
    private $password = "";
    private $db = "supermercado";
    private $con;

    public fuction __construct(){
        try{
            $this -> con = new PDO("mysql:host=$this->servidor;dbname=this->db",$this->usuario, $this->password);
            $this->con->setAttribute(PDO:ATTR_ERRMOD, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOExeption $e){
            return "Error de Conexion " . $e
        }
    }

    public function escribir($query){
        $this->con->exec($query);
        return $this->con->lastInsertId();
    }

    public function consulta($query){
        $sentencia = $this->con->prepare($query);
        $sentencia->exceute();
        return $sentencia->fetchAll();
    }
}
?>