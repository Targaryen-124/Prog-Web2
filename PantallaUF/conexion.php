
<?php

class conexion {
    private $host = 'localhost';
    private $usuario = 'root';
    private $contrasenia = '';
    private $base_datos = 'db_ticket';
    private $conexion;

    public function __construct() {
        try {
            $this->conexion = new PDO("mysql:host={$this->host};dbname={$this->base_datos}", $this->usuario, $this->contrasenia);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }

    public function consulta($sql) {
        try {
            $statement = $this->conexion->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al ejecutar la consulta: " . $e->getMessage();
        }
    }

    public function escribirTicket($query){
        $statement = $this->conexion->prepare($query);
        $statement->execute();
        return $this->conexion->lastInsertId();
    }
    
}                                                                                                                                                           
                
?>
