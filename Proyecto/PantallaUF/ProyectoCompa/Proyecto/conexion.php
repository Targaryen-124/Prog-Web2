
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
            // Puedes agregar código adicional aquí para manejar el error, como registrarlos en un archivo de registro.
        }
    }

    public function consulta($sql) {
        try {
            $statement = $this->conexion->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al ejecutar la consulta: " . $e->getMessage();
            // Puedes agregar código adicional aquí para manejar el error, como registrarlos en un archivo de registro.
        }
    }
}
      
                                                                                                                                                               
                
?>
